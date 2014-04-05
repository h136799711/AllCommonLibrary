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
<body>
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
	
<div id="main-container" class="container">
  <div class="row">
<!--    
      <div class="span3 bs-docs-sidebar">
        
        <ul class="nav nav-list bs-docs-sidenav">
          <?php echo W('Category/lists', array($category['id'], ACTION_NAME == 'index'));?>
        </ul>
      </div>
    -->
     
  <div class="span3 bs-docs-sidebar">
<?php $m = strtolower(MODULE_NAME); $c = strtolower(CONTROLLER_NAME); $a = strtolower(ACTION_NAME); $ad = ucfirst ( parse_name ( $_REQUEST['_addons'], 1 ) ); $navClass[$ad] = 'active'; $navClass[$m.'_'.$c.'_'.$a] = 'active'; $addonList = D ( 'Addons' )->getWeixinList (); ?>
    <ul class="nav nav-list bs-docs-sidenav">
      <li class="<?php echo ($navClass['home_memberpublic_lists']); ?>"> <a href="<?php echo U('Home/MemberPublic/lists');?>"> <i class="icon-chevron-right"></i>公众号管理 </a> </li>
      <li class="<?php echo ($navClass['home_index_main']); ?>"> <a href="<?php echo U('Home/Index/main');?>"> <i class="icon-chevron-right"></i>功能设置 </a> </li>
      <?php if(is_array($addonList)): $i = 0; $__LIST__ = $addonList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="<?php echo ($navClass[$vo[name]]); ?>"> <a href="<?php echo ($vo[addons_url]); ?>" title="<?php echo ($vo["description"]); ?>"> 
      <i class="icon-chevron-right"><?php if(!empty($vo['icon'])) { ?> <img src="<?php echo ($vo["icon"]); ?>" /> <?php } ?> </i>
      <?php echo ($vo["title"]); ?> </a> </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
  </div>

    
  <div class="span9 page_message">
    <section id="contents"> <ul class="tab-nav nav">
  <?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="<?php echo ($vo["class"]); ?>"><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<div id="top-alert" class="fixed alert alert-error" style="display: none;">
  <button class="close fixed" style="margin-top: 4px;">&times;</button>
  <div class="alert-content">这是内容</div>
</div>

      <div class="cf">
        <div class="fl"> </div>
        <!-- 高级搜索 -->
        <div class="search-form fr cf">
          <div class="sleft">
            <input type="text" name="<?php echo ((isset($model['search_key']) && ($model['search_key'] !== ""))?($model['search_key']):'title'); ?>" class="search-input" value="<?php echo I('title');?>" placeholder="请输入关键字">
            <a class="sch-btn" href="javascript:;" id="search" url="<?php echo U('main',array('model'=>$model['name']));?>"><i class="btn-search"></i></a> </div>
        </div>
      </div>
      
      <!-- 数据列表 -->
      <div class="data-table">
        <div class="data-table table-striped">
          <table>
            <!-- 表头 -->
            <thead>
              <tr>
                <th width="100">名称</th>
                <th>描述</th>
                <th width="50">状态</th>
                <th width="50">操作</th>
              </tr>
            </thead>
            
            <!-- 列表 -->
            <tbody>
              <?php if(is_array($list_data)): $i = 0; $__LIST__ = $list_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr style="color: <?php echo ($data["color"]); ?>">
                  <td><?php echo ($data["title"]); ?></td>
                  <td><?php echo ($data["description"]); ?></td>
                  <td><?php echo ($data["status_title"]); ?></td>
                  <td><a href="<?php echo U('setStatus','addon='.$data['name'].'&status='.$data['status']);?>"><?php echo ($data["action"]); ?></a></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="page"> <?php echo ((isset($_page) && ($_page !== ""))?($_page):''); ?> </div>
    </section>
  </div>

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
$(function(){
	//搜索功能
	$("#search").click(function(){
		var url = $(this).attr('url');
        var query  = $('.search-form').find('input').serialize();
        query = query.replace(/(&|^)(\w*?\d*?\-*?_*?)*?=?((?=&)|(?=$))/g,'');
        query = query.replace(/^&/g,'');
        if( url.indexOf('?')>0 ){
            url += '&' + query;
        }else{
            url += '?' + query;
        }
		window.location.href = url;
	});

    //回车自动提交
    $('.search-form').find('input').keyup(function(event){
        if(event.keyCode===13){
            $("#search").click();
        }
    });

})
</script> 
 <!-- 用于加载js代码 -->
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
	
</div>

	<!-- /底部 -->
</body>
</html>