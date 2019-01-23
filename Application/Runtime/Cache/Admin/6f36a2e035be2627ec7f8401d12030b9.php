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
body{background: #eee !important;}
.myalert-wrap{width: 100%;min-height:100%;position: relative;}
.myalert-main{width: 100%;overflow: hidden;}
.claaa{color: #888;}
.clred{color: red;}
.td-nopad{padding: 0 !important;}
.table-in{background: #eee !important;}
/*bootstrap*/
.table>tbody>tr>td{text-align: center;vertical-align: middle;}
</style>
<!-- 弹窗(查看)-->
<div class="myalert-content">
    <div class="myalert-wrap">
        <div class="myalert-main">
            <table class="table table-bordered">
                <tr>
                    <td class="claaa">名称</td>
                    <td><?php echo ($baseinfo["name"]); ?></td>
                    <td class="claaa">超级管理员</td>
                    <td>
                        <?php if($baseinfo["super"] == '0'): ?><i class="fa fa-times clred"></i>
                        <?php else: ?>
                            <i class="fa fa-check"></i><?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td class="claaa">描述</td>
                    <td colspan="3"><?php echo ($baseinfo["descp"]); ?></td>
                </tr>
                <tr>
                    <td class="claaa">权限</td>
                    <td colspan="3" class="td-nopad">
                        <div style="height: 468px;overflow-y: scroll;margin-top: -1px;margin-left:-1px;z-index: -5;;">
                            <table class="table table-bordered" style="background: #eee;">
                                <?php if(is_array($powerlist)): foreach($powerlist as $k=>$vo): ?><tr>
                                        <td style="width: 100px; text-align: center;"><?php echo ($k); ?></td>
                                        <td class="td-nopad">
                                            <table class="table table-bordered table-in" style="margin-bottom: 0;">
                                                <tbody>
                                                    <?php if(is_array($vo)): foreach($vo as $k2=>$vo2): ?><tr>
                                                            <td style="width: 120px; text-align: center;"><?php echo ($k2); ?></td>
                                                            <td class="td-nopad">
                                                                <table class="table table-bordered table-hover table-in" style="margin-bottom: 0;">
                                                                    <tbody>
                                                                        <?php if(is_array($vo2)): foreach($vo2 as $k3=>$vo3): ?><tr class="no-perm">
                                                                                <td class="title" style="width: 140px; text-align: center;"><?php echo ($k3); ?></td>
                                                                                <td style="text-align: center;">
                                                                                    <?php if($vo3[k3] == '0'): ?><i class="fa fa-times" style="color: red;"></i>
                                                                                    <?php else: ?>
                                                                                    <i class="fa fa-check" style="color: green"></i><?php endif; ?>
                                                                                </td>
                                                                            </tr><?php endforeach; endif; ?>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr><?php endforeach; endif; ?>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr><?php endforeach; endif; ?>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>