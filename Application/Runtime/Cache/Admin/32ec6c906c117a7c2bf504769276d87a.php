<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>管理员登录</title>
	<link rel="stylesheet" type="text/css" href="/Public/assets/css/login.css">
	<script src="/Public/assets/js/jquery-3.3.1.js" type="text/javascript"></script>
</head>
<script>
	$(function(){
		$('.loginin').click(function(){
			var formdata = $('.mform').serialize();
			if($("input[name='name']").val()==''){
				alert('请输入用户名！');
			}else if($("input[name='password']").val()==''){
				alert('请输入密码！');
			}else{
				$.post('login',formdata,function(data,status){
					if(data==0){
						window.location.href='/Admin/Index/index';
					}else{
						alert(data);
					}
				})
			}
		})
		$('#namebox,#psdbox').bind('keyup', function(event) {
			if (event.keyCode == "13") {
				$('.loginin').click();
			}
		})
	})
</script>
<body>
	<article class="htmleaf-container">
		<header class="htmleaf-header">
			<h1>管理员登录</h1>
			<div class="htmleaf-links">
				
			</div>
		</header>
		<div class="panel-lite">
		  <div class="thumbur">
		    <div class="icon-lock"></div>
		  </div>
			<h4>用户登录</h4>
			<form class="mform">
				<div class="form-group">
					<input id="namebox" required="required" name="name" class="form-control"/>
					<label class="form-label">用户名    </label>
				</div>
				<div class="form-group">
					<input id="psdbox" type="password" required="required" name="password" class="form-control"/>
					<label class="form-label">密　码</label>
				</div><a href="javacript:;" onclick="alert('请联系管理员！');">忘记密码 ?  </a>
				
			</form>
			<button class="floating-btn loginin"><i class="icon-arrow"></i></button>
		</div>
		
	</article>
	
</body>
</html>