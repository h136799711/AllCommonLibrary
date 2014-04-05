<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
<meta content="遵循Apache2开源协议,免费提供使用,微信功能插件化开发,多公众号管理,配置简单" name="keywords"/>
<meta content="weiphp 首家开源的微信公众平台开发框架微信功能插件化开发,多公众号管理,配置简单" name="description"/>
<title><?php echo C('WEB_SITE_TITLE');?></title>
<link href="/weiphp/Public/static/bootstrap/css/bootstrap.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet">
<link href="/weiphp/Public/static/bootstrap/css/bootstrap-responsive.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet">
<link href="/weiphp/Public/static/bootstrap/css/docs.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet">
<link href="/weiphp/Public/static/bootstrap/css/onethink.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet">
<link href="/weiphp/Public/Home/css/weiphp.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="/weiphp/Public/static/bootstrap/js/html5shiv.js?v=<?php echo SITE_VERSION;?>"></script>
<![endif]-->

<!--[if lt IE 9]>
<script type="text/javascript" src="/weiphp/Public/static/jquery-1.10.2.min.js?v=<?php echo SITE_VERSION;?>"></script>
<![endif]-->
<!--[if gte IE 9]><!-->
<script type="text/javascript" src="/weiphp/Public/static/jquery-2.0.3.min.js?v=<?php echo SITE_VERSION;?>"></script>
<script type="text/javascript" src="/weiphp/Public/static/bootstrap/js/bootstrap.min.js?v=<?php echo SITE_VERSION;?>"></script>
<script type="text/javascript" src="/weiphp/Public/Home/js/admin_common.js?v=<?php echo SITE_VERSION;?>"></script>
<script type="text/javascript">
        +function(){
            var $window = $(window), $subnav = $("#subnav"), url;
            $window.resize(function(){
                $("#main").css("min-height", $window.height() - 130);
            }).resize();

	        /* 表单获取焦点变色 */
	        $("form").on("focus", "input", function(){
		        $(this).addClass('focus');
	        }).on("blur","input",function(){
				        $(this).removeClass('focus');
			        });
		    $("form").on("focus", "textarea", function(){
			    $(this).closest('label').addClass('focus');
		    }).on("blur","textarea",function(){
			    $(this).closest('label').removeClass('focus');
		    });
        }();
</script>
<!--<![endif]-->
<!-- 页面header钩子，一般用于加载插件CSS文件和代码 -->
<?php echo hook('pageHeader');?>

</head>
<body id="login_body">
	<!-- 头部 -->
	<!-- 导航条
================================================== -->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" title="<?php echo C('WEB_SITE_TITLE');?>" href="<?php echo U('index/index');?>"><img src="/weiphp/Public/Home/images/weiphp_logo.png?v=<?php echo SITE_VERSION;?>" title="<?php echo C('WEB_SITE_TITLE');?>"/></a>
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <?php $__NAV__ = M('Channel')->field(true)->where("status=1")->order("sort")->select(); if(is_array($__NAV__)): $i = 0; $__LIST__ = $__NAV__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i; if(($nav["pid"]) == "0"): ?><li>
                            <a href="<?php echo (get_nav_url($nav["url"])); ?>" target="<?php if(($nav["target"]) == "1"): ?>_blank<?php else: ?>_self<?php endif; ?>"><?php echo ($nav["title"]); ?></a>
                        </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <div class="nav-collapse collapse pull-right">
                <?php if(is_login()): ?><ul class="nav" style="margin-right:0">
                    	<li class="dropdown">
                            <a href="#" class="dropdown-toggle login-nav" data-toggle="dropdown" style="padding-left:0;padding-right:0"><?php echo ($member_public["public_name"]); ?><b class="caret"></b></a>
                            <ul class="dropdown-menu" style="display:none">
                            	<li><a href="<?php echo U('home/MemberPublic/lists');?>">公众号管理</a></li>
                                <?php if(is_array($member_public_list)): $i = 0; $__LIST__ = $member_public_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('home/MemberPublic/changPublic','id='.$vo['id']);?>"><?php echo ($vo["public_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle login-nav" data-toggle="dropdown" style="padding-left:0;padding-right:0"><?php echo get_username();?> <b class="caret"></b></a>
                            <ul class="dropdown-menu" style="display:none">
                                <li><a href="<?php echo U('Admin/index/index');?>">后台管理</a></li>
                                <li><a href="<?php echo U('User/profile');?>">修改密码</a></li>
                                <li><a href="<?php echo U('User/logout');?>">退出</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php else: ?>
                    <ul class="nav" style="margin-right:0">
                    	<li style="padding-right:20px">你好!欢迎来到<?php echo C('WEB_SITE_TITLE');?></li>
                        <li>
                            <a href="<?php echo U('User/login');?>">登录</a>
                        </li>
                        <li>
                            <a href="<?php echo U('User/register');?>">注册</a>
                        </li>
                        <li>
                            <a href="<?php echo U('admin/index/index');?>" style="padding-right:0">后台入口</a>
                        </li>
                    </ul><?php endif; ?>
            </div>
        </div>
    </div>
</div>
<link href="/weiphp/Public/Home/css/module.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet">
<script type="text/javascript" src="/weiphp/Public/static/uploadify/jquery.uploadify.min.js?v=<?php echo SITE_VERSION;?>"></script>
	<!-- /头部 -->
	
	<!-- 主体 -->
	
<header class="jumbotron subhead" id="overview">
  <div class="container">
    <h2>用户登录</h2>
    <p><span><span class="pull-left"><span>还没有账号? <a href="<?php echo U('User/register');?>">立即注册</a></span> </span></p>
  </div>
</header>

<div id="main-container" class="container">
  <div class="row">
<!--     -->
     
    
<section class="login_box" style="margin-top:150px">
	<form class="login-form" action="/weiphp/index.php?s=/home/user/login.html" method="post">
    	  <div class="form_title">
          	登&nbsp;&nbsp;&nbsp;录
          </div>
          <div class="form_body">
          		<div class="input_panel">
                  <div class="control-group">
                    <label class="control-label" for="inputEmail">用户名</label>
                    <div class="controls">
                      <input type="text" id="inputEmail" class="span3" placeholder="请输入用户名"  ajaxurl="/member/checkUserNameUnique.html" errormsg="请填写1-16位用户名" nullmsg="请填写用户名" datatype="*1-16" value="" name="username">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="inputPassword">密码</label>
                    <div class="controls">
                      <input type="password" id="inputPassword"  class="span3" placeholder="请输入密码"  errormsg="密码为6-20位" nullmsg="请填写密码" datatype="*6-20" name="password">
                    </div>
                  </div>
               </div>
              <?php if(C('WEB_SITE_VERIFY')) { ?>
              <div class="control-group">
                <label class="control-label" for="inputPassword">验证码</label>
                <div class="controls">
                  <input type="text" id="inputPassword" class="span3" placeholder="请输入验证码"  errormsg="请填写5位验证码" nullmsg="请填写验证码" datatype="*5-5" name="verify">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label"></label>
                <div class="controls">
                    <img class="verifyimg reloadverify" alt="点击切换" src="<?php echo U('verify');?>" style="cursor:pointer;">
                </div>
              </div>
              <?php } ?>
              <div class="controls Validform_checktip text-warning"></div>
              <div class="control-group">
                <div class="controls">
                  <label class="checkbox">
                    <input type="checkbox"> 自动登陆
                  </label>
                  <br/>
                  <button type="submit" class="btn">登 陆</button>
                </div>
              </div>
          </div>
       </form>
</section>

  </div>
</div>
<script type="text/javascript">
    $(function(){
        $(window).resize(function(){
            $("#main-container").css("min-height", $(window).height() - 241);
        }).resize();
    })
</script>
	<!-- /主体 -->

	<!-- 底部 -->
	
    <!-- 底部
    ================================================== -->
<footer class="footer">
      <div class="container">
      	  <p class="foot_nav"><a href="<?php echo U('Home/Index/about');?>" target="_blank">关于我们</a><a href="<?php echo U('home/index/help');?>">使用说明</a></p>
          <p> 本系统由 <strong><a href="http://www.weiphp.cn" target="_blank">weiphp</a></strong> 强力驱动</p>
      </div>
</footer>

<script type="text/javascript">
(function(){
	var ThinkPHP = window.Think = {
		"ROOT"   : "/weiphp", //当前网站地址
		"APP"    : "/weiphp/index.php?s=", //当前项目地址
		"PUBLIC" : "/weiphp/Public", //项目公共目录地址
		"DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
		"MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
		"VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
	}
})();
</script>

	<script type="text/javascript">

    	$(document)
	    	.ajaxStart(function(){
	    		$("button:submit").addClass("log-in").attr("disabled", true);
	    	})
	    	.ajaxStop(function(){
	    		$("button:submit").removeClass("log-in").attr("disabled", false);
	    	});


    	$("form").submit(function(){
    		var self = $(this);
    		$.post(self.attr("action"), self.serialize(), success, "json");
    		return false;

    		function success(data){
    			if(data.status){
    				window.location.href = data.url;
    			} else {
    				self.find(".Validform_checktip").text(data.info);
    				//刷新验证码
    				$(".reloadverify").click();
    			}
    		}
    	});

		$(function(){
			var verifyimg = $(".verifyimg").attr("src");
            $(".reloadverify").click(function(){
                if( verifyimg.indexOf('?')>0){
                    $(".verifyimg").attr("src", verifyimg+'&random='+Math.random());
                }else{
                    $(".verifyimg").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
                }
            });
		});
	</script>
 <!-- 用于加载js代码 -->
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
	
</div>

	<!-- /底部 -->
</body>
</html>