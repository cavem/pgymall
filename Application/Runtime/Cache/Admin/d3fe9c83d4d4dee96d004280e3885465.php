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
    //客户立案
    $('.new').click(function(){
        var confirm=function(index,layero){
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            layer.msg('请稍等...',{icon:16});
            $.post('/Custom/new',decodeURIComponent(formdata,true),function(data,status){
                if(data==0){
                    layer.msg('添加成功',{icon:1});
                    window.location.reload();
                }else{
                    layer.msg('添加失败',{icon:2});
                    window.location.reload();
                }
            })
        }
        myalert('客户立案','900px','660px',"<?php echo U('Custom/new');?>",confirm);
    })
    //查看 
    $('.view').click(function(){
        var username=$(this).closest('tr').find('.username').text();
        var id=$(this).closest('tr').children('td:first').text();
        var confirm=function(index,layero){
            layer.closeAll();
        }
        myalert('客户信息【'+username+'】','900px','660px',"<?php echo U('Custom/view');?>"+"?name="+username+"&id="+id,confirm);
    })
    //编辑
    $('.edit').click(function(){
        var confirm=function(index,layero){
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            layer.msg('请稍等...',{icon:16});
            $.post('/Custom/edit',decodeURIComponent(formdata,true),function(data,status){
                if(data==0){
                    layer.msg('添加成功',{icon:1});
                    window.location.reload();
                }else{
                    layer.msg('添加失败',{icon:2});
                    window.location.reload();
                }
            })
        }
        myalert('客户编辑','900px','660px',"<?php echo U('Custom/edit');?>",confirm);
    })
    //预付款 
    $('.addpay').click(function(){
        var username=$(this).closest('tr').find('.username').text();
        var confirm=function(index,layero){
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            layer.msg('请稍等...',{icon:16});
            $.post('/Custom/add_pay',decodeURIComponent(formdata,true),function(data,status){
                if(data==0){
                    layer.msg('添加成功',{icon:1});
                    window.location.reload();
                }else{
                    layer.msg('添加失败',{icon:2});
                    window.location.reload();
                }
            })
        }
        myalert('添加预付款','900px','660px',"<?php echo U('Custom/add_pay');?>"+"?name="+username,confirm);
    })
    //订单
    $('.addorder').click(function(){
        var username=$(this).closest('tr').find('.username').text();
        var confirm=function(index,layero){
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            layer.msg('请稍等...',{icon:16});
            $.post('/Custom/add_order',decodeURIComponent(formdata,true),function(data,status){
                if(data==0){
                    layer.msg('添加成功',{icon:1});
                    window.location.reload();
                }else{
                    layer.msg('添加失败',{icon:2});
                    window.location.reload();
                }
            })
        }
        myalert('添加订单','900px','660px',"<?php echo U('Custom/add_order');?>"+"?name="+username,confirm);
    })
    //删除
    $('.remove').click(function(){
        var username=$(this).closest('tr').find('.username').text();
        layer.confirm('确定删除【'+username+'】?', {
            btn: ['确定','取消']
        }, function(){
            $.post("/Custom/remove",{"servid":servid},function(data,status){
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
    //跳转
    $('.gopage').click(function(){
        var cpage=$('.cpage').val();
        window.location.href="<?php echo U('Custom/list');?>"+"?p="+cpage;
    })
    $('.increase').click(function(){
        window.location.href="<?php echo U('Custom/list');?>"+"?sc=asc";
    })
    $('.reduce').click(function(){
        window.location.href="<?php echo U('Custom/list');?>"+"?sc=desc";
    })
})
</script>
<div id="content" class="wow fadeIn">
    <div id="content-header">
        <span class="header-title"><i class="fa fa-list-ul"></i> 客户列表</span>
        <div class="square fr search">
            <i class="fa fa-search" style="font-size: 14px;"></i>
        </div>
        <form class="sform" action="<?php echo U('Custom/list');?>" method="POST">
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
        </div>
        </form>
    </div>
    <div class="container-fluid">
        <div class="someopt mt15">
            <a href="javascript:;" class="fr gopage" style="height: 34px;line-height: 34px;">跳转</a>
            <div><input type="text" id="pagebox" class="form-control fr cpage" style="width: 60px;"></div>
            <button class="btn btn-primary fl new"><i class="fa fa-pencil-square-o"></i> 客户立案</button>
            <div class="fr mr10" style="height: 34px;line-height: 34px;"> 共<?php echo ($count); ?>条数据 </div>
            <div class="page fr mr10"><?php echo ($page); ?></div>
        </div>
        <div class="lsit-wrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th>ID <div class="updown" style="display: inline-block;position: relative;top: 5px;"><span class="fa fa-caret-up increase" style="position: relative;top: 2px;"></span><span class="fa fa-caret-down reduce"></span></div></th><th>客户名称</th><th>QQ号码</th><th>手机号码</th><th>电话号码</th><th>身份证号码</th><th>邮箱</th><th>客户等级</th>
                    <th>销售代表</th><th>客户状态</th><th width="200px;">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($clientlist)): $i = 0; $__LIST__ = $clientlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($vo["id"]); ?></td>
                    <td><a href="javascript:;" class="view username"><?php echo ($vo["name"]); ?></a></td>
                    <td><?php echo ($vo["qq"]); ?></td>
                    <td><?php echo ($vo["cellphone"]); ?></td>
                    <td><?php echo ($vo["tel"]); ?></td>
                    <td><?php echo ($vo["idnumber"]); ?></td>
                    <td><?php echo ($vo["mail"]); ?></td>
                    <td><?php echo ($vo["class"]); ?></td>
                    <td><?php echo ($vo["salesman"]); ?></td>
                    <td><?php echo ($vo["state"]); ?></td>
                    <td>
                        <button href="javascript:;" class="btn btn-primary view"><i class="fa fa-eye"></i></button> 
                        <button class="btn btn-default moreoption" style="display: inline-block;">更多 <i class="fa fa-sort-desc" style="position: relative;top: -1px;"></i>
                            <ul class="fold-drop">
                                <li class="">
                                    <a href="javascript:;" class="addpay"><i class="fa fa-plus"></i> 预付款</a>
                                </li> 
                                <li class="">
                                    <a href="javascript:;" class="addorder"><i class="fa fa-plus"></i> 订单</a>
                                </li> 
                                <li class="">
                                    <a href="javascript:;" class="edit"><i class="fa fa-pencil-square-o"></i> 编辑</a>
                                </li> 
                                <li class="">
                                    <a href="javascript:;" class="remove"><i class="fa fa-trash"></i> 删除</a>
                                </li> 
                            </ul>
                        </button>
                    </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>