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
.square{width: 34px;height: 34px;background: #28b779;color: #fff;text-align: center;line-height: 34px;cursor: pointer;}
a{color: #337ab7;}
a:hover{color: #23527c;}
.moreoption{color: #337ab7;cursor: pointer;}
.moreoption:hover{color: #23527c;}
.fold-drop{position: absolute;min-width: 100px;background: #fff;border: 1px solid #e7e7e7;display: none;z-index: 99;right: 35px;}
.fold-drop li a {display: block;padding: 0 5px;line-height: 30px;text-align: left;color: #404241;text-decoration-line: none;}
.fold-drop li a:hover{color: #fff;background: #60aff6;}
.updown{display: inline-block;width: 20px;position: relative;top: 7px;text-align: center;background: #eee;}
.updown span{display: block;cursor: pointer;color: #999;}
.updown span:hover{color: #111;}
</style>
<script>
$(function(){
    $('.condition-ctrl').click(function(){
        if($(this).find('i').hasClass('fa-caret-down')){
            $(this).find('i').removeClass('fa-caret-down');
            $(this).find('i').addClass('fa-caret-up');
        }else{
            $(this).find('i').removeClass('fa-caret-up');
            $(this).find('i').addClass('fa-caret-down');
        }
        $('.condition-panel').slideToggle();
    })
    $('.moreoption').hover(
        function(){
            $(this).find('.fold-drop').show();
        },
        function(){
            $(this).find('.fold-drop').hide();
        }
    )
    //添加产品
    $('.new').click(function(){
        var confirm=function(index,layero){
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            layer.msg('请稍等...',{icon:16});
            $.post('/Admin/Product/new',formdata,function(data,status){
                if(data==0){
                    layer.msg('添加成功',{icon:1});
                    window.location.reload();
                }else{
                    layer.msg('添加失败',{icon:2});
                    window.location.reload();
                }
            })
        }
        myalert('添加产品','900px','660px',"<?php echo U('Product/new');?>",confirm);
    })
    //查看 
    $('.view').click(function(){
        var name=$(this).closest('tr').find('.name').text();
        var id=$(this).closest('tr').children('td:first').text();
        var confirm=function(index,layero){
            layer.closeAll();
        }
        myalert('产品信息【'+name+'】','900px','660px',"<?php echo U('Product/view');?>"+"?name="+name+"&id="+id,confirm);
    })
    //查看图片
    $('.viewimg').click(function(){
        var name=$(this).closest('tr').find('.name').text();
        var id=$(this).closest('tr').children('td:first').text();
        myalert('查看图片【'+name+'】','900px','660px',"<?php echo U('Product/viewimg');?>"+"?id="+id,confirm);
    })
    //编辑
    $('.edit').click(function(){
        var name=$(this).closest('tr').find('.name').text();
        var id=$(this).closest('tr').children('td:first').text();
        var confirm=function(index,layero){
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            layer.msg('请稍等...',{icon:16});
            $.post('/Admin/Product/edit',formdata+"&id="+id,function(data,status){
                if(data==0){
                    layer.msg('修改成功',{icon:1});
                    window.location.reload();
                }else{
                    layer.msg('修改失败',{icon:2});
                    window.location.reload();
                }
            })
        }
        myalert('产品编辑【'+name+'】','900px','660px',"<?php echo U('Product/edit');?>"+"?id="+id,confirm);
    })
    //添加到轮播图
    $('.addnav').click(function(){
        var name=$(this).closest('tr').find('.name').text();
        var id=$(this).closest('tr').children('td:first').text();
        layer.confirm('确定添加【'+name+'】到首页轮播图?', {
            btn: ['确定','取消']
        }, function(){
            $.post("/Admin/Product/addnav",{"id":id},function(data,status){
                if(data==0){
                    layer.msg('修改成功',{icon:1});
                    window.location.reload();
                }else{
                    layer.msg('修改失败',{icon:2});
                    window.location.reload();
                }
            })
        });
    })
    //从轮播图移除
    $('.removenav').click(function(){
        var name=$(this).closest('tr').find('.name').text();
        var id=$(this).closest('tr').children('td:first').text();
        layer.confirm('确定把【'+name+'】从轮播图移除?', {
            btn: ['确定','取消']
        }, function(){
            $.post("/Admin/Product/removenav",{"id":id},function(data,status){
                if(data==0){
                    layer.msg('修改成功',{icon:1});
                    window.location.reload();
                }else{
                    layer.msg('修改失败',{icon:2});
                    window.location.reload();
                }
            })
        });
    })
    //出库
    $('.leave').click(function(){
        var name=$(this).closest('tr').find('.name').text();
        var id=$(this).closest('tr').children('td:first').text();
        var confirm=function(index,layero){
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            if(body.find("input[name='num']").val()-body.find(".tnum").val()>0){
                layer.msg("出库数量不能大于库存数量!");
            }else{
                layer.msg('请稍等...',{icon:16});
                $.post('/Admin/Product/leave',formdata+"&id="+id,function(data,status){
                    if(data==0){
                        layer.msg('操作成功',{icon:1});
                        window.location.reload();
                    }else{
                        layer.msg('操作失败',{icon:2});
                        window.location.reload();
                    }
                })
            }
        }
        myalert('出库【'+name+'】','900px','300px',"<?php echo U('Product/leave');?>"+"?id="+id,confirm);
    })
    //删除
    $('.remove').click(function(){
        var name=$(this).closest('tr').find('.name').text();
        var id=$(this).closest('tr').children('td:first').text();
        layer.confirm('确定删除【'+name+'】?', {
            btn: ['确定','取消']
        }, function(){
            $.post("/Admin/Product/remove",{"name":name,"id":id},function(data,status){
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
    //香型管理
    $('.smell').click(function(){
        myalert('香型管理','1200px','800px',"<?php echo U('Product/smell');?>");
    })
    //跳转
    $('.gopage').click(function(){
        var cpage=$('.cpage').val();
        window.location.href="<?php echo U('Product/list');?>"+"?p="+cpage;
    })
    $('.increase').click(function(){
        var key=$(this).closest('.updown').data('val');
        window.location.href="<?php echo U('Product/list');?>"+"?sc="+key+" asc";
    })
    $('.reduce').click(function(){
        var key=$(this).closest('.updown').data('val');
        window.location.href="<?php echo U('Product/list');?>"+"?sc="+key+" desc";
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
})
</script>
<div id="content" class="wow fadeIn">
    <div id="content-header">
        <span class="header-title"><i class="fa fa-list-ul"></i> 产品列表</span>
        <div class="square fr search">
            <i class="fa fa-search" style="font-size: 14px;"></i>
        </div>
        <form class="sform" action="<?php echo U('Product/list');?>" method="GET">
        <div class="mysearchbox fr">
            <i class="fa fa-search" style="position: absolute;top: 11px;left: 11px;"></i>
            <input id="searchbox" type="search" name="keyword" class="form-control" placeholder="请输入查询内容">
            <i class="fa fa-times empty"></i>
        </div>
        <div class="square fr condition-ctrl">
            <i class="fa fa-caret-down"></i>
        </div>
        <div class="condition-panel">
            <div class="condition-panel-item">
                <span class="lb">产品类型：</span>
                <select class="form-control" name="type">
                    <option value="">--请选择--</option>
                    <option>8大名酒</option>
                    <option>17大名酒</option>
                    <option>53优名酒</option>
                    <option>其它</option>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">香型：</span>
                <select class="form-control" name="smell">
                    <option value="">--请选择--</option>
                    <?php if(is_array($smelllist)): foreach($smelllist as $key=>$vo): ?><option><?php echo ($vo["smell"]); ?></option><?php endforeach; endif; ?>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">执行标准：</span>
                <select class="form-control" name="standard">
                    <option value="">--请选择--</option>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">酒线酒花：</span>
                <select class="form-control" name="line">
                    <option value="">--请选择--</option>
                    <option>完美</option>
                    <option>合格</option>
                    <option>喝品</option>
                    <option>废品</option>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">状态：</span>
                <select class="form-control" name="status">
                    <option value="">--请选择--</option>
                    <option>库存</option>
                    <option>喝掉</option>
                    <option>卖掉</option>
                    <option>送人</option>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">轮播图：</span>
                <select class="form-control" name="isnav">
                    <option value="">--请选择--</option>
                    <option value="1">已添加</option>
                    <option value="0">未添加</option>
                </select>
            </div>
        </div>
        </form>
    </div>
    <div class="container-fluid">
        <div class="someopt mt15">
            <a href="javascript:;" class="fr gopage" style="height: 34px;line-height: 34px;">跳转</a>
            <div><input type="text" id="pagebox" class="form-control fr cpage" style="width: 60px;"></div>
            <button class="btn btn-primary fl new"><i class="fa fa-plus"></i> 添加产品</button>
            <div class="fr mr10" style="height: 34px;line-height: 34px;"> 共<?php echo ($count); ?>条数据 </div>
            <div class="page fr mr10"><?php echo ($page); ?></div>
        </div>
        <div class="lsit-wrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th>ID <div class="updown" data-val="id" style="display: inline-block;position: relative;top: 5px;">
                        <span class="fa fa-caret-up increase" style="position: relative;top: 2px;"></span>
                        <span class="fa fa-caret-down reduce"></span></div></th>
                    <th>产品类型</th><th>生产厂家</th>
                    <th>产品名称</th><th>年份</th>
                    <th>香型</th><th>执行标准</th><th>酒线酒花</th><th>度数(度)</th>
                    <th>描述</th>
                    <th>数量(瓶) <div class="updown" data-val="num" style="display: inline-block;position: relative;top: 5px;">
                        <span class="fa fa-caret-up increase" style="position: relative;top: 2px;"></span>
                        <span class="fa fa-caret-down reduce"></span></div></th>
                    <th>状态</th><th>购买时间</th><th>购买价格(元)</th>
                    <th>销售价格(元)</th>
                    <th>购买人</th>
                    <?php if(($status == '卖掉') OR ($status == '喝掉')): ?><th>出库时间</th><?php endif; ?>
                    <th>轮播图</th>
                    <th width="200px;">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($prolist)): $i = 0; $__LIST__ = $prolist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($vo["id"]); ?></td>
                    <td><?php echo ($vo["type"]); ?></td>
                    <td><?php echo ($vo["vender"]); ?></td>
                    <td><a href="javascript:;" class="view name"><?php echo ($vo["name"]); ?></a></td>
                    <td><?php echo ($vo["time"]); ?></td>
                    <td><?php echo ($vo["smell"]); ?></td>
                    <td><?php echo ($vo["standard"]); ?></td>
                    <td>
                        <?php switch($vo["line"]): case "完美": ?><span class="label label-success">完美</span><?php break;?>
                            <?php case "合格": ?><span class="label label-info">合格</span><?php break;?>
                            <?php case "喝品": ?><span class="label label-warning">喝品</span><?php break;?>
                            <?php case "废品": ?><span class="label label-danger">废品</span><?php break;?>
                            <?php default: endswitch;?>
                    </td>
                    <td><?php echo ($vo["degree"]); ?></td>
                    <td><?php echo ($vo["descr"]); ?></td>
                    <td><?php echo ($vo["num"]); ?></td>
                    <td>
                        <?php switch($vo["status"]): case "库存": ?><span class="label label-success">库存</span><?php break;?>
                            <?php case "喝掉": ?><span class="label label-danger">喝掉</span><?php break;?>
                            <?php case "送人": ?><span class="label label-warning">送人</span><?php break;?>
                            <?php case "卖掉": ?><span class="label label-danger">卖掉</span><?php break;?>
                            <?php default: endswitch;?>
                    </td>
                    <td><?php echo ($vo["buytime"]); ?></td>
                    <td><?php echo ($vo["price"]); ?></td>
                    <td><?php echo ($vo["saleprice"]); ?></td>
                    <td><?php echo ($vo["buyperson"]); ?></td>
                    <?php if($vo["status"] != '库存'): ?><td><?php echo ($vo["leavetime"]); ?></td><?php endif; ?>
                    <td><?php if($vo["isnav"] == '1'): ?><span class="label label-success">已添加</span><?php endif; ?></td>
                    <td>
                        <button href="javascript:;" class="btn btn-primary view" title="查看"><i class="fa fa-eye"></i></button> 
                        <?php if($vo["status"] == '库存'): ?><button class="btn btn-default moreoption" style="display: inline-block;">更多 <i class="fa fa-sort-desc" style="position: relative;top: -1px;"></i>
                            <ul class="fold-drop">
                                <li class="">
                                    <a href="javascript:;" class="viewimg"><i class="fa fa-picture-o"></i> 查看图片</a>
                                </li> 
                                <li class="">
                                    <a href="javascript:;" class="edit"><i class="fa fa-pencil-square-o"></i> 编辑</a>
                                </li>
                                <?php if($vo["isnav"] == '0'): ?><li class="">
                                        <a href="javascript:;" class="addnav"><i class="fa fa-plus"></i> 添加到轮播图</a>
                                    </li>
                                <?php else: ?>
                                    <li class="">
                                        <a href="javascript:;" class="removenav"><i class="fa fa-minus"></i> 从轮播图移除</a>
                                    </li><?php endif; ?>
                                <li class="">
                                    <a href="javascript:;" class="leave"><i class="fa fa-sign-out"></i> 出库</a>
                                </li>
                                <li class="">
                                    <a href="javascript:;" class="remove"><i class="fa fa-trash"></i> 删除</a>
                                </li> 
                            </ul>
                        </button><?php endif; ?>
                    </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="15" style="line-height: 2em;">
                            <span class="total-item"><span class="label label-primary">总计:</span> <?php echo ($typecounts["zj"]); ?></span>&nbsp;
                            <span class="total-item"><span class="label label-warning">8大名酒:</span> <?php echo ($typecounts["ba"]); ?></span>&nbsp;
                            <span class="total-item"><span class="label label-warning">17大名酒:</span> <?php echo ($typecounts["sq"]); ?></span>&nbsp;
                            <span class="total-item"><span class="label label-warning">53优名酒:</span> <?php echo ($typecounts["ws"]); ?></span>&nbsp;
                            <span class="total-item"><span class="label label-warning">其它:</span> <?php echo ($typecounts["qt"]); ?></span>&nbsp; 
                            <span class="total-item"><span class="label label-danger">购买总价:</span> <?php echo ($typecounts["gz"]); ?>元</span>&nbsp;                       
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
</body>
</html>