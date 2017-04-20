<?php
namespace Admin\Controller;
use Think\Controller;
class AboutController extends BaseController {

    public function index(){
        
        if($_SERVER['REQUEST_METHOD']=='POST')
            {
             
             $data = array('title' =>I('post.title') ,'content'=>I('post.content'),'salary1'=>I('post.salary1'),'salary2'=>I('post.salary2'),'salary3'=>I('post.salary3') );  
             
             $save = M('about')->where('id=1')->save($data);
                 if ($save) {
                     $this->success('修改成功',U('index'));
                }else{
                    $this->error('修改失败',U('index'));
                  }
            }else{

        $about = M('about') ->where('id=1') ->find();
        $this->assign('about',$about);
        $this->display();
            }
        }

    }
