<?php
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller {
    public function login(){
        if(isset($_SESSION['username'])){

            $this->redirect('Index/index');
        }
        else
        {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $data['username'] = I('post.username');
            $data['password'] = md5(I('post.password'));
            $user=M('admin_user')->where($data)->find();
                 if ($user==null) {
                 $this->error('用户不存在或者密码错误');
                 }
                 else{
                $_SESSION=$user;
                $this->redirect('Index/index');
                 }
        }
            else{
            $this->display();
            }
        }      
    }
    
    public function test(){

        $data = M('admin_user')->select();
        dump($data); 
        $pwd=md5("root");
        dump($pwd);
        die;   
    }

    public function logout()
    {
       session_destroy();
       $this->success("注销成功，将会跳转到前台",U('Home/Index/index'));
    }

    public function passwd()
    {
       if($_SERVER['REQUEST_METHOD']=="POST"){

        $data = array('password' => I('post.password'),'newpassword'=>I('post.newpassword'));
        $where['username']='admin';
        $userdata=M('admin_user')->where($where)->find();
        if ($userdata['password']==md5($data['password']))
         {
             $savadata['password']=md5($data['newpassword']);
             $save=M('admin_user')->where($where)->save($savadata);
             if ($save) {
                 $this->success('密码修改成功！');
             }else{
                $this->error('密码修改失败！');
             }
         }
        else{
            $this->error('password error');
        }
       }

       else{
        $this->display();
       }
     

    }
}