<?php
$appid = "wx9196f2ab959e57c8";
$appsecret = "5dfadfce94355c278ee4cfccd184a1cf";

$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
$result = https_request($url);
var_dump($result);

$jsoninfo = json_decode($result, true);
$access_token = $jsoninfo["access_token"];

$jsonmenu = '{
      "button":[
      {
            "name":"天气预报",
           "sub_button":[
            {
               "type":"click",
               "name":"北京天气",
               "key":"天气北京"
            },
            {
               "type":"click",
               "name":"上海天气",
               "key":"天气上海"
            },
            {
               "type":"click",
               "name":"广州天气",
               "key":"天气广州"
            },
            {
               "type":"click",
               "name":"深圳天气",
               "key":"天气深圳"
            },
            {
                "type":"view",
                "name":"本地天气",
                "url":"http://m.hao123.com/a/tianqi"
            }]
      

       },
       {
           "name":"何必都",
           "sub_button":[
            {
               "type":"view",
               "name":"公司简介",
                "url":"http://wxphp123.duapp.com/"
            },
            {
               "type":"click",
               "name":"趣味游戏",
               "key":"游戏"
            },
            {
                "type":"click",
                "name":"讲个笑话",
                "key":"笑话"
            }]
       

       }]
 }';


$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
$result = https_request($url, $jsonmenu);
var_dump($result);

function https_request($url,$data = null){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CAINFO, '/crt/curl-ca-bundle.crt');
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}

?>