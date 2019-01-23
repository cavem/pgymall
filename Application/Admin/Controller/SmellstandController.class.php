<?php
namespace Admin\Controller;
use Think\Controller;
class SmellstandController extends Controller {
    public function listAction(){
        $smelllist=M('smell_stand')->select();
        $this->assign("smelllist",$smelllist);
        $this->display();
    }
    public function newAction(){
        if(IS_POST){
            $data=M('smell_stand')->create();
            if(M('smell_stand')->add($data)){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
        $this->display();
    }
    public function editAction(){
        $id=I('id/d');
        $smellinfo=M('smell_stand')->where("id=%d",$id)->find();
        if(IS_POST){
            $data=M('smell_stand')->create();
            if(M('smell_stand')->save($data)){
                $this->ajaxReturn(0);
            }else{
                $this->ajaxReturn(1);
            }
        }
        $this->assign("smellinfo",$smellinfo);
        $this->display();
    }
}