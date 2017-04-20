<?php
namespace Admin\Controller;
use Think\Controller;
class LinkController extends BaseController {

    public function index(){
        
        if($_SERVER['REQUEST_METHOD']=='POST')
            {
             
             $data = array('salary1'=>I('post.salary1'),'salary2'=>I('post.salary2') );  
             
             $save = M('about')->where('id=2')->save($data);
                 if ($save) {
                     $this->success('修改成功',U('index'));
                }else{
                    $this->error('修改失败',U('index'));
                  }
            }else{
        
        $about = M('about') ->select();
        $this->assign('about',$about[1]);
        $this->display();
            }
        }

    }
