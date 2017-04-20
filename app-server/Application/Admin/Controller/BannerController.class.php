<?php
namespace Admin\Controller;
use Think\Controller;
class BannerController extends BaseController {
    public function index(){
        $this->display();
    }

    public function add()
    {
        //增加banner
        if($_SERVER['REQUEST_METHOD']=='POST')
            {
                $data=array('herf'=>I('post.herf'),'title'=>I('post.title'));
                //dump($data);
                $upload = new \Think\Upload();// 实例化上传类
                    $upload->maxSize   =     3145728 ;// 设置附件上传大小
                    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                    $upload->rootPath  =     './Public/home/resources/banner/'; // 设置附件上传根目录
                    $upload->savePath  =     ''; // 设置附件上传（子）目录
    // 上传文件 
                    $info   =   $upload->upload();
                if(!$info) {// 上传错误提示错误信息
                    $this->error($upload->getError());
                }else{// 上传成功
                    $data['src']="Public/home/resources/banner/".$info['src']['savepath'].$info['src']['savename'];
                    $save = M('bannervideo')->add($data);
                   if ($save) {
                        $this->success('上传成功！',U('blist'));
                   }else{
                        $this->error('添加失败',U('blist'));
                   }
                  
    }

                
            }else{
                $this->display();
            }
        
    }
        public function blist()
    {
        //增加banner
        $blist=M('bannervideo')->select();
        $this->assign('blist',$blist);
        $this->display();
    }

    public function Bannerdelete()
    {
        $where=I('post.id');

        $del=M('bannervideo')->where("id=%d",$where)->delete();


        if ($del) {
            $this->success('删除成功',U('blist'));
        }else{
            $this->error('删除失败',U('blist'));
        }
    }
}

