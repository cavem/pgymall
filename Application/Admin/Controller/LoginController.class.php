<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function indexAction(){
    	$this->display();
    }
    //login
    public function loginAction(){
        $name=I('post.name');
        $password=I('post.password');
        $map=array(
            "AdminName" => array('eq',$name),
            "AdminPwd" => array('eq',$password)
        );
        if(M('admin_user')->where($map)->select()){
            $userinfo=M('admin_user')->where($map)->find();
            session("loginuser",$userinfo);
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn('账号或密码错误');
        }
    }
}