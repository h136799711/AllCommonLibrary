<?php

namespace Home\Logic;

/*
ʹ�÷�����
 $arr = array(
	'account' => '����ƽ̨�ʺ�',
	'password' => '����'
);
$w = new Weixin();
$w->login($arr);
$w->getAllUserInfo();//��ȡ�û���Ϣ
$w->sendMessage('Ⱥ������'); //Ⱥ���������û�
$w->sendMessage('Ⱥ������',$userId); //Ⱥ�����ض��û�
*/
class WXMsgSenderLogic  {
	public $userFakeid;//���з�˿��fakeid
	private $_account;//�û���
	private $_password;//����
	private $url;//�������ַ
	private $send_data;//�ύ������
	private $getHeader = 0;//�Ƿ���ʾHeader��Ϣ
	private $token;//�����ʺ�TOKEN
	private $host = 'mp.weixin.qq.com';//����
	private $origin = 'https://mp.weixin.qq.com';
	private $referer;//���õ�ַ
	private $cookie;
	private $pageSize = 100000;//ÿҳ�û��������ڶ�ȡ�����û���
	private $userAgent = 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:23.0) Gecko/20100101 Firefox/23.0';
	
	
	
	//��¼
	public function login($options){
		$this->_account = isset($options['account'])?$options['account']:'';
		$this->_password = isset($options['password'])?$options['password']:'';
		$url = 'https://mp.weixin.qq.com/cgi-bin/login?lang=zh_CN';
		$this->send_data = array(
            'username' => $this->_account,
            'pwd' => md5($this->_password),
            'f' => 'json'
        );
		$this->referer = "https://mp.weixin.qq.com/";
		$this->getHeader = 1;
		$result = explode("\n",$this->curlPost($url));
		foreach ($result as $key => $value) {
			$value = trim($value);
			if(preg_match('/"ErrCode": (.*)/i', $value,$match)){//��ȡtoken
				switch ($match[1]) {
					case -1:
						die(json_encode(array('status'=>1,'errCode'=>$match[1],'msg'=>"ϵͳ����")));
					case -2:
						die(json_encode(array('status'=>1,'errCode'=>$match[1],'msg'=>"�ʺŻ��������")));
					case -3:
						die(urldecode(json_encode(array('status'=>1,'errCode'=>$match[1],'msg'=>urlencode("�������")))));
					case -4:
						die(json_encode(array('status'=>1,'errCode'=>$match[1],'msg'=>"�����ڸ��ʻ�")));
					case -5:
						die(json_encode(array('status'=>1,'errCode'=>$match[1],'msg'=>"��������")));
					case -6:
						die(json_encode(array('status'=>1,'errCode'=>$match[1],'msg'=>"��Ҫ������֤��")));
					case -7:
						die(json_encode(array('status'=>1,'errCode'=>$match[1],'msg'=>"���ʺ��Ѱ�˽��΢�źţ��������ڹ���ƽ̨��¼")));
					case -8:
						die(json_encode(array('status'=>1,'errCode'=>$match[1],'msg'=>"�����Ѵ���")));
					case -32:
						die(json_encode(array('status'=>1,'errCode'=>$match[1],'msg'=>"��֤���������")));
					case -200:
						die(json_encode(array('status'=>1,'errCode'=>$match[1],'msg'=>"��Ƶ���ύ������ϣ����ʺű��ܾ���¼")));
					case -94:
						die(json_encode(array('status'=>1,'errCode'=>$match[1],'msg'=>"��ʹ�������½")));
					case 10:
						die(json_encode(array('status'=>1,'errCode'=>$match[1],'msg'=>"�ù��ڻ�����Ѿ����ڣ��޷��ٵ�¼ʹ��")));
					case 0:
					    $this->userFakeid = $this->getUserFakeid();
						break;
				}
			}
			if(preg_match('/^set-cookie:[\s]+([^=]+)=([^;]+)/i', $value,$match)){//��ȡcookie
				$this->cookie .=$match[1].'='.$match[2].'; ';
			}
			if(preg_match('/"ErrMsg"/i', $value,$match)){//��ȡtoken
		    	$this->token = rtrim(substr($value,strrpos($value,'=')+1),'",');
			}
		}
	}
	
    //������Ϣ
	private function send($fakeid,$content){
		$url = 'https://mp.weixin.qq.com/cgi-bin/singlesend?t=ajax-response&lang=zh_CN';
		$this->send_data = array(
				'type' => 1,
				'content' => $content,
				'error' => 'false',
				'tofakeid' => $fakeid,
				'token' => $this->token,
				'ajax' => 1,
			);
		$this->referer = 'https://mp.weixin.qq.com/cgi-bin/singlemsgpage?token='.$this->token.'&fromfakeid='.$fakeid.'&msgid=&source=&count=20&t=wxm-singlechat&lang=zh_CN';
		return $this->curlPost($url);
	}
	
	//Ⱥ����Ϣ
    public function sendMessage($content='',$userId='') {
		if(is_array($userId) && !empty($userId)){
			foreach($userId as $v){
				$json = json_decode($this->send($v,$content));
				if($json->ret!=0){
					$errUser[] = $v;
				}
			}
		}else{
			foreach($this->userFakeid as $v){
				$json = json_decode($this->send($v['fakeid'],$content));
				if($json->ret!=0){
					$errUser[] = $v['fakeid'];
				}
			}
		}
		
		//�������û���
		$count = count($this->userFakeid);
		//����ʧ���û���
		$errCount = count($errUser);
		//���ͳɹ��û���
		$succeCount = $count-$errCount;
		
		$data = array(
			'status'=>0,
			'count'=>$count,
			'succeCount'=>$succeCount,
			'errCount'=>$errCount,
			'errUser'=>$errUser 
		);
		
		return json_encode($data);
    }
	//��ȡ�����û���Ϣ
	public function getAllUserInfo(){
		foreach($this->userFakeid as $v){
			$info[] = $this->getUserInfo($v['groupid'],$v['fakeid']);
		}
		
		return $info;
	}
	
	
	
	//��ȡ�û���Ϣ
	public function getUserInfo($groupId,$fakeId){
		$url = "https://mp.weixin.qq.com/cgi-bin/getcontactinfo?t=ajax-getcontactinfo&lang=zh_CN&fakeid={$fakeId}";
		$this->getHeader = 0;
		$this->referer = 'https://mp.weixin.qq.com/cgi-bin/contactmanagepage?token='.$this->token.'&t=wxm-friend&lang=zh_CN&pagesize='.$this->pageSize.'&pageidx=0&type=0&groupid='.$groupId;
		$this->send_data = array(
			'token'=>$this->token,
			'ajax'=>1
		);
        $message_opt = $this->curlPost($url);
        return $message_opt;
	}
	
	//��ȡ�����û�fakeid
	private function getUserFakeid(){
		ini_set('max_execution_time',600);
		$pageSize = 1000000;
		$this->referer = "https://mp.weixin.qq.com/cgi-bin/home?t=home/index&lang=zh_CN&token={$_SESSION['token']}";
		$url = "https://mp.weixin.qq.com/cgi-bin/contactmanage?t=user/index&pagesize={$pageSize}&pageidx=0&type=0&groupid=0&token={$this->token}&lang=zh_CN";
		$user = $this->vget($url);
		$preg = "/\"id\":(\d+),\"name\"/";
		preg_match_all($preg,$user,$b);
		$i = 0;
		foreach($b[1] as $v){
			$url = 'https://mp.weixin.qq.com/cgi-bin/contactmanage?t=user/index&pagesize='.$pageSize.'&pageidx=0&type=0&groupid='.$v.'&token='.$this->token.'&lang=zh_CN';
			$user = $this->vget($url);
			$preg = "/\"id\":(\d+),\"nick_name\"/";
			preg_match_all($preg,$user,$a);
			foreach($a[1] as $vv){
				$arr[$i]['fakeid'] = $vv;
				$arr[$i]['groupid'] = $v;
				$i++;
			}
		}
		return $arr;
	}

    /**
     * curlģ���¼��post����
     * @param $url request��ַ
     * @param $header ģ��headreͷ��Ϣ
     * @return json
     */
    private function curlPost($url) {
		$header = array(
            'Accept:*/*',
            'Accept-Charset:GBK,utf-8;q=0.7,*;q=0.3',
            'Accept-Encoding:gzip,deflate,sdch',
            'Accept-Language:zh-CN,zh;q=0.8',
            'Connection:keep-alive',
            'Host:'.$this->host,
            'Origin:'.$this->origin,
            'Referer:'.$this->referer,
            'X-Requested-With:XMLHttpRequest'
        );
        $curl = curl_init(); //����һ��curl�Ự
        curl_setopt($curl, CURLOPT_URL, $url); //Ҫ���ʵĵ�ַ
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header); //����HTTPͷ�ֶε�����
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); //����֤֤����Դ�ļ��
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); //��֤���м��SSL�����㷨�Ƿ����
        curl_setopt($curl, CURLOPT_USERAGENT, $this->useragent); //ģ���û�ʹ�õ������
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); //ʹ���Զ���ת
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1); //�Զ�����Referer
        curl_setopt($curl, CURLOPT_POST, 1); //����һ�������Post����
        curl_setopt($curl, CURLOPT_POSTFIELDS, $this->send_data); //Post�ύ�����ݰ�
        curl_setopt($curl, CURLOPT_COOKIE, $this->cookie); //��ȡ�����Cookie��Ϣ
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); //���ó�ʱ���Ʒ�ֹ��ѭ��
        curl_setopt($curl, CURLOPT_HEADER, $this->getHeader); //��ʾ���ص�Header��������
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //��ȡ����Ϣ���ļ�������ʽ����
        $result = curl_exec($curl); //ִ��һ��curl�Ự
        curl_close($curl); //�ر�curl
        return $result;
    }
	
	private function vget($url){ // ģ���ȡ���ݺ���
		$header = array(
				'Accept:*/*',
				'Accept-Encoding:gzip,deflate',
				'Accept-Language:zh-CN,zh;q=0.8',
				'Connection:keep-alive',
				'Host:mp.weixin.qq.com',
				'Referer:'.$this->referer,
				'X-Requested-With:XMLHttpRequest'
		);
		
		$useragent = 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:23.0) Gecko/20100101 Firefox/23.0';
		$curl = curl_init(); // ����һ��CURL�Ự
		curl_setopt($curl, CURLOPT_URL, $url); // Ҫ���ʵĵ�ַ
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header); //����HTTPͷ�ֶε�����
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // ����֤֤����Դ�ļ��
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // ��֤���м��SSL�����㷨�Ƿ����
		curl_setopt($curl, CURLOPT_USERAGENT, $useragent); // ģ���û�ʹ�õ������
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // ʹ���Զ���ת
		curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // �Զ�����Referer
		curl_setopt($curl, CURLOPT_HTTPGET, 1); // ����һ�������GET����
		curl_setopt($curl, CURLOPT_COOKIE, $this->cookie); // ��ȡ�����������Cookie��Ϣ
		curl_setopt($curl, CURLOPT_TIMEOUT, 30); // ���ó�ʱ���Ʒ�ֹ��ѭ��
		curl_setopt($curl, CURLOPT_HEADER, $this->getHeader); // ��ʾ���ص�Header��������
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // ��ȡ����Ϣ���ļ�������ʽ����
		$tmpInfo = curl_exec($curl); // ִ�в���
		if (curl_errno($curl)) {
			// echo 'Errno'.curl_error($curl);
		}
		curl_close($curl); // �ر�CURL�Ự
		return $tmpInfo; // ��������
	}

}

?>
