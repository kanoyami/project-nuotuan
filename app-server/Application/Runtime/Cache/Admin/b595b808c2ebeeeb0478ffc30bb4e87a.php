<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js fixed-layout">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin index</title>
  <meta name="description" content="这是一个 index 页面">
  <meta name="keywords" content="index">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="icon" type="image/png" href="/nuotuan/Public/admin/i/favicon.png">
  <link rel="apple-touch-icon-precomposed" href="/nuotuan/Public/admin/i/app-icon72x72@2x.png">
  <meta name="apple-mobile-web-app-title" content="Amaze UI" />
  <link rel="stylesheet" href="/nuotuan/Public/admin/css/amazeui.min.css"/>
  <link rel="stylesheet" href="/nuotuan/Public/admin/css/admin.css">


</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->
<header class="am-topbar admin-header">
  <div class="am-topbar-brand">
    <strong>糯团APP</strong> <small>后台管理</small>
  </div>

  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

    <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
      <li class="am-dropdown" data-am-dropdown>
        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
          <span class="am-icon-users"></span> 管理员 <span class="am-icon-caret-down"></span>
        </a>
        <ul class="am-dropdown-content">
          <li><a href="<?php echo U('Public/passwd');?>"><span class="am-icon-cog"></span> 修改密码</a></li>
          <li><a href="<?php echo U('Public/logout');?>"><span class="am-icon-power-off"></span> 退出</a></li>
        </ul>
      </li>
      <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>
    </ul>
  </div>
</header>
<div class="am-cf admin-main">
  <!-- sidebar start -->
  <div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
    <div class="am-offcanvas-bar admin-offcanvas-bar">
      <ul class="am-list admin-sidebar-list">
        <li><a href="<?php echo U('Index/index') ;?>"><span class="am-icon-home"></span> 首页</a></li>
        
        <li class="admin-parent">
          <a class="am-cf" data-am-collapse="{target: '#collapse-nav'}"><span class="am-icon-users"></span> 社团后台管理<span class="am-icon-angle-right am-fr am-margin-right"></span></a>
         
          <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav">
            <li><a href="<?php echo U('GroupDate/glist') ;?>" class="am-cf"><span class="am-icon-list"></span> 社团列表<span class=" am-fr am-margin-right admin-icon-yellow"></span></a></li>

             <li><a href="<?php echo U('GroupDate/add') ;?>" class="am-cf"><span class="am-icon-plus"></span> 新增社团<span class=" am-fr am-margin-right admin-icon-yellow"></span></a></li>

            
          </ul>
        </li>
      
      </ul>



      <div class="am-panel am-panel-default admin-sidebar-panel">
        <div class="am-panel-bd">
          <p><span class="am-icon-tag"></span> About creater</p>
          <p>邮箱：Kanoyami@92loli.com </p>
          <p>QQ：448264919 </p>
        </div>
      </div>
    </div>
  </div>
  <!-- sidebar end -->

  <!-- content start -->
  <div class="admin-content">


<img src="/nuotuan/Public/admin/about.jpg">



</div>
  <!-- content end -->
<a href="#" class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>


</div>



<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="/nuotuan/Public/admin/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="/nuotuan/Public/admin/js/jquery.min.js"></script>
<!--<![endif]-->
<script src="/nuotuan/Public/admin/js/amazeui.min.js"></script>
<script src="/nuotuan/Public/admin/js/app.js"></script>
</body>
</html>