<?php
namespace Admin\Controller;
use Think\Controller;
class  GroupDateController extends BaseController {
    public function glist(){

        $glist=M('group')->select();
        $this->assign('glist',$glist);
        $this->display();
    }


    public function add()
    {
        //增加banner
        if($_SERVER['REQUEST_METHOD']=='POST')
            {
                $data=array('name'=>I('post.name'),'lng'=>I('post.lng'),'lat'=>I('post.lat'),'description'=>I('description'));
                $save = M('group')->add($data);
                if($save){
                    $this->success('添加成功',U('glist'));
                }else{
                    $this->error('添加失败',U('glist'));
                }
             }else{
                $this->display();
             }

}

public function groupdelete()
    {
        $where=I('post.id');

        $del=M('group')->where("Gid=%d",$where)->delete();


        if ($del) {
            $this->success('删除成功',U('glist'));
        }else{
            $this->error('删除失败',U('glist'));
        }
    }
}