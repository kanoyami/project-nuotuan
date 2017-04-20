<?php
namespace Home\Controller;
use Think\Controller;


class IndexController extends BaseController {

    public function index(){


                $positionx = (double)$_GET['lng'];
                $positiony = (double)$_GET['lat'];
                $positionx1=$positionx+0.100000;
                $positionx2=$positionx-0.100000;
                $positiony1=$positiony+0.100000;
                $positiony2=$positiony-0.100000;
                $groups = M('group')->where('lng<'.$positionx1.' AND lng>'. $positionx2.' AND lat<'.$positiony1.' AND lat>'.$positiony2)->select(); 
                $data['status'] = 1;
                $data['info'] = 'info';
                $data['size'] = 6;
                $data['url'] = $url;
                $data['length'] =count( $groups);
for ((int)$i=0; $i < $data['length']; $i++) { 
    $data['datas'][$i]['lat'] = $groups[$i]['lat'];
    $data['datas'][$i]['lng'] = $groups[$i]['lng'];
    $data['datas'][$i]['groupName'] = $groups[$i]['name'];
    $data['datas'][$i]['gid'] = $groups[$i]['gid'];
}
    $this->ajaxReturn($data,'JSON');

           }
}