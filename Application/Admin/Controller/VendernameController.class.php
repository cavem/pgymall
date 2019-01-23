<?php
namespace Admin\Controller;
use Think\Controller;
class VendernameController extends Controller {
    public function listAction(){
        $venderlist=M('vender_name')->select();
        $this->assign("venderlist",$venderlist);
        $this->display();
    }
    public function newAction(){
        if(IS_POST){
            $data=M('vender_name')->create();
            if(M('vender_name')->add($data)){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
        $this->display();
    }
    public function editAction(){
        $id=I('id/d');
        $venderinfo=M('vender_name')->where("id=%d",$id)->find();
        if(IS_POST){
            $data=M('vender_name')->create();
            if(M('vender_name')->save($data)){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
        $this->assign("venderinfo",$venderinfo);
        $this->display();
    }
}