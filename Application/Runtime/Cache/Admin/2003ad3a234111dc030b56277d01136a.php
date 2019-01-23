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
body{background: #eee !important;}
.myalert-wrap{width: 100%;min-height:100%;position: relative;}
.myalert-main{width: 100%;}
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
/*bootstap*/
.panel-title{display: inline-block;}
.opt-wrap{position: relative;bottom: 4px;}
ul{margin-bottom: 0;}
input[type=checkbox], input[type=radio]{margin: 0;}
/*多选框*/
.checkbox-wrap li{float: left;position: relative;margin-left:-1px;z-index: 1;min-width: 46px;height: 40px;background: #fff;border: 1px solid #e7e7e7;cursor: pointer;line-height: 40px;font-size: 13px;padding: 0 20px;}
.checkbox-wrap li:hover{border:1px solid #60aff6;z-index: 4;}
.checkbox-wrap li input{position: absolute;width:0;height: 0;left: 0;opacity: 0;cursor: pointer;}
.mychecked{border: 1px solid #60aff6 !important;background: url(/Public/assets/images/icon-selected.png) #fff no-repeat !important;background-position:bottom right !important;z-index: 5 !important;}

.sm-checkbox-wrap{background: #ddd;clear: both;overflow: hidden;padding: 5px 10px;}
.smcheck-wrap li{height: 30px !important;line-height: 30px !important;padding: 0 10px;float: left;position: relative;margin-left:-1px;z-index: 1;background: #fff;border: 1px solid #e7e7e7;cursor: pointer;}
.smcheck-wrap li:hover{border:1px solid #60aff6;z-index: 4;}
.smcheck-wrap li input{position: absolute;width:0;height: 0;left: 0;opacity: 0;cursor: pointer;}
.smchecked{border: 1px solid #60aff6 !important;background: url(/Public/assets/images/sm-icon-selected.png) #fff no-repeat !important;background-position:bottom right !important;z-index: 5 !important;}
.haschild{padding-right: 10px !important;}
.haschild i{position: relative;top: 16px;right: 25px;color: #ddd;font-size: 18px;}
.panel-item{margin-top: 15px;}
</style>
<script>
$(function(){
    
    $('.moreoption').click(function(){
        $(this).closest('.form-content').find('.mulselect').toggle();
    })
    $('.mulselect').change(function(){
        var selecteds="";
        $(this).children('option:selected').each(function(){
            selecteds+=$(this).text()+',';
        })
        selecteds=selecteds.substring(0,selecteds.length-1);
        $(this).closest('.form-content').find('input').val(selecteds);
        $(this).closest('.form-content').find('.moreoption').html(selecteds+'<i class="fa fa-sort-desc fr" style="position: relative;top: -1px;"></i>');
    })
    document.addEventListener('click',function (e) {
        var parent=$(e.target).parents('.form-content,.mulselect');
        if(parent.length===0){
            $('.mulselect').hide();
        }
    })
})
</script>
<!-- 弹窗(新增角色)-->
<div class="myalert-content">
<div class="myalert-wrap">
    <div class="myalert-main">
        <div class="layui-tab">
            <ul class="layui-tab-title">
                <li class="layui-this">基本信息</li>
                <li>权限设置</li>
            </ul>
            <div class="layui-tab-content">
                <!-- 基本信息 -->
                <div class="layui-tab-item layui-show">
                    <form class="mform">
                        <div class="form-line w50 fl">
                            <span class="form-label">名称：</span>
                            <div class="form-content" style="width: 250px;">
                                <input class="form-control" type="text" name="name" value="<?php echo ($info["name"]); ?>">
                            </div>
                        </div>
                        <div class="form-line w50 fl">
                            <span class="form-label">密码：</span>
                            <div class="form-content" style="width: 250px;">
                                <input class="form-control" type="text" name="password" value="***密码不作修改请置空***" readonly>
                            </div>
                        </div>
                        <div class="form-line w50 fl">
                            <span class="form-label">真实姓名：</span>
                            <div class="form-content" style="width: 250px;">
                                <input class="form-control" type="text" name="realname" value="<?php echo ($info["realname"]); ?>">
                            </div>
                        </div>
                        <div class="form-line w50 fl">
                            <span class="form-label">所属部门：</span>
                            <div class="form-content" style="width: 250px;">
                                <select class="form-control" name="dept">
                                    <option <?php if($info["dept"] == '技术部'): ?>selected<?php endif; ?>>技术部</option>
                                    <option <?php if($info["dept"] == '客服部'): ?>selected<?php endif; ?>>客服部</option>
                                    <option <?php if($info["dept"] == '网络部'): ?>selected<?php endif; ?>>网络部</option>
                                    <option <?php if($info["dept"] == '开发部'): ?>selected<?php endif; ?>>开发部</option>
                                    <option <?php if($info["dept"] == '销售部'): ?>selected<?php endif; ?>>销售部</option>
                                    <option <?php if($info["dept"] == '行政部'): ?>selected<?php endif; ?>>行政部</option>
                                    <option <?php if($info["dept"] == '财务部'): ?>selected<?php endif; ?>>财务部</option>
                                    <option <?php if($info["dept"] == '库房'): ?>selected<?php endif; ?>>库房</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-line w50 fl">
                            <span class="form-label">账户等级：</span>
                            <div class="form-content" style="width: 250px;">
                                <select class="form-control" name="level">
                                    <option <?php if($info["level"] == '一级'): ?>selected<?php endif; ?>>一级</option>
                                    <option <?php if($info["level"] == '二级'): ?>selected<?php endif; ?>>二级</option>
                                    <option <?php if($info["level"] == '三级'): ?>selected<?php endif; ?>>三级</option>
                                    <option <?php if($info["level"] == '四级'): ?>selected<?php endif; ?>>四级</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-line w50 fl">
                            <span class="form-label" style="position: relative;bottom: 10px;">值班机房：</span>
                            <div class="form-content" style="width: 250px;">
                                <?php $roomstr=""; foreach($merooms as $mrval){ $roomstr.=$mrval.','; } $roomstr=substr($roomstr,0,strlen($roomstr)-1); ?>
                                <span class="moreoption form-control" data-toggle="tooltip" data-placement="top" title="<?php echo $roomstr; ?>" style="display: inline-block;overflow: hidden;position: relative;line-height: 1.6;top:2px;">
                                    <?php echo $roomstr; ?><i class="fa fa-sort-desc fr" style="position: absolute;top: 10px;right: 5px;"></i>
                                </span>
                                <select multiple class="form-control mulselect" style="width: 250px;position: absolute;display: none;margin-top: -12px;">
                                    <?php foreach($roomlist as $val){ if(in_array($val,$merooms)){ echo "<option selected>".$val."</option>"; }else{ echo "<option>".$val."</option>"; } } ?>
                                </select>
                                <input name="rooms" type="hidden" value="">
                            </div>
                        </div>
                        <div class="form-line w50 fl">
                            <span class="form-label">是否主管：</span>
                            <div class="form-content" style="width: 250px;">
                                是 <input type="radio" name="ischarge" value="true"> 
                                否 <input type="radio" name="ischarge" value="false" checked>
                            </div>
                        </div>
                        <div class="form-line fl">
                            <span class="form-label">是否销售人员：</span>
                            <div class="form-content" style="width: 250px;">
                                是 <input type="radio" name="issales" value="true"> 
                                否 <input type="radio" name="issales" value="false" checked>
                            </div>
                        </div>
                        <div class="form-line w50 fl">
                            <span class="form-label" style="position: relative;bottom: 10px;">接单部门：</span>
                            <div class="form-content" style="width: 250px;">
                                <?php $recvstr=""; foreach($merecvs as $mreval){ $recvstr.=$mreval.','; } $recvstr=substr($recvstr,0,strlen($recvstr)-1); ?>
                                <span class="moreoption form-control" data-toggle="tooltip" data-placement="top" title="<?php echo $recvstr; ?>" style="display: inline-block;overflow: hidden;position: relative;line-height: 1.6;top:2px;"><?php echo $recvstr; ?><i class="fa fa-sort-desc fr" style="position: absolute;top: 10px;right: 5px;"></i></span>
                                <select multiple class="form-control mulselect" style="width: 250px;position: absolute;display: none;margin-top: -12px;">
                                    <option <?php if(in_array('技术部',$merecvs)){echo 'selected';} ?>>技术部</option>
                                    <option <?php if(in_array('客服部',$merecvs)){echo 'selected';} ?>>客服部</option>
                                    <option <?php if(in_array('网络部',$merecvs)){echo 'selected';} ?>>网络部</option>
                                    <option <?php if(in_array('开发部',$merecvs)){echo 'selected';} ?>>开发部</option>
                                    <option <?php if(in_array('销售部',$merecvs)){echo 'selected';} ?>>销售部</option>
                                    <option <?php if(in_array('行政部',$merecvs)){echo 'selected';} ?>>行政部</option>
                                    <option <?php if(in_array('财务部',$merecvs)){echo 'selected';} ?>>财务部</option>
                                    <option <?php if(in_array('库房',$merecvs)){echo 'selected';} ?>>库房</option>
                                </select>
                                <input name="recvs" type="hidden" value="">
                            </div>
                        </div>
                        <div class="form-line w50 fl">
                            <span class="form-label" style="position: relative;bottom: 10px;">带领员工：</span>
                            <div class="form-content" style="width: 250px;">
                                <span class="moreoption form-control" data-toggle="tooltip" data-placement="bottom" title="" style="display: inline-block;overflow: hidden;position: relative;line-height: 1.6;top:2px;">--请选择--<i class="fa fa-sort-desc fr" style="position: absolute;top: 10px;right: 5px;"></i></span>
                                <select multiple class="form-control mulselect" style="width: 250px;position: absolute;display: none;margin-top: -12px;">
                                    <?php if(is_array($userlist)): $i = 0; $__LIST__ = $userlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$uservo): $mod = ($i % 2 );++$i;?><option><<?php echo ($uservo["dept"]); ?>><?php echo ($uservo["realname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                                <input name="leads" type="hidden" value="">
                            </div>
                        </div>
                        <div class="form-line w50 fl">
                            <span class="form-label">是否离职：</span>
                            <div class="form-content" style="width: 250px;">
                                是 <input type="radio" name="isleave" value="true"> 
                                否 <input type="radio" name="isleave" value="false" checked>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- 权限设置 -->
                <div class="layui-tab-item">
                    <form class="mform">
                        <div class="layui-tab layui-tab-card" style="width: 100%;">
                            <ul class="layui-tab-title" style="overflow: hidden;">
                                <li class="layui-this">我的工作区</li>
                                <li>工单系统</li>
                                <li>业务管理</li>
                                <li>客户管理</li>
                                <li>订单管理</li>
                                <li>财务管理</li>
                                <li>人事管理</li>
                                <li>资源管理</li>
                                <li>系统管理</li>
                                <li>域名相关</li>
                                <li>防火墙相关</li>
                                <li>防御相关</li>
                                <li>牵引相关</li>
                                <li>自动化</li>
                                <span class="tabtoggle layui-unselect layui-tab-bar" lay-stope="tabmore" title=""><i lay-stope="tabmore" class="layui-icon"></i></span>
                            </ul>
                            <div class="layui-tab-content">
                                <?php if(is_array($powerlist)): foreach($powerlist as $k=>$vo): ?><div class="layui-tab-item <?php if($k == '我的工作区'): ?>layui-show<?php endif; ?>">
                                        <?php if(is_array($vo)): foreach($vo as $k2=>$vo2): if($k2 != '我的工单'): ?><div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title">
                                                            <?php echo ($k2); ?>
                                                        </h3>
                                                        <div class="opt-wrap fr">
                                                            <a class="btn btn-success btn-sm openall">全开</a>
                                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                                        </div>
                                                    </div>
                                                    <div class="panel-body">
                                                        <ul class="checkbox-wrap">
                                                            <?php if(is_array($vo2)): foreach($vo2 as $k3=>$vo3): ?><li <?php if($vo3[$k3] == '1'): ?>class="mychecked"<?php endif; ?>><input type="checkbox" name="<?php echo ($k); ?>-<?php echo ($k2); ?>-<?php echo ($k3); ?>" <?php if($vo3[$k3] == '1'): ?>checked<?php endif; ?> value="1"><?php echo ($k3); ?></li><?php endforeach; endif; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title">
                                                            我的工单
                                                        </h3>
                                                        <div class="opt-wrap fr">
                                                            <a class="btn btn-success btn-sm openall">全开</a>
                                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                                        </div>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="panel-item">
                                                            <ul class="checkbox-wrap">
                                                                <?php if(is_array($vo2)): foreach($vo2 as $k3=>$vo3): if(($k3 == '新工单') OR ($k3 == '领工单')): ?><li <?php if($vo3[$k3] == '1'): ?>class="mychecked"<?php endif; ?>><input type="checkbox" name="<?php echo ($k); ?>-<?php echo ($k2); ?>-<?php echo ($k3); ?>" <?php if($vo3[$k3] == '1'): ?>checked<?php endif; ?> value="1"><?php echo ($k3); ?></li><?php endif; endforeach; endif; ?>
                                                            </ul>
                                                        </div>
                                                        <?php foreach($vo2 as $key=>$val){ $keyarr=explode("_",$key); if(!empty($keyarr[1])){ if(!array_key_exists($keyarr[0], $wolist)){ $wolist[$keyarr[0]]=array($keyarr[1]=>$val); }else{ $ka0=$keyarr[0]; $wolist[$ka0][$keyarr[1]]=$val; } } } ?>
                                                        <?php if(is_array($wolist)): foreach($wolist as $k4=>$vo4): ?><div class="panel-item">
                                                                <ul class="checkbox-wrap">
                                                                    <?php $n=0; foreach($vo4 as $k5=>$v5){ if($v5=='1'){ $n++; } } if($n>0){ echo '<li class="mychecked haschild"><input type="checkbox" name="工单系统-我的工单-'.$k4.'" value="1" checked>'.$k4.'<i class="fa fa-caret-up"></i></li>'; }else { echo '<li class="haschild"><input type="checkbox" name="工单系统-我的工单-'.$k4.'" value="1">'.$k4.'<i class="fa fa-caret-up"></i></li>'; } ?>
                                                                </ul>
                                                                <div class="sm-checkbox-wrap">
                                                                    <ul class="smcheck-wrap">
                                                                        <?php foreach($vo4 as $k5=>$v5){ ?>
                                                                            <li <?php if($v5=='1'){echo 'class="smchecked"';} ?>><input type="checkbox" name="工单系统-我的工单-<?php echo ($k4); ?>_<?php echo $k5 ?>" value="1" <?php if($v5=='1'){echo 'checked';} ?>><?php echo $k5 ?></li>
                                                                        <?php } ?>
                                                                    </ul>
                                                                </div>
                                                            </div><?php endforeach; endif; ?>
                                                    </div>
                                                </div><?php endif; endforeach; endif; ?>
                                    </div><?php endforeach; endif; ?>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- 弹窗 end-->
<script>
$(function () { $("[data-toggle='tooltip']").tooltip(); }); 
$("input[type='checkbox']").click(function(){
    return false;
})
$('.tabtoggle').click(function(){
    $('.layui-tab-title').toggleClass('layui-tab-more');
})
$('.checkbox-wrap li').click(function(){
    $(this).toggleClass('mychecked');
    if($(this).find('input').attr('checked')==undefined){
        $(this).find('input').attr('checked','true');
    }else{
        $(this).find('input').removeAttr('checked');
    }
})
$('.openall').click(function(){
    $(this).closest('.panel').find('.checkbox-wrap').children('li').addClass('mychecked');
    $(this).closest('.panel').find('.smcheck-wrap').children('li').addClass('smchecked');
    $(this).closest('.panel').find('.checkbox-wrap').children('li').find('input').attr('checked','true');
    $(this).closest('.panel').find('.smcheck-wrap').children('li').find('input').attr('checked','true');
})
$('.closeall').click(function(){
    $(this).closest('.panel').find('.checkbox-wrap').children('li').removeClass('mychecked');
    $(this).closest('.panel').find('.smcheck-wrap').children('li').removeClass('smchecked');
    $(this).closest('.panel').find('.checkbox-wrap').children('li').find('input').removeAttr('checked');
    $(this).closest('.panel').find('.smcheck-wrap').children('li').find('input').removeAttr('checked');
})

$('.checkbox-wrap .haschild').click(function(){
    if(!$(this).hasClass('mychecked')){
        $(this).closest('.panel-item').find('.smcheck-wrap').children('li').removeClass('smchecked');
        $(this).closest('.panel-item').find('.smcheck-wrap').children('li').find('input').removeAttr('checked');
    }
})
$('.smcheck-wrap li').click(function(){
    $(this).toggleClass('smchecked');
    if($(this).find('input').attr('checked')==undefined){
        $(this).find('input').attr('checked','true');
    }else{
        $(this).find('input').removeAttr('checked');
    }
    var status=0;
    $(this).parent().children('li').each(function(){
        if($(this).hasClass('smchecked')){
            status+=1;
        }else{
            status+=0;
        }
    })
    if(status>0){
        $(this).closest('.panel-item').find('.haschild').addClass('mychecked');
        $(this).closest('.panel-item').find('.haschild').find('input').attr('checked','true');
    }else{
        $(this).closest('.panel-item').find('.haschild').removeClass('mychecked');
        $(this).closest('.panel-item').find('.haschild').find('input').removeAttr('checked');
    }
})
</script>
</body>
</html>