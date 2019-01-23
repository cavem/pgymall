<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php echo ($title); ?></title>
		<link rel="icon" href="/Public/assets/images/logo.png" />
		<link rel="stylesheet" href="/Public/assets/css/animate.css" />
		<link rel="stylesheet" type="text/css" href="/Public/assets/css/style.css">
		<link rel="stylesheet" type="text/css" href="/Public/assets/css/bootstrap.slider.css">
		<script src="/Public/assets/js/jquery-3.3.1.js" type="text/javascript"></script>
		<script src="/Public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="/Public/assets/js/wow.min.js"></script>
	</head>
	<style>
		body{background: #eee;}
		.mt50{margin-top: 50px;}
		.nav{margin-left: 50px;}
		.banner_x .logo{width: 234px;background: url('/Public/assets/images/logo.png') no-repeat;text-align: center;height: 60px;line-height: 60px;}
		.tu a img{height: 150px;}
		.remen img{opacity: 0.9;}
		.remen img:hover{opacity: 1;}
		.mbtn {display: block;max-width: 200px;text-align: center;font-size: 28px;padding: 6px 12px;color: #ff6700;border: 1px solid #ff6700;}
		.mbtn:hover{background: #ff6700;color: #fff;}
		.mysearchbox{position: relative;background: #eee;width: 250px;height: 34px;line-height: 34px;padding: 0 24px;}
		.mysearchbox input{border: none;background: #eee;}
		.mysearchbox input:focus{border-color: initial;box-shadow: initial;}
		.empty{position: absolute;top: 11px;right: 11px;cursor: pointer;display: none;}
		.empty:hover{color: red;}
	</style>
	<script>
		if (!(/msie [6|7|8|9]/i.test(navigator.userAgent))){
			new WOW().init();
		};
		$(function(){
			$('#myCarousel').carousel({
				interval:5000
			});
			$("#searchbox").bind('input propertychange',function(){
				if($(this).val()!=''){
					$('.empty').show();
				}else{
					$('.empty').hide();
				}
			})
			$('.empty').click(function(){
				$("#searchbox").val('');
				$('.sform').submit();
			})
		})
	</script>
	<body>
	<!-- start header -->
		<header>
			<div class="top center">
				<div class="left fl">
					<ul>
						<li><a href="<?php echo U('Index/index');?>">首页</a></li>
						<li>|</li>
						<li><a href="">咨询电话：18888888888</a></li>
						<li>|</li>
						<li><a href="">QQ：88888</a></li>
						<div class="clear"></div>
					</ul>
				</div>
				<div class="right fr">
					<div class="fr">
						<ul>
							<?php if($_SESSION['loginuser']['adminname']== ''): ?><li><a href="<?php echo U('Admin/Login/index');?>" target="_blank">登录</a></li>
								<li>|</li>
								<li><a href="<?php echo U('Admin/Login/index');?>" target="_blank" >注册</a></li>
							<?php else: ?>
								<li><a href="<?php echo U('Admin/Index/index');?>" target="_blank">控制台</a></li><?php endif; ?>
						</ul>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
		</header>
	<!--end header -->
	<!-- start banner_x -->
	<div class="banner_wrap" style="width: 100%;background: #333;border-top: 0.5px solid #444;">
	<div class="banner_x center">
		<a href="<?php echo U('Index/index');?>"><div class="logo fl"></div></a>
		<div class="nav fl">
			<ul>
				<li><a href="<?php echo U('Index/index');?>">首页</a></li>
				<li><a href="<?php echo U('Index/prolist');?>?type=8大名酒">8大名酒</a></li>
				<li><a href="<?php echo U('Index/prolist');?>?type=17大名酒">17大名酒</a></li>
				<li><a href="<?php echo U('Index/prolist');?>?type=53优名酒">53优名酒</a></li>
				<li><a href="<?php echo U('Index/prolist');?>?type=其它">其它</a></li>
			</ul>
		</div>
	</div>
	</div>
	<!-- end banner_x -->
<style>
	.item-content{width: 1226px;margin: 0 auto;color: #fff;padding: 80px;}
	.item-content-text{width: 50%;float: left;}
	.item-content-text .descp{color: #736f6f;}
	.item-content-text .pric{font-size: 28px;color: #dc9919;font-weight: bold;}
	.item-content-img{width: 50%;float: left;}
	.item-content-img img{max-height: 390px;}
</style>
		<!-- start banner_y -->
		<div class="banner_y center" style="width: 100%;height: 550px;">
			<div class="nav-right fl" style="width: 100%;min-width: 1226px;height: 550px;background:url(/Public/assets/images/slider_bg.jpg) #555 no-repeat center;background-size:cover;">
				<div id="myCarousel" class="carousel slide">
						<!-- 轮播（Carousel）指标 -->
						<ol class="carousel-indicators">
							<?php if(is_array($navlist)): $k = 0; $__LIST__ = $navlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li data-target="#myCarousel" data-slide-to="<?php echo ($k-1); ?>" <?php if($k == '1'): ?>class="active"<?php endif; ?>></li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ol>   
						<!-- 轮播（Carousel）项目 -->
						<div class="carousel-inner">
							<?php if(is_array($navlist)): $k = 0; $__LIST__ = $navlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="item <?php if($k == 1): ?>active<?php endif; ?>">
								<div class="item-content">
									<div class="item-content-text">
										<h1 class="wow fadeInUp" data-wow-delay="0.5s"><?php echo ($vo["name"]); ?></h1>
										<p class="mt50 descp wow fadeInUp" data-wow-delay="0.5s"><?php echo ($vo["descr"]); ?></p>
										<p class="mt50 pric wow bounceInUp" data-wow-delay="0.5s">￥<?php echo ($vo["saleprice"]); ?></p>
										<a class="mt20 mbtn wow bounceIn" data-wow-delay="0.5s" href="<?php echo U('Index/detail');?>?id=<?php echo ($vo["id"]); ?>" target="_blank">查看</a>
									</div>
									<div class="item-content-img">
										<img class="fr wow bounceInRight" data-wow-delay="0.5s" src="<?php echo ($vo["img"]); ?>">
									</div>
								</div>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
						<!-- 轮播（Carousel）导航 -->
						<a class="carousel-control left" href="#myCarousel" 
							data-slide="prev">&lsaquo;</a>
						<a class="carousel-control right" href="#myCarousel" 
							data-slide="next">&rsaquo;</a>
				</div>
			</div>
		</div>
		<!-- start danpin -->
		<div class="peijian w">
			<div class="biaoti center wow fadeInUp">8大名酒</div>
			<div class="main center">
				<div class="content">
					<?php if($balist[0] == ''): ?><div class="remen fl wow zoomIn">
							<img src="/Public/assets/images/empty.png" style="margin-top: 90px;">
							<p>暂无产品</p>
						</div>
					<?php else: ?>
					<?php if(is_array($balist)): $i = 0; $__LIST__ = $balist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="remen fl wow zoomIn">
						<div class="xinpin"><span>精品</span></div>
						<div class="tu"><a href="<?php echo U('Index/detail');?>?id=<?php echo ($vo["id"]); ?>" target="_blank" ><img style="max-width: 160px;" src="<?php echo ($vo["img"]); ?>"></a></div>
						<div class="miaoshu"><a href="<?php echo U('Index/detail');?>?id=<?php echo ($vo["id"]); ?>" target="_blank" ><?php echo ($vo["name"]); ?></a></div>
						<div class="jiage"><?php echo ($vo["saleprice"]); ?>元</div>
						<div class="pingjia"><?php echo ($vo["time"]); ?>年</div>
						<div class="piao">
							<a href="<?php echo U('Index/detail');?>?id=<?php echo ($vo["id"]); ?>" target="_blank">
								<span><?php echo ($vo["descr"]); ?></span>
							</a>
						</div>
					</div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
					<div class="remen fl wow zoomIn">
						<div class="" style="margin-top: 79px;"><a href="<?php echo U('Index/prolist');?>?type=8大名酒"><img src="/Public/assets/images/liulangengduo.png" alt=""></a></div>					
					</div>
					<div class="clear"></div>
				</div>				
			</div>
		</div>
		<div class="peijian w">
			<div class="biaoti center wow fadeInUp">17大名酒</div>
			<div class="main center">
				<div class="content">
					<?php if($sqlist[0] == ''): ?><div class="remen fl wow zoomIn">
							<img src="/Public/assets/images/empty.png" style="margin-top: 90px;">
							<p>暂无产品</p>
						</div>
					<?php else: ?>
					<?php if(is_array($sqlist)): $i = 0; $__LIST__ = $sqlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="remen fl wow zoomIn">
						<div class="xinpin"><span>精品</span></div>
						<div class="tu"><a href="<?php echo U('Index/detail');?>?id=<?php echo ($vo["id"]); ?>" target="_blank" ><img style="max-width: 160px;" src="<?php echo ($vo["img"]); ?>"></a></div>
						<div class="miaoshu"><a href="<?php echo U('Index/detail');?>?id=<?php echo ($vo["id"]); ?>" target="_blank" ><?php echo ($vo["name"]); ?></a></div>
						<div class="jiage"><?php echo ($vo["saleprice"]); ?>元</div>
						<div class="pingjia"><?php echo ($vo["time"]); ?>年</div>
						<div class="piao">
							<a href="<?php echo U('Index/detail');?>?id=<?php echo ($vo["id"]); ?>" target="_blank">
								<span><?php echo ($vo["descr"]); ?></span>
							</a>
						</div>
					</div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
					<div class="remen fl wow zoomIn">
						<div class="" style="margin-top: 79px;"><a href="<?php echo U('Index/prolist');?>?type=17大名酒"><img src="/Public/assets/images/liulangengduo.png" alt=""></a></div>					
					</div>
					<div class="clear"></div>
				</div>				
			</div>
		</div>
		<div class="peijian w">
			<div class="biaoti center wow fadeInUp">53优名酒</div>
			<div class="main center">
				<div class="content">
					<?php if($wslist[0] == ''): ?><div class="remen fl wow zoomIn">
							<img src="/Public/assets/images/empty.png" style="margin-top: 90px;">
							<p>暂无产品</p>
						</div>
					<?php else: ?>
					<?php if(is_array($wslist)): $i = 0; $__LIST__ = $wslist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="remen fl wow zoomIn">
						<div class="xinpin"><span>精品</span></div>
						<div class="tu"><a href="<?php echo U('Index/detail');?>?id=<?php echo ($vo["id"]); ?>" target="_blank" ><img style="max-width: 160px;" src="<?php echo ($vo["img"]); ?>"></a></div>
						<div class="miaoshu"><a href="<?php echo U('Index/detail');?>?id=<?php echo ($vo["id"]); ?>" target="_blank" ><?php echo ($vo["name"]); ?></a></div>
						<div class="jiage"><?php echo ($vo["saleprice"]); ?>元</div>
						<div class="pingjia"><?php echo ($vo["time"]); ?>年</div>
						<div class="piao">
							<a href="<?php echo U('Index/detail');?>?id=<?php echo ($vo["id"]); ?>" target="_blank">
								<span><?php echo ($vo["descr"]); ?></span>
							</a>
						</div>
					</div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
					<div class="remen fl wow zoomIn">
						<div class="" style="margin-top: 79px;"><a href="<?php echo U('Index/prolist');?>?type=53优名酒"><img src="/Public/assets/images/liulangengduo.png" alt=""></a></div>					
					</div>
					<div class="clear"></div>
				</div>				
			</div>
		</div>
		<div class="peijian w">
			<div class="biaoti center wow fadeInUp">其它</div>
			<div class="main center">
				<div class="content">
					<?php if($qtlist[0] == ''): ?><div class="remen fl wow zoomIn">
							<img src="/Public/assets/images/empty.png" style="margin-top: 90px;">
							<p>暂无产品</p>
						</div>
					<?php else: ?>
					<?php if(is_array($qtlist)): $i = 0; $__LIST__ = $qtlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="remen fl wow zoomIn">
							<div class="xinpin"><span>精品</span></div>
							<div class="tu"><a href="<?php echo U('Index/detail');?>?id=<?php echo ($vo["id"]); ?>" target="_blank" ><img style="max-width: 160px;" src="<?php echo ($vo["img"]); ?>"></a></div>
							<div class="miaoshu"><a href="<?php echo U('Index/detail');?>?id=<?php echo ($vo["id"]); ?>" target="_blank" ><?php echo ($vo["name"]); ?></a></div>
							<div class="jiage"><?php echo ($vo["saleprice"]); ?>元</div>
							<div class="pingjia"><?php echo ($vo["time"]); ?>年</div>
							<div class="piao">
								<a href="<?php echo U('Index/detail');?>?id=<?php echo ($vo["id"]); ?>" target="_blank">
									<span><?php echo ($vo["descr"]); ?></span>
								</a>
							</div>
						</div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
					<div class="remen fl wow zoomIn">
						<div class="" style="margin-top: 79px;"><a href="<?php echo U('Index/prolist');?>?type=其它"><img src="/Public/assets/images/liulangengduo.png" alt=""></a></div>					
					</div>
					<div class="clear"></div>
				</div>				
			</div>
		</div>
    <footer class="mt20 center" style="background: #333;color: #fff;">			
        <div class="mt20"></div>
        <!-- <div>京ICP证110507号 京ICP备10046444号 京公网安备11010802020134号 京网文[2014]0059-0009号</div>  -->
        <div>违法和不良信息举报电话：185-0130-1238，本网站所列数据，除特殊说明，所有数据均出自我司实验室测试</div>
    </footer>
</body>
</html>