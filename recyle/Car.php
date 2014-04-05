<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="http://wxphp123.duapp.com/static/css/reset.css?v=2014-03-24-1" media="all" />
<link rel="stylesheet" type="text/css" href="http://wxphp123.duapp.com/static/css/snower.css?v=2014-03-24-1" media="all" />
<link rel="stylesheet" type="text/css" href="http://wxphp123.duapp.com/static/css/common.css?v=2014-03-24-1" media="all" />
<link rel="stylesheet" type="text/css" href="http://wxphp123.duapp.com/static/css/home.css?v=2014-03-24-1" media="all" />
<script type="text/javascript" src="http://wxphp123.duapp.com/static/scripts/maivl.js?v=2014-03-07-1"></script>
<script type="text/javascript" src="http://wxphp123.duapp.com/static/scripts/jQuery.js?v=2014-03-24-1"></script>
<script type="text/javascript" src="http://wxphp123.duapp.com/static/scripts/swipe.js?v=2014-03-07-1"></script>
<script type="text/javascript" src="http://wxphp123.duapp.com/static/scripts/zepto.js?v=2014-03-07-1"></script>
<title>汽车之家</title>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
        <meta name="Keywords" content="微网站" />
        <meta name="Description" content="微网站Test" />
        <!-- Mobile Devices Support @begin -->
            <meta content="application/xhtml+xml;charset=UTF-8" http-equiv="Content-Type">
            <meta content="no-cache,must-revalidate" http-equiv="Cache-Control">
            <meta content="no-cache" http-equiv="pragma">
            <meta content="0" http-equiv="expires">
            <meta content="telephone=no, address=no" name="format-detection">
            <meta name="apple-mobile-web-app-capable" content="yes" /> <!-- apple devices fullscreen -->
            <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        <!-- Mobile Devices Support @end -->
        <link rel="shortcut icon" href="http://wxphp123.duapp.com/favicon.ico" />
    </head>
    <body onselectstart="return true;" ondragstart="return false;">
        
<link rel="stylesheet" type="text/css" href="http://wxphp123.duapp.com/static/css/font-awesome.css?v=2014032413" media="all" />

<div class="body">
		<!--
	幻灯片管理
	-->
	<div style="-webkit-transform:translate3d(0,0,0);">
		<div id="banner_box" class="box_swipe">
			<ul>
									<li>
												<a onclick="return false;">
																<img src="http://wxphp123.duapp.com/static/images/1.jpg" alt="全新一代E级轿车/E级运动轿车" style="width:100%;" />
								</a>
					</li>
									<li>
												<a onclick="return false;">
																<img src="http://wxphp123.duapp.com/static/images/2.jpg" alt="全新一代梅赛德斯-奔驰S级轿车" style="width:100%;" />
								</a>
					</li>
									<li>
												<a onclick="return false;">
																<img src="http://wxphp123.duapp.com/static/images/3.jpg" alt="全新CLS猎装版" style="width:100%;" />
								</a>
					</li>
							</ul>
			<ol>
									<li class="on"></li>
									<li ></li>
									<li ></li>
							</ol>
		</div>
	</div>
		<script>
		$(function(){
			new Swipe(document.getElementById('banner_box'), {
				speed:500,
				auto:3000,
				callback: function(){
					var lis = $(this.element).next("ol").children();
					lis.removeClass("on").eq(this.index).addClass("on");
				}
			});
		});
	</script>
<br/>            <section>
            <a href="tel:0574-28872887" class="link_tel icon-phone">0574-28872887</a>
        </section>
        		<!--
		用户分类管理
		-->
		<section>
            <ul class="list_ul">
                                    <li>
													<a href="#">
													<figure>
								<div>
									<img src="http://wxphp123.duapp.com/static/images/x1.jpg" />
								</div>
								<figcaption>
									新车销售									<p>新车销售</p>
								</figcaption>
							</figure>
                        </a>
                    </li>
                                    <li>
													<a href="#">
													<figure>
								<div>
									<img src="http://wxphp123.duapp.com/static/images/x1.jpg" />
								</div>
								<figcaption>
									试驾预约									<p>试驾预约</p>
								</figcaption>
							</figure>
                        </a>
                    </li>
                                    <li>
													<a href="#">
													<figure>
								<div>
									<img src="http://wxphp123.duapp.com/static/images/x1.jpg" />
								</div>
								<figcaption>
									大客户销售									<p>大客户销售</p>
								</figcaption>
							</figure>
                        </a>
                    </li>
                                    <li>
													<a href="#">
													<figure>
								<div>
									<img src="http://wxphp123.duapp.com/static/images/x1.jpg" />
								</div>
								<figcaption>
									售后预约									<p>售后预约</p>
								</figcaption>
							</figure>
                        </a>
                    </li>
                                    <li>
													<a href="#">
													<figure>
								<div>
									<img src="http://wxphp123.duapp.com/static/images/x1.jpg" />
								</div>
								<figcaption>
									金融保险									<p>金融保险</p>
								</figcaption>
							</figure>
                        </a>
                    </li>
                                    <li>
													<a href="#">
													<figure>
								<div>
									<img src="http://wxphp123.duapp.com/static/images/x1.jpg" />
								</div>
								<figcaption>
									绍兴汽车									<p>企业文化</p>
								</figcaption>
							</figure>
                        </a>
                    </li>
                            </div>
        </section>
    </div>

<!--
导航菜单
   后台设置的快捷菜单
-->
			<section>
			<div class="plug-div">
				<div id="plug-phone" class="plug-phone">
										<input type="checkbox" id="plug-btn" class="plug-menu" style="background-color:#1B1BB7;" />
											<div style="background-color:#1B1BB7; ">
															<a href="tel:0574-28872887" class="icon-phone"></a>
													</div>
									</div>
			</div>
		</section>
		<script>
			window.addEventListener("DOMContentLoaded", function(){
				btn = document.getElementById("plug-btn");
				btn.onclick = function(){
					var divs = document.getElementById("plug-phone").querySelectorAll("div");
					var className = className=this.checked?"on":"";
					for(i = 0;i<divs.length; i++){
						divs[i].className = className;
					}
					if(document.getElementById("plug-wrap")){
						document.getElementById("plug-wrap").style.display = "on" == className? "block":"none";
					}
				}
			}, false);
		</script>
	
<!--
分享前控制
-->
	<script type="text/javascript">
		window.shareData = {
			"imgUrl": "",
			"timeLineLink": "http://www.xxx.com/weisite/home?pid=3593&bid=7573&wechatid=fromUsername&wxref=mp.weixin.qq.com",
			"sendFriendLink": "http://www.xxx.com/weisite/home?pid=3593&bid=7573&wechatid=fromUsername&wxref=mp.weixin.qq.com",
			"weiboLink": "http://www.xxx.com/weisite/home?pid=3593&bid=7573&wechatid=fromUsername&wxref=mp.weixin.qq.com",
			"tTitle": "",
			"tContent": "",
			"fTitle": "",
			"fContent": "",
			"wContent": ""
		};
			</script>
        			<footer style="overflow:visible;">
				<div class="xxx-copyright" style="padding-bottom:50px;">
					<a href="#">© 绍兴汽车 技术支持unknow</a>
				</div>
									<span class="xxx-support" style="display:none;">©unknow提供</span>
							</footer>
				<div mark="stat_code" style="width:0px; height:0px; display:none;">
					</div>
					<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F9571c37530746ef8ef9fbd3e5b5ebe2e' type='text/javascript'%3E%3C/script%3E"));
</script>

	</body>
		<script type="text/javascript">
function xxxAfterShare(shareFromWechatId,sendFriendLink,shareToPlatform){
	var wmShare = document.createElement('script'); wmShare.type = 'text/javascript'; wmShare.async = true;
    wmShare.src = 'http://' + getShareApiRouter() + '/api-share.js?fromWechatId=' + shareFromWechatId + '&shareToPlatform=';
	wmShare.src += shareToPlatform + '&pid=3593&sendFriendLink=' + encodeURIComponent(sendFriendLink);
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(wmShare, s);
}
function getShareApiRouter(){
	var str_domain = location.href.split('/',4)[2];
	var tj_domain = '127.0.0.1';
	switch(str_domain){
		case 'www.xxx.com':
			tj_domain = 'tj.xxx.com';
			break;
		case '112.124.28.82':
			tj_domain = '112.124.28.82:400';
			break;
	}
	return tj_domain;
}
if(typeof(window.shareData) == 'undefined'){
	window.shareData = {
				"imgUrl": "", 
		"timeLineLink": "http://www.xxx.com/weisite/home?pid=3593&bid=7573&wechatid=fromUsername&wxref=mp.weixin.qq.com",
		"sendFriendLink": "http://www.xxx.com/weisite/home?pid=3593&bid=7573&wechatid=fromUsername&wxref=mp.weixin.qq.com",
		"weiboLink": "http://www.xxx.com/weisite/home?pid=3593&bid=7573&wechatid=fromUsername&wxref=mp.weixin.qq.com",
		"tTitle": document.title,
		"tContent": document.title,
		"fTitle": document.title,
		"fContent": document.title,
		"wContent": document.title
	}
}
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {	 
	// 发送给好友
	WeixinJSBridge.on('menu:share:appmessage', function (argv) {
		WeixinJSBridge.invoke('sendAppMessage', { 
			"img_url": window.shareData.imgUrl,
			"img_width": "640",
			"img_height": "640",
			"link": window.shareData.sendFriendLink,
			"desc": window.shareData.fContent,
			"title": window.shareData.fTitle
		}, function (res) {
			xxxAfterShare("ovC2gjlEqK5819sZXS--aWk43W5s",window.shareData.sendFriendLink,'appmessage');
			_report('send_msg', res.err_msg);
		})
	});

	// 分享到朋友圈
	WeixinJSBridge.on('menu:share:timeline', function (argv) {
		WeixinJSBridge.invoke('shareTimeline', {
			"img_url": window.shareData.imgUrl,
			"img_width": "640",
			"img_height": "640",
			"link": window.shareData.timeLineLink,
			"desc": window.shareData.tContent,
			"title": window.shareData.tTitle
		}, function (res) {
						//xxxAfterShare("ovC2gjlEqK5819sZXS--aWk43W5s",window.shareData.timeLineLink,'timeline');
			_report('timeline', res.err_msg);
		});
	});

	// 分享到微博
	WeixinJSBridge.on('menu:share:weibo', function (argv) {
		WeixinJSBridge.invoke('shareWeibo', {
			"content": window.shareData.wContent,
			"url": window.shareData.weiboLink
		}, function (res) {
			xxxAfterShare("ovC2gjlEqK5819sZXS--aWk43W5s",window.shareData.weiboLink,'weibo');
			_report('weibo', res.err_msg);
		});
	});
}, false);
</script>
<script type="text/javascript" src="http://kf.xxx.com/js/ChatFloat.js"></script>
<script type="text/javascript">

new ChatFloat({
        AId: '3593',
        openid: "ovC2gjlEqK5819sZXS--aWk43W5s",
		top:150,
		right:0
});
</script>
</html>

