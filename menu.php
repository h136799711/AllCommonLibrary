<?php
$appid = "wx9196f2ab959e57c8";
$appsecret = "5dfadfce94355c278ee4cfccd184a1cf";
//if(isset($_POST["body"])){

$url ="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
$result = https_request($url);

$jsoninfo = json_decode($result, true);
$access_token = $jsoninfo["access_token"];
var_dump($access_token);
if(isset($_POST["body"])){
	$jsonmenu = $_POST["body"];
}
if(empty($jsonmenu))
{
	$jsonmenu = '{
      "button":[      
       {
           "type":"click",
           "name":"技术支持'.date("m",time()).'",
            "key":"company"
		},
		{
              "type":"view",
              "name":"汽车之家",
              "url":"http://wxphp123.duapp.com/"
       }]
 }';
}

var_dump($jsonmenu);
$request = new CurlRequest;


$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
try{
//$result = https_request($url, $jsonmenu);
//$result = curl_post($url, array($jsonmenu));
 $request->init(array('url' => $url,
                         'host' => 'mp.weixin.qq.com',
                        'header' => '',
                        'method' => 'post',
                        'referer' => 'https://mp.weixin.qq.com/debug',
                        'cookie' => '',
                        'post_fields' =>$jsonmenu,    
                        'timeout' => 10
                        ));
$result = $request->exec();
//var_dump($result);
echo $result["body"];
}catch(Exception $e)        //捕获异常
{
	echo $e->getMessage();
}


function https_request($url,$data = null){
	
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
    if (!empty($data)){
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	}
	$res = curl_exec($ch);
	curl_close($ch);
	
  //  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);	
//	curl_setopt($curl,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.69 Safari/537.36');//设置用户代理
	//curl_setopt($ch,CURLOPT_COOKIEJAR,"tmp");设置cookie的保存目录
//    curl_setopt($ch,CURLOPT_HTTPHEADER,$headerArray);//设置头信息
//	$output = curl_exec($curl);
//	echo "curl_errno ".curl_errno($curl);
//    curl_close($curl);
    return $res;
}
/*
<html>
<head><title>微信自定义菜单接口</title>
<meta http_equiv="Content-type" content="text/html;charset=utf-8;" />
</head>
<body>
	<form action="menu.php" method="post" name="form1">
		<div>AppID : <input type="text" name="appid" value="wx9196f2ab959e57c8" /></div>
		<div>appsecret : <input type="text" name="appsecret" value="5dfadfce94355c278ee4cfccd184a1cf" /></div>
		<div>body : <input type="textarea" name="body" value="{'button':[             {           'type':'click',
           'name':'技术支持',            'key':'company'		},		{              'type':'view',
              'name':'汽车之家',              'url':'http://wxphp123.duapp.com/'       }] }" /></div>
			  
			  <button type="submit"  value="提交"/>
	</form>
</body>
</html>*/

class CurlRequest
{
    private $ch;
    /**
     * Init curl session
     * 
     * $params = array('url' => '',
     *                    'host' => '',
     *                   'header' => '',
     *                   'method' => '',
     *                   'referer' => '',
     *                   'cookie' => '',
     *                   'post_fields' => '',
     *                    ['login' => '',]
     *                    ['password' => '',]      
     *                   'timeout' => 0
     *                   );
     */                
    public function init($params)
    {
        $this->ch = curl_init();
        $user_agent = 'Mozilla/5.0 (Windows; U; 
Windows NT 5.1; ru; rv:1.8.0.9) Gecko/20061206 Firefox/1.5.0.9';
        $header = array(
        "Accept: text/xml,application/xml,application/xhtml+xml,
text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5",
        "Accept-Language: ru-ru,ru;q=0.7,en-us;q=0.5,en;q=0.3",
        "Accept-Charset: windows-1251,utf-8;q=0.7,*;q=0.7",
        "Keep-Alive: 300");
        if (isset($params['host']) && $params['host'])      $header[]="Host: ".$params['host'];
        if (isset($params['header']) && $params['header']) $header[]=$params['header'];
        
        @curl_setopt ( $this -> ch , CURLOPT_RETURNTRANSFER , 1 );
        @curl_setopt ( $this -> ch , CURLOPT_VERBOSE , 1 );
        @curl_setopt ( $this -> ch , CURLOPT_HEADER , 1 );
        
        if ($params['method'] == "HEAD") @curl_setopt($this -> ch,CURLOPT_NOBODY,1);
        @curl_setopt ( $this -> ch, CURLOPT_FOLLOWLOCATION, 1);
        @curl_setopt ( $this -> ch , CURLOPT_HTTPHEADER, $header );
        if ($params['referer'])    @curl_setopt ($this -> ch , CURLOPT_REFERER, $params['referer'] );
        @curl_setopt ( $this -> ch , CURLOPT_USERAGENT, $user_agent);
        if ($params['cookie'])    @curl_setopt ($this -> ch , CURLOPT_COOKIE, $params['cookie']);

        if (strtolower($params['method']) == "post" )
        {
            curl_setopt( $this -> ch, CURLOPT_POST, true );
            curl_setopt( $this -> ch, CURLOPT_POSTFIELDS, $params['post_fields'] );
        }
        @curl_setopt( $this -> ch, CURLOPT_URL, $params['url']);
        @curl_setopt ( $this -> ch , CURLOPT_SSL_VERIFYPEER, 0 );
        @curl_setopt ( $this -> ch , CURLOPT_SSL_VERIFYHOST, 0 );
        if (isset($params['login']) & isset($params['password']))
            @curl_setopt($this -> ch , CURLOPT_USERPWD,$params['login'].':'.$params['password']);
        @curl_setopt ( $this -> ch , CURLOPT_TIMEOUT, $params['timeout']);
    }
    
    /**
     * Make curl request
     *
     * @return array  'header','body','curl_error','http_code','last_url'
     */
    public function exec()
    {
        $response = curl_exec($this->ch);
        $error = curl_error($this->ch);
        $result = array( 'header' => '', 
                         'body' => '', 
                         'curl_error' => '', 
                         'http_code' => '',
                         'last_url' => '');
        if ( $error != "" )
        {
            $result['curl_error'] = $error;
            return $result;
        }
        
        $header_size = curl_getinfo($this->ch,CURLINFO_HEADER_SIZE);
        $result['header'] = substr($response, 0, $header_size);
        $result['body'] = substr( $response, $header_size );
        $result['http_code'] = curl_getinfo($this -> ch,CURLINFO_HTTP_CODE);
        $result['last_url'] = curl_getinfo($this -> ch,CURLINFO_EFFECTIVE_URL);
        return $result;
    }
}
?>
