<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WeiPHP-简洁而强大的开源微信公众平台开发框架 weiphp.cn</title>
<meta content="遵循Apache2开源协议,免费提供使用,微信功能插件化开发,多公众号管理,配置简单" name="keywords"/>
<meta content="weiphp 简洁而强大的开源微信公众平台开发框架微信功能插件化开发,多公众号管理,配置简单" name="description"/>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link type="text/css" rel="stylesheet" href="/weiphp/Public/Home/css/about.css?v=<?php echo SITE_VERSION;?>" />
<link type="text/css" rel="stylesheet" href="/weiphp/Public/Home/css/forum.css?v=<?php echo SITE_VERSION;?>" />
<script type="text/javascript" src="/weiphp/Public/static/jquery-2.0.3.min.js?v=<?php echo SITE_VERSION;?>"></script>
<script type="text/javascript" src="/weiphp/Public/static/bootstrap/js/bootstrap.min.js?v=<?php echo SITE_VERSION;?>"></script>
<script type="text/javascript" src="/weiphp/Public/Home/js/admin_common.js?v=<?php echo SITE_VERSION;?>"></script>
</head>
<body>
	<div class="head">
    	<div class="wrap">
        	<h1 class="fl"><a class="logo" href="<?php echo SITE_URL;?>" title="返回首页">首家开源的微信公众平台开发框架微信功能插件化开发,多公众号管理,配置简单</a></h1>
            <div class="nav">
            	<a <?php if(ACTION_NAME == 'index' and CONTROLLER_NAME == 'Index'): ?>class="cur"<?php endif; ?> href="<?php echo U('home/index/index');?>">首页</a>
                <a <?php if(ACTION_NAME == 'help'): ?>class="cur"<?php endif; ?> href="<?php echo U('home/index/help');?>">帮助中心</a>
                <a href="<?php echo U('home/index/main');?>">管理中心</a>
                <a href="http://www.weiphp.cn/wiki" target="_blank">二次开发手册</a>
            </div>
        </div>
    </div>

    <div class="banner">
    	<div class="banner_wrap">
            <h2 class="desc_pic">遵循Apache2开源协议,免费提供使用,微信功能插件化开发,多公众号管理,配置简单</h2>
            <div class="text_wrap">
                <h3 class="desc_title">简洁而强大的开源微信公众平台开发框架</h3>
                <ul>
                	<li><span>&nbsp;&nbsp;</span>产品永久开放开源。</li>
                    <li><span>&nbsp;&nbsp;</span>微信功能插件化开发，更易于定制和二次开发。</li>
                    <li><span>&nbsp;&nbsp;</span>丰富的插件库。</li>
                    <li><span>&nbsp;&nbsp;</span>支持多用户多公众号管理，满足个性化需求。</li>
                </ul>
                <a class="download" href="http://www.weiphp.cn/index.php?s=/home/index/downloadfile.html">下载1.0测试版本</a>
                <div class="getqrcode top_getqrcode">
                    <img src="/weiphp/Public/Home/images/getqrcode.jpg"/>
                    <p>微信扫码左侧二维码<br/>并加关注WeiPHP官方微信公众号<br/>体验WeiPHP的最新功能</p>
                </div>
            </div>
        </div>
    </div>
    <div class="func">
    	<ul class="wrap">
        	<li class="func_1">
            	<h4>遵循Apache2开源协议,免费提供使用</h4>
            	<p>1. 免费下载<br/>
2. 如果你修改了代码，需要在被修改的文件中说明。<br/>
3. 在延伸的代码中（修改和有源代码衍生的代码中）<br/>
    需要带有原来代码中的协议，商标，专利声明和其
    他原来作者规定需要包含的说明。</p>
            </li>
            <li class="func_2">
            	<h4>微信功能插件化开发</h4>
            	<p>1.开放的插件系统<br/>
2.个性化定制<br/>
3.方便管理，安装即可使用<br/>
4.高效快捷的二次开发</p>
            </li>
            <li class="func_3">
            	<h4>多公众号管理</h4>
            	<p>1.一个后台，多个公众号<br/>
2.对各个公众号按需授权不同<br/>
3.方便运营</p>
            </li>
            <li class="func_4">
            	<h4>配置简单</h4>
            	<p>1.强大的后台功能<br/>
2.简单配置多个微信公众号<br/>
3.数据备份<br/>
4.用户行为监控</p>
            </li>
        </ul>
    </div>
    <div class="footer">
    	<div class="wrap foot_wrap">
        	<p class="foot_nav">
            	<a href="<?php echo U('about');?>">关于我们</a>
                <a href="<?php echo U('about');?>">联系方式</a>
<!--                <a href="#">友情链接</a>
                <a href="#">版权声明</a>-->
                <a href="<?php echo U('license');?>">授权协议</a>
            </p>
            <p style="14px; padding-bottom:10px;">WeiPHP官方QQ交流群：329650736</p>
            <p class="copyright">@ 2013 - 2015 weiphp <?php echo C('WEB_SITE_ICP');?></p>
            <div class="getqrcode">
            	<img src="/weiphp/Public/Home/images/getqrcode.jpg"/>
                <p>微信扫码左侧二维码<br/>并加关注WeiPHP官方微信公众号<br/>体验WeiPHP的最新功能</p>
            </div>
            <div class="foot_logo"></div>
        </div>
    </div>
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>    
</body>
</html>