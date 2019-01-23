<?php if (!defined('THINK_PATH')) exit();?><link href="/Application/Admin/View/Public/bootstrap-3.3.5-dist/css/bootstrap.min.css" title="" rel="stylesheet" />
<link title="" href="/Application/Admin/View/Public/css/style.css" rel="stylesheet" type="text/css"  />

<script src="/Application/Admin/View/Public/script/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="/Application/Admin/View/Public/script/jquery.cookie.js" type="text/javascript"></script>
<script src="/Application/Admin/View/Public/bootstrap-3.3.5-dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Public/layer/layer.js" type="text/javascript"></script>


 <div class="left-product right-full">
        <div class="center-back left-back">
        <div class="container-fluid">
          <div class="info-center">
            <div class="clearfix"></div>
            <div class="table-margin">
              <div class="col-lg-6" style="width: 50%">
                <form name="mform" role="form" method="post" action="<?php echo U('officweb/quoteadd');?>">
                    <div class="form-group">
                        <label>类型名称</label>
                        <input class="form-control" name="title" value="<?php echo ($info["title"]); ?>">
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label>价格（单位：元）</label>
                        <input type="text" class="form-control" id="price" name="price" onkeyup="only_num(this)" onblur="only_num(this)" value="<?php echo ($info["price"]); ?>">
                        <p class="help-block"></p>
                    </div>
                    <button type="button" id="save" class="btn btn-default">提交</button>
                    <button type="reset" class="btn btn-default">重置</button>
                    <input type="hidden" name="quotid" value="<?php echo ($quotid); ?>">
                    <input type="hidden" name="fid" value="<?php echo ($fid); ?>">
                </form>
              </div>
            </div>
          </div>
        </div>
        </div>
        <iframe id="framepic" name="framepic" style="display:none"></iframe>
 </div>
</div>
<script type="text/javascript">
$(function(){
/*换肤*/
$(".dropdown .changecolor li").click(function(){
	var style = $(this).attr("id");
    $("link[title!='']").attr("disabled","disabled"); 
	$("link[title='"+style+"']").removeAttr("disabled"); 

	$.cookie('mystyle', style, { expires: 7 }); // 存储一个带7天期限的 cookie 
})
var cookie_style = $.cookie("mystyle"); 
if(cookie_style!=null){ 
    $("link[title!='']").attr("disabled","disabled"); 
	$("link[title='"+cookie_style+"']").removeAttr("disabled"); 
} 
/*左侧导航栏显示隐藏功能*/
$(".subNav").click(function(){				
			/*显示*/
			if($(this).find("span:first-child").attr('class')=="title-icon glyphicon glyphicon-chevron-down")
			{
				$(this).find("span:first-child").removeClass("glyphicon-chevron-down");
			    $(this).find("span:first-child").addClass("glyphicon-chevron-up");
			    $(this).removeClass("sublist-down");
				$(this).addClass("sublist-up");
			}
			/*隐藏*/
			else
			{
				$(this).find("span:first-child").removeClass("glyphicon-chevron-up");
				$(this).find("span:first-child").addClass("glyphicon-chevron-down");
				$(this).removeClass("sublist-up");
				$(this).addClass("sublist-down");
			}	
		// 修改数字控制速度， slideUp(500)控制卷起速度
	    $(this).next(".navContent").slideToggle(300).siblings(".navContent").slideUp(300);
	})
/*左侧导航栏缩进功能*/
$(".left-main .sidebar-fold").click(function(){

	if($(this).parent().attr('class')=="left-main left-full")
	{
		$(this).parent().removeClass("left-full");
		$(this).parent().addClass("left-off");
		
		$(this).parent().parent().find(".right-product").removeClass("right-full");
		$(this).parent().parent().find(".right-product").addClass("right-off");
		
		}
	else
	{
		$(this).parent().removeClass("left-off");
		$(this).parent().addClass("left-full");
		
		$(this).parent().parent().find(".right-product").removeClass("right-off");
		$(this).parent().parent().find(".right-product").addClass("right-full");
		
		}
	})	
 
  /*左侧鼠标移入提示功能*/
		$(".sBox ul li").mouseenter(function(){
			if($(this).find("span:last-child").css("display")=="none")
			{$(this).find("div").show();}
			}).mouseleave(function(){$(this).find("div").hide();})	
})
function quoteadd(id='')
{
	var datatype='<?=$datatype?>';
	var fid='<?=$fid?>';
	var href="";
	if (id=='') 
	{
		href="/Admin/Officweb/quoteinfo?datatype="+datatype+"&fid="+fid;
	}
	else
	{
		href="/Admin/Officweb/quoteinfo?id="+id+"&datatype="+datatype+"&fid="+fid;
	}
	layer.closeAll(); 
    layer.open({
      type: 2,
      title: '新增信息',
  	  shade: 0.6,
      shadeClose: true,
      maxmin: true, //开启最大化最小化按钮
      area: ['600px', '500px'],
      content: href
    });
}
</script>
</body>
</html>
<script type="text/javascript">
    $('document').ready(function(){
        $('#save').click(function(){
            document.mform.action="<?php echo U('officweb/quoteadd');?>";
            document.mform.target="framepic";
            document.mform.submit();
        });
    });

    function stopupload(rel){
        switch (rel) {
            case 0:
                layer.alert('信息保存成功', {
                    icon: 1,
                    skin: 'layer-ext-moon'
                }, function(){
                    layer.closeAll(); 
                    parent.location.reload();
                    return; 
                });
                break;  
            case 1:
                layer.alert('提交失败', {
                    icon: 2,
                    skin: 'layer-ext-moon'
                }, function(){
                    layer.closeAll(); 
                    parent.location.reload();
                    return; 
                });
                break; 
        } 
    }
    function only_num(obj){
　　　　//得到第一个字符是否为负号
　　　　var num = obj.value.charAt(0);
　　　　//先把非数字的都替换掉，除了数字和.
　　　　obj.value = obj.value.replace(/[^\d\.]/g,'');
　　　　//必须保证第一个为数字而不是.
　　　　obj.value = obj.value.replace(/^\./g,'');
　　　　//保证只有出现一个.而没有多个.
　　　　obj.value = obj.value.replace(/\.{2,}/g,'.');
　　　　//保证.只出现一次，而不能出现两次以上
　　　　obj.value = obj.value.replace('.','$#$').replace(/\./g,'').replace('$#$','.');
　　　　//如果第一位是负号，则允许添加
　　　　if(num == '-'){
　　　　　　obj.value = '-'+obj.value;
　　　　}
　　}
</script>