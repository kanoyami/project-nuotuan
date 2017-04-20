<?php
namespace Home\Controller;
use Think\Controller;


class PublishUserDynamicsController extends Permission1Controller {
   

    public function PublishUserDynamics(){
            if($_GET!=null){
                $data['status'] = -1;
                $data['info'] = 'cannot use POST to access this function';
                $data['size'] = 4;
                $data['url'] = null;
                $this->ajaxReturn($data,'JSON');
            }
            $uid =(int) $_POST['uid'];
            $imgsrc = $_POST['images'];
            $dynamicData = array('Uid'=>$uid,'description'=>I('post.content'),'date'=>date("Y-m-d"));
            $save = M('u_dynamics')->add($dynamicData);
            if($save){
            $data['status'] = 1;
            $data['info'] = 'save successed';
            $data['size'] = 4;
            $data['url'] = null;
            //$data['img'] = var_dump($imgsrc);
            $this->ajaxReturn($data,'JSON');
            }else{
            $data['status'] = 2;
            $data['info'] = 'error';
            $data['size'] = 4;
            $data['url'] = $url;

            $this->ajaxReturn($data,'JSON');
            }
           }


}