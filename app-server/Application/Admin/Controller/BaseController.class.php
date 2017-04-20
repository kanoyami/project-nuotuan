<?php
namespace Admin\Controller;
use Think\Controller;
//基础控制器
class BaseController extends Controller {
    public function _initialize()

    {
       if (isset($_SESSION['username'])) {
           
       }else
       {
        $this->redirect('Public/login');
       }
    }

    
}