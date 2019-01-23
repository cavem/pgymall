<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/Public/assets/css/animate.css" />
    <link rel="stylesheet" href="/Public/layui/css/layui.css" />
    <link rel="stylesheet" href="/Public/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/Public/assets/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="/Public/font-awesome/css/font-awesome.css" />
    <!-- <link rel="stylesheet" href="/Public/assets/css/matrix-style2.css" /> -->
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
body{margin-top: 0 !important;font-size:14px;background: #eee;}
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
.col666{color: #666;}
</style>
<!-- 弹窗(新增角色)-->
<div class="myalert-content">
<div class="myalert-wrap">
<div class="myalert-main">
    <table class="table table-bordered">
        <caption>产品信息</caption>
        <tbody>
            <tr>
                <td rowspan="7" style="width: 150px;"><img src="<?php echo ($proinfo["img"]); ?>" style="max-width: 150px;"></td>
                <td class="col666">产品类型</td>
                <td><?php echo ($proinfo["type"]); ?></td>
                <td class="col666">产品名称</td>
                <td><?php echo ($proinfo["name"]); ?></td>
            </tr>
            <tr>
                <td class="col666">生产厂家</td>
                <td><?php echo ($proinfo["vender"]); ?></td>
                <td class="col666">年份</td>
                <td><?php echo ($proinfo["time"]); ?>年</td>
            </tr>
            <tr>
                <td class="col666">香型</td>
                <td><?php echo ($proinfo["smell"]); ?></td>
                <td class="col666">执行标准</td>
                <td ><?php echo ($proinfo["standard"]); ?></td>
            </tr>
            <tr>
                <td class="col666">酒线酒花</td>
                <td><?php echo ($proinfo["line"]); ?></td>
                <td class="col666">度数</td>
                <td><?php echo ($proinfo["degree"]); ?></td>
            </tr>
            <tr>
                <td class="col666">数量</td>
                <td><?php echo ($proinfo["num"]); ?></td>
                <td class="col666">状态</td>
                <td><?php echo ($proinfo["status"]); ?></td>
            </tr>
            <tr>
                <td class="col666">描述</td>
                <td colspan="3"><?php echo ($proinfo["descr"]); ?></td>
            </tr>
        </tbody>
    </table>
    <table class="table table-bordered">
        <caption>购买信息</caption>
        <thead>
            <tr>
                <th>购买时间</th>
                <th>购买人</th>
                <th>购买价格</th>
                <th>出售价格</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo ($proinfo["buytime"]); ?></td>
                <td><?php echo ($proinfo["buyperson"]); ?></td>
                <td><?php echo ($proinfo["price"]); ?>元</td>
                <td><?php echo ($proinfo["saleprice"]); ?>元</td>
            </tr>
        </tbody>
    </table>
</div>
</div>
</div>
</body>
</html>