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
<script>
    $(function(){
        $('.semll-add').click(function(){
            var confirm=function(index,layero){
                var body = layer.getChildFrame('body',index);
                var formdata = body.find('.mform').serialize();
                layer.msg('请稍等...',{icon:16});
                $.post('/Admin/Smellstand/new',formdata,function(data,status){
                    if(data==0){
                        layer.msg('添加成功',{icon:1});
                        window.location.reload();
                    }else{
                        layer.msg('添加失败',{icon:2});
                        window.location.reload();
                    }
                })
            }
            myalert('添加香型','900px','400px',"<?php echo U('Smellstand/new');?>",confirm);
        })
        $('.smell-edit').click(function(){
            var id=$(this).closest('tr').children('td:first').text();
            var confirm=function(index,layero){
                var body = layer.getChildFrame('body',index);
                var formdata = body.find('.mform').serialize();
                layer.msg('请稍等...',{icon:16});
                $.post('/Admin/Smellstand/edit',formdata+"&id="+id,function(data,status){
                    if(data==0){
                        layer.msg('修改成功',{icon:1});
                        window.location.reload();
                    }else{
                        layer.msg('修改失败',{icon:2});
                        window.location.reload();
                    }
                })
            }
            myalert('添加香型','900px','400px',"<?php echo U('Smellstand/edit');?>"+"?id="+id,confirm);
        })
    })
</script>
<div id="content" class="wow fadeIn">
    <div id="content-header">
        <span class="header-title"><i class="fa fa-list-ul"></i> 香型列表</span>
    </div>
    <div class="container-fluid">
        <div class="someopt mt15">
            <button class="btn btn-primary semll-add"><i class="fa fa-plus"></i> 添加香型</button>
        </div>
        <div class="lsit-wrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>香型</th>
                        <th>执行标准</th>
                        <th style="width: 100px;">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($smelllist)): $i = 0; $__LIST__ = $smelllist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($vo["id"]); ?></td>
                        <td><?php echo ($vo["smell"]); ?></td>
                        <td><?php echo ($vo["standard"]); ?></td>
                        <td><button class="btn btn-primary smell-edit"><i class="fa fa-pencil-square-o"></i> 编辑</button></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>