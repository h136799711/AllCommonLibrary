<?php
/*
    
    CopyRight 2014 All Rights Reserved
*/

define("TOKEN", "hebidu");

include("./wxconf/user.php");

$wechatObj = new wechatCallbackapiTest();
if (!isset($_GET['echostr'])) {
    $wechatObj->responseMsg();
}else{
    $wechatObj->valid();
}



?>