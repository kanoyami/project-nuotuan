<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends BaseController {
    public function login(){
                $name = $_POST['name'];
                $passwd =$_POST['passwords'];
               // $name = 'kanoyami';
               // $passwd = 'e10adc3949ba59abbe56e057f20f883e';
                $result = M('user')->where('password ='."'".$passwd."'".' AND phone ='."'".$name."'")->find(); 
                if($result != null){
                    $data['status'] = 1;
                    $data['info'] = 'login success';
                    $data['size'] = 6;
                    $data['url'] = null;
                    $data['username'] = $result['username'];
                    $data['uid'] = $result['uid'];
                    $data['token'] =$result['token'] ;
                    $this->ajaxReturn($data,'JSON');
                }else{
                    $data['status'] = 0;
                    $data['info'] = 'password error';
                    $data['size'] = 6;
                    $data['url'] = null;
                    $data['username'] = null;
                    $data['uid'] = null;

                    $this->ajaxReturn($data,'JSON');
                }



           }
}