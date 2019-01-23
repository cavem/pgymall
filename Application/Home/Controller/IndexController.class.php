<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller{
    //index
    public function indexAction(){
        $navlist=M('products')->where("isnav=%d AND status='%s'",1,'库存')->select();
        $balist=M('products')->limit(4)->where(array("status" => array('eq','库存'),"type" => array('like','%8大名酒%')))->select();
        $sqlist=M('products')->limit(4)->where(array("status" => array('eq','库存'),"type" => array('like','%17大名酒%')))->select();
        $wslist=M('products')->limit(4)->where(array("status" => array('eq','库存'),"type" => array('like','%53优名酒%')))->select();
        $qtlist=M('products')->limit(4)->where(array("status" => array('eq','库存'),"type" => array('like','%其它%')))->select();
        $this->assign("title","首页");
        $this->assign("navlist",$navlist);
        $this->assign("balist",$balist);
        $this->assign("sqlist",$sqlist);
        $this->assign("wslist",$wslist);
        $this->assign("qtlist",$qtlist);
    	$this->display();
    }
    //detail
    public function detailAction(){
        $id=I('id/d');
        $proinfo=M('products')->where("id=%d",$id)->find();
        $this->assign("proinfo",$proinfo);
        $this->assign("title",$proinfo['type'].'-'.$proinfo['name']);
    	$this->display();
    }
    //prolist
    public function prolistAction(){
        $type=I('type/s');
        $cpage=I('p/d',1);
        $key=I('keyword/s');
        $where=array(
            "name" => array('like','%'.$key.'%'),
            "tel" => array('like','%'.$key.'%'),
            "vender" => array('like','%'.$key.'%'),
            "time" => array('like','%'.$key.'%'),
            "buyperson" => array('like','%'.$key.'%'),
            "_logic" => 'OR'
        );
        $map=array(
            "_complex" => $where,
            "status" => array('eq','库存'),
            "type" => array('like','%'.$type.'%'),
        );
        $count=M('products')->where($map)->count();
        $Page = new \Extend\Page($count,10);
        $Page->parameter['keyword'] = $key;
        $show = $Page->show();
        $typelist=M('products')->limit($Page->firstRow.','.$Page->listRows)->where($map)->select();
        $this->assign("count",$count);
        $this->assign("page",$show);
        $this->assign("typelist",$typelist);
        $this->assign("title",$type);
        $this->assign("type",$type);
    	$this->display();
    }
}