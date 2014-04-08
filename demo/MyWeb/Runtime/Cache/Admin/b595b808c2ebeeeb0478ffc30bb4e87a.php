<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
      <meta name="description" content="tp1的继承示例">
      <meta name="keywords" content="关键词">
      <meta name="author" content="作者">

    
	<title>tp1的继承示例</title>


    <!-- Bootstrap core CSS -->
    <link href="/Public/lib/bootstrap3/css/bootstrap.css?v=<?php echo C('SITE_VERSION');?>" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="/Public/css/bd-admin.css?v=<?php echo C('SITE_VERSION');?>" rel="stylesheet">
    
     <!--[if lt IE 9]>
    <script type="text/javascript" src="/Public/lib/jquery/jquery-1.10.2.min.js?v=<?php echo C('SITE_VERSION');?>"></script>
    <![endif]--><!--[if gte IE 9]><!-->
    <script type="text/javascript" src="/Public/lib/jquery/jquery-2.0.3.min.js?v=<?php echo C('SITE_VERSION');?>"></script>

    <!-- JavaScript -->
    <script type="text/JavaScript" src="/Public/lib/bootstrap3/js/bootstrap.js?v=<?php echo C('SITE_VERSION');?>"></script>

    

  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top bd-navbar" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">导航</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html"><?php echo ((isset($WMS_NAME) && ($WMS_NAME !== ""))?($WMS_NAME):"后台管理"); ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav bd-side-nav">


            <li class="active"><a href="index.html"><i class="fa fa-dashboard"></i> 控制台</a></li>
            <li><a href="charts.html"><i class="fa fa-bar-chart-o"></i> 图表</a></li>
            <li><a href="tables.html"><i class="fa fa-table"></i> 表格</a></li>
            <li><a href="forms.html"><i class="fa fa-edit"></i> 表单</a></li>
            <li><a href="typography.html"><i class="fa fa-font"></i> 印刷样式</a></li>
            <li><a href="bootstrap-elements.html"><i class="fa fa-desktop"></i> Bootstrap 元素</a></li>
            <li><a href="bootstrap-grid.html"><i class="fa fa-wrench"></i> Bootstrap 格子</a></li>
            <li><a href="blank-page.html"><i class="fa fa-file"></i> 空白页面</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> 下拉 <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">下拉项</a></li>
                <li><a href="#">另一个项</a></li>
                <li><a href="#">第三项</a></li>
                <li><a href="#">最后一项</a></li>
              </ul>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown messages-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> 消息 <span class="badge">7</span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">7 新消息</li>
                <li class="message-preview">
                  <a href="#">
                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
                    <span class="name">A:</span>
                    <span class="message">我想要问你些事情...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                  </a>
                </li>
                <li class="divider"></li>
                <li class="message-preview">
                  <a href="#">
                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
                    <span class="name">A:</span>
                    <span class="message">我想要问你些事情...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                  </a>
                </li>
                <li class="divider"></li>
                <li class="message-preview">
                  <a href="#">
                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
                   <span class="name">A:</span>
                    <span class="message">我想要问你些事情...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                  </a>
                </li>
                <li class="divider"></li>
                <li><a href="#">查看收信箱 <span class="badge">7</span></a></li>
              </ul>
            </li>
            <li class="dropdown alerts-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> 警告 <span class="badge">3</span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">默认 <span class="label label-default">默认</span></a></li>
                <li><a href="#">原始 <span class="label label-primary">原始</span></a></li>
                <li><a href="#">成功 <span class="label label-success">成功</span></a></li>
                <li><a href="#">信息 <span class="label label-info">信息</span></a></li>
                <li><a href="#">警告 <span class="label label-warning">警告</span></a></li>
                <li><a href="#">危险 <span class="label label-danger">危险</span></a></li>
                <li class="divider"></li>
                <li><a href="#">查看所有</a></li>
              </ul>
            </li>
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> 陈晓航 <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#"><i class="fa fa-user"></i> 个人信息</a></li>
                <li><a href="#"><i class="fa fa-envelope"></i> 收信箱 <span class="badge">7</span></a></li>
                <li><a href="#"><i class="fa fa-gear"></i> 配置</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="fa fa-power-off"></i> 登出</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">
          
	<p>tp1的继承示例</p>

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- Page Specific Plugins 
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <script src="js/morris/chart-data-morris.js"></script>
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>-->

    


  </body>
</html>