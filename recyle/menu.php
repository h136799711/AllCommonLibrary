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
            "name":"����Ԥ��",
           "sub_button":[
            {
               "type":"click",
               "name":"��������",
               "key":"��������"
            },
            {
               "type":"click",
               "name":"�Ϻ�����",
               "key":"�����Ϻ�"
            },
            {
               "type":"click",
               "name":"��������",
               "key":"��������"
            },
            {
               "type":"click",
               "name":"��������",
               "key":"��������"
            },
            {
                "type":"view",
                "name":"��������",
                "url":"http://m.hao123.com/a/tianqi"
            }]
      

       },
       {
           "name":"�αض�",
           "sub_button":[
            {
               "type":"view",
               "name":"��˾���",
                "url":"http://wxphp123.duapp.com/"
            },
            {
               "type":"click",
               "name":"Ȥζ��Ϸ",
               "key":"��Ϸ"
            },
            {
                "type":"click",
                "name":"����Ц��",
                "key":"Ц��"
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