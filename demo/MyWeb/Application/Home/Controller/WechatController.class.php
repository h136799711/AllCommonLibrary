<?php

namespace Home\Controller;
use Think\Controller;

class WechatController extends Controller {
	public function test(){		
		$wechatObj =new \Org\Util\Wechat;
		var_dump($wechatObj);
	}
	/*
	* 微信接口
	* @uid 
	*/
    public function index($uid=0){
		define("TOKEN", "hebidu");
		$wechatObj = D('Wechat','Logic');
		
		$DEFAULT_REPLY[] = array("Title"=>"车世家", "Description"=>"", "PicUrl"=>"http://discuz.comli.com/weixin/weather/icon/cartoon.jpg", "Url" =>"http://wxphp123.duapp.com");
        $DEFAULT_REPLY[] = array("Title"=>"新车销售", "Description"=>"", "PicUrl"=>"http://d.hiphotos.bdimg.com/wisegame/pic/item/f3529822720e0cf3ac9f1ada0846f21fbe09aaa3.jpg", "Url" =>"http://wxphp123.duapp.com");
        $DEFAULT_REPLY[] = array("Title"=>"点击进入我们的微网站", "Description"=>"点击进入我们的微网站", "PicUrl"=>"http://g.hiphotos.bdimg.com/wisegame/pic/item/18cb0a46f21fbe090d338acc6a600c338644adfd.jpg", "Url" =>"http://wxphp123.duapp.com");
		//
		$conf = array("WECHAT_NAME"=>"wechat",
					"SUPPORTERS"=>"wechat",
					"DEFAULT_REPLY"=>$DEFAULT_REPLY,
					"SUBSCRIBE_MSG"=>$DEFAULT_REPLY
			);
		$wechatObj->configure($conf);
		//dump($wechatObj);
    	if (!isset($_GET['echostr'])) {
			$wechatObj->responseMsg();
		}else{
			$wechatObj->valid();
		}
   }

   public function send($uname='wx9196f2ab959e57c8',$pass='5dfadfce94355c278ee4cfccd184a1cf',$fromuser='gh_b5ffd9df92d7'){
			$arr = array(
				'appid' => $uname,
				'secret' => $pass//,
				//'fromuser' => $fromuser 
			);
			$w = D('WxMessage','Logic');
			
			echo '登录结果：'.($w->login($arr));
			$data = $w->getAllUserInfo();//获取用户信息
			var_dump($data); 
			//echo '<br/>群发给所有用户测试：';
			//$data = $w->sendMessage('群发测试',"text"); //群发给所有用户		
			
			
			//echo '<br/>text<br/>总用户数：'.$data["total"].'<br/>成功发送：'.$data["successed"]; 
		$articles = "[         {
             \"title\":\"Happy Day\",
             \"description\":\"Is Really A Happy Day\",
             \"url\":\"http://data.useit.com.cn/useitdata/forum/201311/23/214706dbij2yppairejx55.png.thumb.jpg\",
             \"picurl\":\"http://data.useit.com.cn/useitdata/forum/201311/23/214706dbij2yppairejx55.png.thumb.jpg\"
         },
         {
         \"title\":\"Happy Day\",
             \"description\":\"Is Really A Happy Day\",
             \"url\":\"http://data.useit.com.cn/useitdata/forum/201311/23/214706dbij2yppairejx55.png.thumb.jpg\",
             \"picurl\":\"http://data.useit.com.cn/useitdata/forum/201311/23/214706dbij2yppairejx55.png.thumb.jpg\"
         }       ]";
			$data = $w->sendMessage($articles,"news"); //群发给所有用户		
			
			echo '<br/>news<br/>总用户数：'.$data["total"].'<br/>成功发送：'.$data["successed"]; 
		
   }


}