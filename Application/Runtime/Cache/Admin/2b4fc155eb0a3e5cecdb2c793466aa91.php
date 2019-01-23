<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <title>蒲公英网络CRM</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/Public/assets/css/animate.css" />
    <link rel="stylesheet" href="/Public/layui/css/layui.css" />
    <link rel="stylesheet" href="/Public/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/Public/assets/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="/Public/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="/Public/assets/css/matrix-style2.css" />
    <script src="/Public/assets/js/jquery-3.3.1.js"></script>
    <script src="/Public/layui/layui.all.js"></script>
    <script src="/Public/assets/js/wow.min.js"></script>
    <script src="/Public/bootstrap/js/bootstrap.min.js"></script>
</head>
<script>
if (!(/msie [6|7|8|9]/i.test(navigator.userAgent))){
    new WOW().init();
};

var myalert=function(title,width,height,url,yfunction){
    layer.open({
        type: 2 
        ,title: title
        ,area: [width, height]
        ,shade: 0.5
        ,maxmin: true
        ,offset:"auto"
        ,content: url
        ,btn:'确定'
        ,yes : yfunction
    });
}
$(function(){
    $("#searchbox").bind('input propertychange',function(){
        if($(this).val()!=''){
            $('.empty').show();
        }else{
            $('.empty').hide();
        }
    })
    $('.search').click(function(){
        $('.sform').submit();
    })
    $('#searchbox').bind('keyup', function(event) {
        if (event.keyCode == "13") {
            $('.sform').submit();
        }
    })
    $('.empty').click(function(){
        $("#searchbox").val('');
        $('.sform').submit();
    })
    $("#pagebox" ).bind('keyup', function(event) {
        if (event.keyCode == "13") {
            $('.gopage').click();
        }
    })
})
</script>
<body>
<style>
body{margin-top: 0 !important;font-size:14px;}
.ml15{margin-left: 15px;}
.ml10{margin-left:10px;}
.mr10{margin-right: 10px;}
.mt15{margin-top:15px;}
.mt5{margin-top:5px;}
.fl{float: left;}
.fr{float: right;}
.dib{display: inline-block;}
.db{display:block;}
.dn{display: none;}
/*bootstrap*/
.btn{padding: 7px 20px;}
.btn-sm{padding: 5px 10px !important;}
.form-control{border-radius:initial;}
.table th{text-align: left;font-size: 14px;}
.table-hover>tbody>tr:hover {background-color: #e6e6e6;}
.table>tbody>tr>td{vertical-align: middle;}
tr:hover {background: transparent;}
.label{padding: .3em .6em;}
.alert {padding: 5px 35px 5px 5px;border: 1px solid transparent;border-radius: 4px;margin-bottom: 0;}
.pagination{margin: 0;}
/* content-header */
#content-header{padding: 5px 0 10px 0;margin:0 20px;margin-top:0px !important;overflow: hidden;border-bottom: 2px solid #ddd;width: initial !important;}
.header-title{font-size: 16px;display: block;float: left;position: relative;top: 5px;}
.mysearchbox{position: relative;background: #ddd;width: 250px;height: 34px;line-height: 34px;padding: 0 24px;}
.mysearchbox input{border: none;background: #ddd;}
.mysearchbox input:focus{border-color: initial;box-shadow: initial;}
.empty{position: absolute;top: 11px;right: 11px;cursor: pointer;display: none;}
.empty:hover{color: red;}
.condition-panel{display: none;width: 100%;overflow: hidden;padding: 10px;}
.condition-panel-item{width: 16.6%;padding: 0 10px;float:left;}
.condition-panel-item .lb{margin-bottom: 10px;font-weight: bold;display: block;}
@media (max-width: 1366px) and (min-width: 481px){
#content {margin-left: 0 !important;}
.panel-group{width: 60% !important;}
}
</style>
<style>
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{font-size: 14px;border-top: 2px solid #28b779;font-size: 14px;background: #eee;}
.nav-tabs>li>a{font-size:14px;}
</style>
<div id="content" class="wow fadeIn">
    <div id="content-header">
        <span class="header-title"><i class="fa fa-file-text-o"></i> 我的工单</span>
        <button class="btn btn-info ml15 fr"><i class="fa fa-plus"></i> 新工单</button>
        <button class="btn btn-primary ml15 fr"><i class="fa fa-hand-paper-o"></i> 领工单</button>
        <div class="mysearchbox fr">
            <i class="fa fa-search" style="position: absolute;top: 11px;left: 11px;"></i>
            <input type="search" class="form-control" placeholder="请输入ip地址进行查询">
        </div>
    </div>
    <div class="container-fluid">
        <ul id="myTab" class="nav nav-tabs" style="margin-top: 10px;">
            <li class="active"><a href="#orderpool" data-toggle="tab">工单池</a></li>
            <li><a href="#inhand" data-toggle="tab">处理中</a></li>
            <li><a href="#inhand" data-toggle="tab">待确认</a></li>
            <li><a href="#inhand" data-toggle="tab">待验证</a></li>
            <li><a href="#inhand" data-toggle="tab">贷款确认</a></li>
            <li><a href="#inhand" data-toggle="tab">财务确认</a></li>
            <li><a href="#inhand" data-toggle="tab">待审核</a></li>
            <li><a href="#inhand" data-toggle="tab">上架位置确认</a></li>
            <li><a href="#inhand" data-toggle="tab">库管确认</a></li>
            <li><a href="#inhand" data-toggle="tab">未解决</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div id="orderpool" class="tab-pane fade in active">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>ID</th><th>标题</th><th>客户名称</th><th>IP地址</th><th>优先级</th><th>工单类型</th><th>处理方法</th><th>工单状态</th>
                        <th>受理部门</th><th>受理工程师</th><th>受理时间</th><th>是否超时</th><th>提交人</th><th>提交时间</th><th>操作</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </tbody>
                </table>
            </div>
            <div id="inhand" class="tab-pane fade">
                处理中
            </div>
        </div>
    </div>
</div>
</body>
</html>