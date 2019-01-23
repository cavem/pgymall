<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
    <title>后台管理</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="/Public/assets/images/logo.png" />
    <link rel="stylesheet" href="/Public/assets/css/animate.css" />
    <link rel="stylesheet" href="/Public/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/Public/assets/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="/Public/assets/css/matrix-style.css" />
    <link rel="stylesheet" href="/Public/assets/css/matrix-media.css" />
    <link href="/Public/font-awesome/css/font-awesome.css" rel="stylesheet" />
  </head>
  <style>
    #user-nav{right: 0;}
    #breadcrumb{line-height: 38px;}
    #breadcrumb a{padding: 8px 12px;}
  .nav{margin-bottom: 0px;}
  .nav-tabs{border-bottom: 0px solid #fff;}
  .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{font-size: 14px;color: #28b779 !important;border-top: 2px solid #28b779;font-size: 14px;background: #eee;}
  .tab-content{overflow: initial;}
  .closetab{color: #aaa;font-size: 14px;cursor: pointer;}
  .closetab:hover{color: #666;}
  </style>
  <body>
    <div id="header">
      <h1>
        <a href="dashboard.html">后台管理</a></h1>
    </div>
    <div id="user-nav" class="navbar navbar-inverse">
      <ul class="nav">
        <li class="dropdown" id="profile-messages">
          <a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle">
            <i class="fa fa-user"></i>&nbsp;
            <span class="text">欢迎你，admin</span>&nbsp;
            <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li>
              <a href="#">
                <i class="icon-user"></i>个人资料</a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="#">
                <i class="icon-check"></i>我的任务</a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="login.html">
                <i class="icon-key"></i>退出系统</a>
            </li>
          </ul>
        </li>
        
        <li class="">
          <a title="" href="<?php echo U('Index/loginout');?>">
            <i class="fa fa-sign-out"></i>
            <span class="text">&nbsp;退出系统</span></a>
        </li>
      </ul>
    </div>

    <!-- 侧边栏 -->
    <div id="sidebar" style="overflow-y: auto; overflow-x: hidden; height: 899px;">
      <ul>
        <li class="submenu active">
          <a class="menu_a" link="<?php echo U('Product/list');?>" childid="product"><i class="fa fa-cog"></i><span>产品管理</span></a>
        </li>
        <li class="submenu">
            <a href="#"><i class="fa fa-suitcase"></i><span>其它管理</span></a>
            <ul>
              <li>
                <a class="menu_a" link="<?php echo U('Smellstand/list');?>" childid="smellstand"><i class="fa fa-list"></i>香型管理</a>
              </li>
              <li>
                <a class="menu_a" link="<?php echo U('Vendername/list');?>" childid="vendername"><i class="fa fa-list"></i>厂家管理</a>
              </li>
            </ul>
        </li>
      </ul>
    </div>
    <!-- 侧边栏 end -->
    <div id="content">
      <div id="content-header">
        <div id="breadcrumb">
            <ul id="myTab" class="nav nav-tabs" style="float: left;">
                <li class="active"><a href="#product" data-toggle="tab"><i class="fa fa-cog"></i>产品管理</a></li>
            </ul>
            <a href="javascript:;" title="刷新" class="tip-bottom refresh" style="float: right;color: #28b779;padding: 0;"><i class="fa fa-refresh fa-2x"></i></a>
        </div>
      </div>
      <div id="myTabContent" class="tab-content">
        <div id="product" class="tab-pane fade in active"><iframe src="<?php echo U('Product/list');?>" class="iframe-main" frameborder='0' style="width:100%;"></iframe></div>
      </div>
    </div>
    <script src="/Public/assets/js/jquery-3.3.1.js"></script>
    <script src="/Public/assets/js/wow.min.js"></script>
    <script src="/Public/assets/js/jquery.ui.custom.js"></script>
    <script src="/Public/bootstrap/js/bootstrap.min.js"></script>
    <script src="/Public/assets/js/jquery.nicescroll.min.js"></script>
    <script src="/Public/assets/js/matrix.js"></script>
    <script>
        if (!(/msie [6|7|8|9]/i.test(navigator.userAgent))){
            new WOW().init();
        };
    </script>
    <script type="text/javascript">//初始化相关元素高度
      function init() {
        $("body").height($(window).height() - 80);
        $(".iframe-main").height($(window).height() - 90);
        $("#sidebar").height($(window).height() - 50);
      }

      $(function() {
        init();
        $(window).resize(function() {
          init();
        });
        $('.refresh').click(function(){
            $('#myTab').find('.active').find('.closetab').trigger('click');
            $('#sidebar .active').find('.menu_a').trigger('click');
        })
        
      });

      // This function is called from the pop-up menus to transfer to
      // a different page. Ignore if the value returned is a null string:
      function goPage(newURL) {
        // if url is empty, skip the menu dividers and reset the menu selection to default
        if (newURL != "") {
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-") {
            resetMenu();
          }
          // else, send page to designated URL            
          else {
            document.location.href = newURL;
          }
        }
      }

      // resets the menu selection upon entry to this page:
      function resetMenu() {
        document.gomenu.selector.selectedIndex = 2;
      }

      // uniform使用示例：
      // $.uniform.update($(this).attr("checked", true));
      </script>
  </body>

</html>