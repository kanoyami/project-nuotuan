<?php
namespace Home\Controller;
use Think\Controller;


class BaseController extends Controller {

     public function _initialize()

    {
       if ($_GET!=null||$_POST!=null){

       }else{
                    $data['status'] = 2;
                    $data['info'] = 'no datas catched';
                    $data['size'] = 4;
                    $data['url'] = null;
                    $this->ajaxReturn($data,'JSON');
       }
    }
  }