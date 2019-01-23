<?php
namespace Admin\Controller;
use Think\Controller;
class ProductController extends Controller {
    public function listAction(){
        $cpage=I('p/d',1);
        $sc=str_replace("+"," ",I('sc/s'));
        $key=I('keyword/s');
        
        $where=array(
            "type" => array('like','%'.$key.'%'),
            "name" => array('like','%'.$key.'%'),
            "tel" => array('like','%'.$key.'%'),
            "vender" => array('like','%'.$key.'%'),
            "time" => array('like','%'.$key.'%'),
            "buyperson" => array('like','%'.$key.'%'),
            "smell" => array('like','%'.$key.'%'),
            "standard" => array('like','%'.$key.'%'),
            "line" => array('like','%'.$key.'%'),
            "degree" => array('like','%'.$key.'%'),
            "status" => array('like','%'.$key.'%'),
            "_logic" => 'OR'
        );
        $map=array(
            "_complex" => $where,
            "status" => '库存',
            "id" => array('neq',0),
        );
        if(I('type/s')!=''){
            $map['type']=array('like','%'.I('type/s').'%');
        }
        if(I('smell/s')!=''){
            $map['smell']=array('like','%'.I('smell/s').'%');
        }
        if(I('standard/s')!=''){
            $map['standard']=array('like','%'.I('standard/s').'%');
        }
        if(I('line/s')!=''){
            $map['line']=array('like','%'.I('line/s').'%');
        }
        if(I('status/s')!=''){
            $map['status']=array('like','%'.I('status/s').'%');
        }
        if(I('isnav/s')!=''){
            $map['isnav']=array('eq',I('isnav/s'));
        }
        $count=M('products')->where($map)->count();
        $Page = new \Extend\Page($count,10);
        $Page->parameter['keyword'] = $key;
        $show = $Page->show();
        $prolist=M('products')->limit($Page->firstRow.','.$Page->listRows)->where($map)->order($sc)->select();
        $totalprice=0;
        $pricenumlist=M('products')->where($map)->field('price,num')->select();
        foreach($pricenumlist as $val){
            $totalprice+=$val['price']*$val['num'];
        }
        $typecounts=array(
            "zj" => M('products')->where($map)->sum("num"),
            "ba" => M('products')->where($map)->where(array("type" => array('like','%8大名酒%')))->sum("num"),
            "sq" => M('products')->where($map)->where(array("type" => array('like','%17大名酒%')))->sum("num"),
            "ws" => M('products')->where($map)->where(array("type" => array('like','%53优名酒%')))->sum("num"),
            "qt" => M('products')->where($map)->where(array("type" => array('like','%其它%')))->sum("num"),
            "gz" => $totalprice,
        );
        $smelllist=M("smell_stand")->field("smell")->select();
        $this->assign("count",$count);
        $this->assign("page",$show);
        $this->assign("prolist",$prolist);
        $this->assign("typecounts",$typecounts);
        $this->assign("smelllist",$smelllist);
        $this->assign("status",I('status/s'));
    	$this->display();
    }
    //new
    public function newAction(){
        $smelllist=M("smell_stand")->field("smell")->select();
        if(IS_POST){
            $data = M('products')->create();
            if(M('products')->add($data)){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn('添加失败');
            }
        }
        $this->assign("smelllist",$smelllist);
        $this->display();
    }
    //getstandard
    public function getstandardAction(){
        $smell=I('post.smell');
        $standard=M('smell_stand')->where("smell='%s'",$smell)->getField('standard');
        $standardlist=explode("||",$standard);
        $this->ajaxReturn(json_encode($standardlist));
    }
    //getvender
    public function getvenderAction(){
        $name=I('name/s');
        $vender=M('vender_name')->where(array("name" => array('like','%'.$name.'%')))->getField('vender');
        $this->ajaxReturn($vender);
    }
    //view
    public function viewAction(){
        $id=I('id/d');
        $proinfo=M('products')->where("id=%d",$id)->find();
        $this->assign("proinfo",$proinfo);
        $this->display();
    }
    //viewimg
    public function viewimgAction(){
        $id=I('id/d');
        $img=M('products')->where("id=%d",$id)->getField('img');
        $this->assign("img",$img);
        $this->display();
    }
    //edit
    public function editAction(){
        $id=I('id/d');
        $proinfo=M('products')->where("id=%d",$id)->find();
        $smelllist=M("smell_stand")->field("smell")->select();
        if(IS_POST){
            $data = M('products')->create();
            if(M('products')->save($data)){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn('修改失败');
            }
        }
        $this->assign("proinfo",$proinfo);
        $this->assign("smelllist",$smelllist);
        $this->display();
    }
    //addnav
    public function addnavAction(){
        $id=I('id/d');
        $data=array(
            "isnav" => 1,
        );
        if(M('products')->where("id=%d",$id)->save($data)){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn('修改失败');
        }
    }
    //removenav
    public function removenavAction(){
        $id=I('id/d');
        $data=array(
            "isnav" => 0,
        );
        if(M('products')->where("id=%d",$id)->save($data)){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn('修改失败');
        }
    }
    //remove
    public function removeAction(){
        $id=I('id/d');
        $name=I('name/s');
        if(M('products')->where("id=%d AND name='%s'",$id,$name)->delete()){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn(1);
        }
    }
    //leave
    public function leaveAction(){
        $id=I('id/d');
        $num=M('products')->where("id=%d",$id)->getField('num');
        if(IS_POST){
            $data=array(
                "num" => I('tnum/d')-I('num/d'),
            );
            M('products')->where("id=%d",I('id/d'))->save($data);
            $proinfo=M('products')->where("id=%d",I('id/d'))->find();
            unset($proinfo["id"]);
            $proinfo['num']=I('num/d');
            $proinfo['status']=I('status/s');
            $proinfo['leavetime']=date("Y/m/d");
            if(M('products')->add($proinfo)){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
        $this->assign("num",$num);
        $this->display();
    }
    //上传图片
    public function uploadimgAction(){
        if(is_uploaded_file($_FILES["file"]["tmp_name"]))
        {
            //将信息存放在变量中
            $upfile=$_FILES["file"];//用一个数组类型的字符串存放上传文件的信息
            $exten_name=pathinfo($upfile['name'],PATHINFO_EXTENSION);
            //生成照片证书guid
            $data=date('YmdHis');
            $name=$data.'.'.$exten_name;//便于以后转移文件时命名
            //如果打印则输出类似这样的信息Array ( [name] => m.jpg [type] => image/jpeg [tmp_name] => C:\WINDOWS\Temp\php1A.tmp [error] => 0 [size] => 44905 )
            $type=$upfile["type"];//上传文件的类型
            $size=$upfile["size"];//上传文件的大小
            $tmp_name=$upfile["tmp_name"];//用户上传文件的临时名称
            $error=$upfile["error"];//上传过程中的错误信息
            //对文件类型进行判断，判断是否要转移文件,如果符合要求则设置$ok=1即可以转移
            switch($type){
                case "image/gif" : $ok=1;
                break;
                case "image/jpg" : $ok=1;
                break;
                case "image/jpeg": $ok=1;
                break;
                case "image/png": $ok=1;
                break;
                default:$ok=0;
                break;
            }
            //如果文件符合要求并且上传过程中没有错误
            if($ok&&$error=='0'){
                //检查文件是否损坏
                $data = file_get_contents($tmp_name);
                $im = @imagecreatefromstring($data);
                if($im != false){
                    header("Content-type:text/html;charset=utf-8");
                    //乱码解决
                    $namea = iconv("utf-8","gb2312",$name);
                    //调用move_uploaded_file（）函数，进行文件转移
                    $path=$_SERVER['DOCUMENT_ROOT']."/Public/uploadpic/".$namea;
                    if (!file_exists(dirname($path))){
                        mkdir(dirname($path), 0777);
                    }
                    move_uploaded_file($tmp_name,$path);
                    $this->ajaxReturn("/Public/uploadpic/".$namea);
                    
                    exit();
                }
                else{
                    //如果文件不符合类型或者上传过程中有错误，提示失败
                    $this->ajaxReturn("图片损坏");
                    exit();
                }
            }else{
                //如果文件不符合类型或者上传过程中有错误，提示失败
                $this->ajaxReturn("上传失败");
                exit();
            }
        }
        else{
            echo "<p style='color:red'>请选择文件</p>";
            exit();
        }
    }
}