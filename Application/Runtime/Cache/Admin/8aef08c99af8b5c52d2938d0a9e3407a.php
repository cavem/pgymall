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
<link rel="stylesheet" href="/Public/assets/css/asDatepicker.css">
<script src="/Public/assets/js/jquery-asDatepicker.js" type="text/javascript"></script>
<style>
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{font-size: 14px;border-top: 2px solid #28b779;font-size: 14px;background: #eee;}
.nav-tabs>li>a{font-size:14px;}
body{background: #eee !important;}
.myalert-wrap{width: 100%;min-height:100%;position: relative;}
.myalert-main{width: 100%;overflow: hidden;}
/*基本信息*/
/*基本信息*/
.form-line{height: 40px;line-height: 40px;margin: 10px 0;}
.form-label{display:inline-block;width: 150px;text-align: right;font-weight: bold;}
.w50{width: 50%;text-align: left;}
.form-content{width: 700px;text-align: left;display: inline-block;}
.form-control{display: initial;}
.tab-content{padding: 10px;}
/*layui*/
.layui-tab{margin: 0;}
.layui-tab-title{background: #fff;}
.layui-tab-title .layui-this{color: #28b779;background: #eee;}
.layui-tab-title .layui-this:after{border-bottom-color:transparent;border-top-color: #28b779;}
.calendar-icon{border: initial;}
.calendar_active .calendar-icon{border: initial;}
.calendar-input{border:1px solid #ccc;}
</style>
<script>
$(function(){
    //多选
    $('.moreoption').click(function(){
        $(this).closest('.form-content').find('.mulselect').toggle();
    })
    
    document.addEventListener('click',function (e) {
        var parent=$(e.target).parents('.form-content,.mulselect');
        if(parent.length===0){
            $('.mulselect').hide();
        }
    })
    $('.mulselect').change(function(){
        var selecteds="";
        $(this).children('option:selected').each(function(){
            selecteds+=$(this).text()+',';
        })
        selecteds=selecteds.substring(0,selecteds.length-1);
        $(this).closest('.form-content').find('input').val(selecteds);
        $(this).closest('.form-content').find('.moreoption').html(selecteds+'<i class="fa fa-sort-desc fr" style="position: absolute;top: 10px;right: 5px;"></i>');
    })
    $('.moreoption').hover(function(){
        $(this).attr('title','按住Ctrl多选');
    })
    //香型-标准
    $("select[name='smell']").change(function(){
        var smell=$(this).children("option:selected").val();
        $.post("/Admin/Product/getstandard",{"smell":smell},function(data,status){
            data=JSON.parse(data);
            var shelfcon='<option value="">--请选择--</option>';
            for(var i in data){
                shelfcon+='<option>'+data[i]+'</option>';
            }
            $("select[name='standard']").html(shelfcon);
        })
    })
    //时间
    $("input[name='buytime']").asDatepicker();
    //上传图片
    $('.upload').click(function(){
        $('.file').click();
    })
    $(".file").bind('change', function () {
        var filedata=new FormData(document.getElementById("fileform"));
        $.ajax({
　　　　　　　　url : '/Admin/Product/uploadimg', 
　　　　　　　　type : "post",
　　　　　　　　data : filedata, //第二个Form表单的内容
　　　　　　　　processData : false,
　　　　　　　　contentType : false,
　　　　　　　　error : function(request) {
　　　　　　　　},
　　　　　　　　success : function(data) {
　　　　　　　　　　$("input[name='img']").val(data);
                  $('.idimg').attr("src",data);
　　　　　　　  }
　　　　　});
    });
    //根据产品名称自动匹配厂家
    $("input[name='name']").blur(function(){
        var tval=$(this).val();
        if(tval!=""){
            $.post('/Admin/Product/getvender',{name:tval},function(data,status){
                $("input[name='vender']").val(data);
            })
        }
        
    })
})
</script>
<!-- 弹窗(新增角色)-->
<div class="myalert-content">
<div class="myalert-wrap">
<div class="myalert-main">
    <form class="mform">
        <div class="form-line w50 fl">
            <span class="form-label" style="position: relative;bottom: 7px;">产品类型：</span>
            <div class="form-content" title="按住ctrl多选" style="width: 250px;">
                <span class="moreoption form-control" style="display: inline-block;overflow: hidden;position: relative;line-height: 1.6;top:3px;">--请选择--<i class="fa fa-sort-desc fr" style="position: absolute;top: 10px;right: 5px;"></i></span>
                <select multiple class="form-control mulselect" style="width: 250px;position: absolute;display: none;margin-top: -12px;">
                    <option>8大名酒</option>
                    <option>17大名酒</option>
                    <option>53优名酒</option>
                    <option>其它</option>
                </select>
                <input name="type" type="hidden" value="">    
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">产品名称：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="name">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">生产厂家：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="vender">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">年份：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="time">
            </div> 年
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">香型：</span>
            <div class="form-content" style="width: 250px;">
                <select class="form-control" name="smell">
                    <option value="">--请选择--</option>
                    <?php if(is_array($smelllist)): foreach($smelllist as $key=>$vo): ?><option><?php echo ($vo["smell"]); ?></option><?php endforeach; endif; ?>
                </select>
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">执行标准：</span>
            <div class="form-content" style="width: 250px;">
                <select class="form-control" name="standard">
                    <option value="">--请选择--</option>
                </select>
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">酒线酒花：</span>
            <div class="form-content" style="width: 250px;">
                <select class="form-control" name="line">
                    <option value="">--请选择--</option>
                    <option>完美</option>
                    <option>合格</option>
                    <option>喝品</option>
                    <option>废品</option>
                </select>
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">度数：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="degree">
            </div>度
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">购买时间：</span>
            <div class="form-content" style="width: 250px;">
                <input id="buytime" class="form-control" type="text" name="buytime">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">购买人：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="buyperson">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">购买价格：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="price">
            </div> 元
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">销售价格：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="saleprice">
            </div> 元
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">数量：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="num">
            </div> 瓶
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">当前状态：</span>
            <div class="form-content" style="width: 250px;">
                <select class="form-control" name="status">
                    <option>库存</option>
                    <option>喝掉</option>
                    <option>送人</option>
                </select>
            </div>
        </div>
        <div class="form-line fl" style="height: 74px;">
            <span class="form-label" style="position: relative;bottom: 35px;">产品描述：</span>
            <div class="form-content" style="width: 700px;">
                <textarea class="form-control" rows="3" name="descr"></textarea>
            </div>
        </div>
        <div class="form-line fl">
            <span class="form-label">产品图片：</span>
            <div class="form-content" style="width:618px;">
                <input type="text" name="img" class="form-control" readonly>
            </div>
            <a class="btn btn-primary upload" style="position: relative;bottom: 1px;">上传</a>
        </div>
        <img class="idimg" style="margin-left:150px;max-height: 150px;display: block;">
    </form>
    <form class="fileform" id="fileform">
        <input type="file" name="file" class="file" id="fileField" size="28" style="display: none;">
    </form>
</div>
</div>
</div>
</body>
</html>