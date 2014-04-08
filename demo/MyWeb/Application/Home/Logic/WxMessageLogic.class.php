<?php

namespace Home\Logic;

/*
使用方法：
 $arr = array(
	'account' => '公众平台帐号',
	'password' => '密码'
);
$w = new Weixin();
$w->login($arr);
$w->getAllUserInfo();//获取用户信息
$w->sendMessage('群发内容'); //群发给所有用户
$w->sendMessage('群发内容',$userId); //群发给特定用户
*/
class WxMessageLogic  {
	public $userFakeid;//所有粉丝的fakeid
	private $_appid;//用户名
	private $_secret;//密码
	private $url;//请求的网址
	private $send_data;//提交的数据
	private $getHeader = 0;//是否显示Header信息
	private $token;//公共帐号TOKEN
	private $host = 'mp.weixin.qq.com';//主机
	private $origin = 'https://mp.weixin.qq.com';
	private $referer;//引用地址
	private $cookie;
	private $pageSize = 100000;//每页用户数（用于读取所有用户）
	private $userAgent = 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:23.0) Gecko/20100101 Firefox/23.0';
	private $nopenid = '';//当前最后一个用户openid
	private $total = 0;//总数
	private $count = 0;//当前获取到的用户数
	private $users;//当前获取到的用户数
//	private $fromuser;//发送方
	
	
	//登录
	public function login($options){
		$this->nopenid = "";
		$this->_appid = isset($options['appid'])?$options['appid']:'';
		$this->_secret = isset($options['secret'])?$options['secret']:'';
//		$this->fromuser = isset($options['fromuser'])?$options['fromuser']:'';
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->_appid."&secret=".$this->_secret;
		
		$this->referer = "https://mp.weixin.qq.com/";
		$this->getHeader = 0;
		$result = json_decode($this->curlPost($url));
		//var_dump($result);
		if(isset($result->access_token)){
			$this->token = $result->access_token;
			return $this->token;
		}else{
			return $result->errmsg;			 
		}
	}

	//发送文本消息
	private function sendText($openid,$content)
	{
		$textTpl = "{
			\"touser\":\"$openid\",
			\"msgtype\":\"text\",
			\"text\":
			{
				 \"content\":\"%s\"
			}
		}";
        $data = sprintf($textTpl,$content);
		
		//var_dump($data);
		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$this->token;	
		$this->referer = "https://mp.weixin.qq.com/";
		$this->getHeader = 0;
		$result = json_decode($this->curlPost($url,$data));
		 var_dump($result);
		 if($result->errcode == 0)
		{
			return 1;
		}else{
			return 0;
		}
	}
	
	//发送文本消息
	/* $articles 格式
	[
         {
             "title":"Happy Day",
             "description":"Is Really A Happy Day",
             "url":"URL",
             "picurl":"PIC_URL"
         },
         {
             "title":"Happy Day",
             "description":"Is Really A Happy Day",
             "url":"URL",
             "picurl":"PIC_URL"
         }
         ]*/
	private function sendNews($openid,$articles)
	{	
		var_dump($articles);
		$textTpl = "{
			\"touser\":\"$openid\",
			\"msgtype\":\"news\",
			\"news\":{
				\"articles\":%s
			}
		}";
		
        $data = sprintf($textTpl,$articles);		
		//var_dump($data);
		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$this->token;	
		$this->referer = "https://mp.weixin.qq.com/";
		$this->getHeader = 0;
		$result = json_decode($this->curlPost($url,$data));
		 //var_dump($result);
		 if($result->errcode == 0)
		{
			return 1;
		}else{
			return 0;
		}
	}

    //单发消息
	private function send($openid,$content){
	//	 return $this->sendText($openid,$content);
	}
	
	//群发消息
	//返回
    public function sendMessage($content='',$type='') {
		//var_dump($this->users);
		echo $content.$type;
		$successed = 0;
		if($type=='text'){
			foreach ($this->users as $openid){
				$successed = $successed +	$this->sendText($openid,$content);
			}
		}
		else if ($type=='news'){
			foreach ($this->users as $openid){
				$successed = $successed +	$this->sendNews($openid,$content);
			}
		}
		return array("total"=>count($this->users),"successed"=>$successed);
    }
	//获取所有用户信息
	public function getAllUserInfo(){
		$url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token=".$this->token."&next_openid=".$this->nopenid;		
		$this->referer = "https://mp.weixin.qq.com/";
		$this->getHeader = 0;
		$result = json_decode($this->curlPost($url));
		$this->total = $result->total;
		$this->count = $result->count;
		$this->users = $result->data->openid;
		$this->nopenid = $result->next_openid;
		return $result;
	}
	
	
	
	//获取用户信息
	public function getUserInfo($groupId,$fakeId){
		
	}
	
	//获取所有用户fakeid
	private function getUserFakeid(){
		
	}
	
	function curlPost($url,$data = null){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		if (!empty($data)){
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
	}


}

?>
