<?php
namespace Admin\Controller;
use Think\Controller;
class  NewsController extends BaseController {
    public function nlist(){

        $nlist=M('user')->order('Uid desc')->select();
        $this->assign('nlist',$nlist);
        $this->display();
    }


    public function add()
    {
        //增加banner
        if($_SERVER['REQUEST_METHOD']=='POST')
            {
               
                $data=array('content'=>$_POST['content'],'title'=>I('post.title'),'herf'=>I('post.herf'),'date'=>I('post.date'));
                $save = M('news')->add($data);
                if($save){
                    $this->success('添加成功',U('nlist'));
                }else{
                    $this->error('添加失败',U('nlist'));
                }
             }else{
                $this->display();
             }

}

public function newsdelete()
    {
        $where=I('post.id');

        $del=M('news')->where("uid=%d",$where)->delete();


        if ($del) {
            $this->success('删除成功',U('nlist'));
        }else{
            $this->error('删除失败',U('nlist'));
        }
    }
}