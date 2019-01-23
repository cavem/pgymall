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
<script src="/Public/DatePicker/WdatePicker.js" type="text/javascript"></script>
<style>
.square{width: 34px;height: 34px;background: #28b779;color: #fff;text-align: center;line-height: 34px;cursor: pointer;}
a{color: #337ab7;}
a:hover{color: #23527c;}
.tr-active{background: #8bd6b6 !important};
.updown{display: inline-block;width: 20px;position: relative;top: 7px;text-align: center;background: #eee;}
.updown span{display: block;cursor: pointer;color: #999;}
.updown span:hover{color: #111;}
</style>
<script>
$(function(){
    $("[data-toggle='tooltip']").tooltip();
    $('.table-hover tbody tr').hover(function(){
        $(this).find('.operate-btns').show();
    },function(){
        $(this).find('.operate-btns').hide();
    })
    $('.username').click(function(){
        // $('.text-username').text($(this).text());
        // $('.alert').show();
        window.location.href="<?php echo U('Service/list');?>"+"?custname="+$(this).text();
    })
    $('.close').click(function(){
        $('.sform').submit();
    })
    $('.condition-ctrl').click(function(){
        if($(this).find('i').hasClass('fa-caret-down')){
            $(this).find('i').removeClass('fa-caret-down');
            $(this).find('i').addClass('fa-caret-up');
            $('.lsit-wrap').css({"height":"580px","overflow":"auto"});
        }else{
            $(this).find('i').removeClass('fa-caret-up');
            $(this).find('i').addClass('fa-caret-down');
            $('.lsit-wrap').css({"height":"","overflow":"auto"});
        }
        $('.condition-panel').toggle();
    })
    $("select[name='idcname']").change(function(){
        var idcname=$(this).children("option:selected").val();
        var meshelfcode=$('.meshelfcode').val();
        $.post("/Service/getshelf",{"idcname":idcname},function(data,status){
            data=JSON.parse(data);
            var shelfcon='<option value="">--请选择--</option>';
            for(var i in data){
                shelfcon+='<option value="'+data[i]['code']+'">'+data[i]['code']+'</option>';
            }
            $("select[name='shelfcode']").html(shelfcon);
        })
    })
    $('.gopage').click(function(){
        var cpage=$('.cpage').val();
        window.location.href="<?php echo U('Service/list');?>"+"?p="+cpage;
    })
    $('.edit').click(function(){
        var servid=$(this).closest('tr').children('td:first').text();
        var confirm=function(index,layero){
            //获取iframe的body元素
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            layer.msg('请稍等...',{icon:16});
            $.post('/Service/edit',"ID="+servid+"&"+formdata,function(data,status){
                if(data==0){
                    layer.msg('修改成功',{icon:1});
                    window.location.reload();
                }else{
                    layer.msg('修改失败',{icon:2});
                    window.location.reload();
                }
            })
        }
        myalert('修改服务器','900px','660px',"<?php echo U('Service/edit');?>"+"?servid="+servid,confirm);
    })
    $('.view').click(function(){
        var servid=$(this).closest('tr').children('td:first').text();
        var confirm=function(index,layero){
            layer.closeAll();
        }
        myalert('查看服务器','900px','660px',"<?php echo U('Service/view');?>"+"?servid="+servid,confirm);
    })
    $('.remove').click(function(){
        var servid=$(this).closest('tr').children('td:first').text();
        layer.confirm('确定删除【'+servid+'】?', {
            btn: ['确定','取消']
        }, function(){
            $.post("/Service/remove",{"servid":servid},function(data,status){
                if(data==0){
                    layer.msg('删除成功',{icon:1});
                    window.location.reload();
                }else{
                    layer.msg('删除失败',{icon:2});
                    window.location.reload();
                }
            })
        });
    })
    $('.install').click(function(){
        var servid=$(this).closest('tr').children('td:first').text();
        var confirm=function(index,layero){
            //获取iframe的body元素
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            layer.msg('请稍等...',{icon:16});
            $.post('/Service/install',"ID="+servid+"&"+formdata,function(data,status){
                if(data==0){
                    layer.msg('修改成功',{icon:1});
                    window.location.reload();
                }else{
                    layer.msg('修改失败',{icon:2});
                    window.location.reload();
                }
            })
        }
        myalert('系统安装','900px','660px',"<?php echo U('Service/install');?>"+"?servid="+servid,confirm);
    })
    $('.export').click(function(){
        layer.msg('请稍等...',{icon:16});
    })
    $('.increase').click(function(){
        window.location.href="<?php echo U('Service/list');?>"+"?sc=asc";
    })
    $('.reduce').click(function(){
        window.location.href="<?php echo U('Service/list');?>"+"?sc=desc";
    })
})
</script>
<div id="content" class="wow fadeIn">
    <div id="content-header">
        <span class="header-title"><i class="fa fa-server"></i> 服务器管理</span>
        <?php if($custname != ''): ?><div class="alert alert-warning alert-dismissable fl ml15">
                <button type="button" class="close" aria-hidden="true">
                    &times;
                </button>
                客户名称：<b class="text-username"><?php echo ($custname); ?></b>
            </div><?php endif; ?>
        <div class="square fr search">
            <i class="fa fa-search" style="font-size: 14px;"></i>
        </div>
        <form class="sform" action="<?php echo U('Service/list');?>" method="POST">
        <div class="mysearchbox fr">
            <i class="fa fa-search search" style="position: absolute;top: 11px;left: 11px;"></i>
            <input id="searchbox" type="search" name="keyword" class="form-control" placeholder="请输入查询内容">
            <i class="fa fa-times empty"></i>
        </div>
        <div class="square fr condition-ctrl">
            <i class="fa fa-caret-down"></i>
        </div>
        <div class="condition-panel">
            <div class="condition-panel-item">
                <span class="lb">到期日期【开始】</span>
                <input type="text" name="" class="form-control" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});">
            </div>
            <div class="condition-panel-item">
                <span class="lb">到期日期【结束】</span>
                <input type="text" class="form-control" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});">
            </div>
            <div class="condition-panel-item">
                <span class="lb">服务器状态</span>
                <select class="form-control" name="servstate">
                    <option value="">--请选择--</option>
                    <option value="在线运行">在线运行</option>
                    <option value="闲置空机">闲置空机</option>
                    <option value="终止合同">终止合同</option>
                    <option value="期满移出">期满移出</option>
                    <option value="暂出维护">暂出维护</option>
                    <option value="下架">下架</option>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">所在机房</span>
                <select class="form-control" name="idcname">
                    <option value="">--请选择--</option>
                    <?php if(is_array($roomlist)): foreach($roomlist as $key=>$vo): ?><option value="<?php echo ($vo); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; ?>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">所在机柜</span>
                <select class="form-control" name="shelfcode">
                    <option value="">--请选择--</option>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">设备类型</span>
                <select class="form-control" name="devicetype">
                    <option value="">--请选择--</option>
                    <option value="服务器">服务器</option>
                    <option value="交换机">交换机</option>
                    <option value="防火墙">防火墙</option>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">产品类型</span>
                <select class="form-control" name="productkind">
                    <option value="">--请选择--</option>
                    <?php if(is_array($pdtkindlist)): $i = 0; $__LIST__ = $pdtkindlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["name"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">相关销售</span>
                <select class="form-control" name="salers">
                    <option value="">--请选择--</option>
                    <option>杨龙</option>
                    <option>王酥</option>
                    <option>杨宁</option>
                    <option>张续祥</option>
                    <option>孙一</option>
                    <option>蔡涛</option>
                    <option>何硕</option>
                    <option>汤瑞东</option>
                    <option>慧慧</option>
                    <option>杨总安排</option>
                    <option>公司自用</option>
                    <option>客户授权</option>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">机器转让</span>
                <select class="form-control">
                    <option value="">--请选择--</option>
                    <option>转让机器</option>
                    <option>未转让机器</option>
                </select>
            </div>
            </form>
        </div>
    </div>
    <div class="container-fluid">
        <div class="someopt mt15" style="overflow: hidden;">
            <a href="<?php echo U('Service/exportcsv');?>"><button class="btn btn-primary fl export"><i class="fa fa-external-link"></i> 导 出</button></a>
            <div class="oprt-wrap dn">
            <button class="btn btn-info ml10 fl"><i class="fa fa-question-circle"></i> 问题处理</button>
            <button class="btn btn-info ml10 fl"><i class="fa fa-arrow-circle-o-down"></i> 下架</button>
            <button class="btn btn-info ml10 fl"><i class="fa fa-arrow-circle-right"></i> 服务器转让</button>
            <button class="btn btn-success ml10 fl"><i class="fa fa-download"></i> 系统安装</button>
            <button class="btn btn-success ml10 fl"><i class="fa fa-pencil-square-o"></i></button>
            <button class="btn btn-danger ml10 fl"><i class="fa fa-trash"></i></button>
            <button class="btn btn-success ml10 fl"><i class="fa fa-eye"></i></button>
            </div>
            <a href="javascript:;" class="fr gopage" style="height: 34px;line-height: 34px;">跳转</a>
            <div><input type="text" id="pagebox" class="form-control fr cpage" style="width: 60px;"></div>
            <div class="fr mr10" style="height: 34px;line-height: 34px;"> 共<?php echo ($count); ?>条数据 </div>
            <div class="page fr mr10"><?php echo ($page); ?></div>
        </div>
        <div class="lsit-wrap" style="overflow: auto;">
            <table class="table table-hover" style="min-width: 1730px;">
                <thead>
                    <tr>
                    <th class="idsc">ID <div class="updown" style="display: inline-block;position: relative;top: 5px;"><span class="fa fa-caret-up increase" style="position: relative;top: 2px;"></span><span class="fa fa-caret-down reduce"></span></div></th><th>客户名称</th><th>服务器类型</th><th>服务器状态</th><th>IP地址</th><th>IP数量</th><th>所在机房</th><th>所在机柜</th>
                    <th>交换机端口</th><th>服务器外形</th><th>自动化</th><th>配置</th><th>带宽限制</th><th>备注</th><th style="width: 100px;">代理商备注</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($servlist)): $i = 0; $__LIST__ = $servlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><a href="javascript:;" class="userid view"><?php echo ($vo["id"]); ?></a></td>
                        <td><a href="javascript:;" class="username"><?php echo ($vo["custname"]); ?></a></td>
                        <td>服务器租用</td>
                        <td>
                            <?php switch($vo["servstate"]): case "在线运行": ?><span class="label label-success">在线运行</span><?php break;?>
                                <?php case "闲置空机": ?><span class="label label-primary">闲置空机</span><?php break;?>
                                <?php case "终止合同": ?><span class="label label-danger">终止合同</span><?php break;?>
                                <?php case "期满移出": ?><span class="label label-warning">期满移出</span><?php break;?>
                                <?php case "暂出维护": ?><span class="label label-info">暂出维护</span><?php break;?>
                                <?php case "下架": ?><span class="label label-danger">下架</span><?php break; endswitch;?>
                        </td>
                        <td><span title="<?php echo ($vo["serv_ip"]); ?>" class="servip" style="width: 150px;overflow: hidden;display: block;"><?php echo ($vo["serv_ip"]); ?></span></td>
                        <td><?php echo ($vo["_ipnum"]); ?></td>
                        <td><?php echo ($vo["idcname"]); ?></td>
                        <td><?php echo ($vo["shelfcode"]); ?></td>
                        <td>
                            <?php if($vo["switchport"] != 'null'): echo ($vo["switchport"]); endif; ?>
                        </td>
                        <td><?php echo ($vo["deviceshape"]); ?></td>
                        <td><?php echo ($vo["Automation"]); ?></td>
                        <td>
                            <?php if($vo["hwconfig"] != 'null'): ?><span style="width: 150px;height: 20px;overflow: hidden;display: block;"><?php echo ($vo["hwconfig"]); ?></span><?php endif; ?>
                        </td>
                        <td><?php echo ($vo["bandwidth"]); ?></td>
                        <td><span style="width: 150px;height: 20px;overflow: hidden;display: block;"><?php echo ($vo["remarks"]); ?></span></td>
                        <td>
                            <?php if($vo["custremarks"] != 'null'): ?><span data-toggle="tooltip" title="<?php echo ($vo["custremarks"]); ?>" style="width: 150px;height: 20px;overflow: hidden;display: block;"><?php echo ($vo["custremarks"]); ?></span><?php endif; ?>
                        </td>
                        <td style="position: relative;text-align: right;left:20px;">
                            <?php if($vo["servstate"] == '在线运行'): ?><div class="operate-btns" style="position: absolute;top:0;right: 1px;width:280px;text-align:right;display: none;">
                                <button class="btn btn-primary fl ml10 install" title="系统安装" style="box-shadow: 5px 5px 6px #9E9E9E;"><i class="fa fa-download"></i></button>
                                <button class="btn btn-info fl ml10 view" title="查看" style="box-shadow: 5px 5px 6px #9E9E9E;"><i class="fa fa-eye"></i></button>
                                <button class="btn btn-warning fl ml10 edit" title="编辑" style="box-shadow: 5px 5px 6px #9E9E9E;"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger fl ml10 remove" title="删除" style="box-shadow: 5px 5px 6px #9E9E9E;"><i class="fa fa-trash"></i></button>
                            </div><?php endif; ?>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="15" style="line-height: 2em;">
                            <span class="total-item"><span class="label label-primary">总台数:</span> <?php echo ($count); ?></span>&nbsp;
                            <span class="total-item"><span class="label label-primary">本公司自用:</span> <?php echo ($servcounts["self"]); ?></span>&nbsp;
                            <span class="total-item"><span class="label label-primary">空闲机器:</span> <?php echo ($servcounts["free"]); ?></span>&nbsp;
                            <?php if(is_array($servcounts2)): foreach($servcounts2 as $k=>$vo): ?><span class="total-item"><span class="label label-info"><?php echo ($k); ?></span> <?php echo ($vo); ?></span>&nbsp;<?php endforeach; endif; ?>                          
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
</body>
</html>