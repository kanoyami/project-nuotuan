<?php
namespace Home\Controller;
use Think\Controller;


class GetUserDynamicController extends Permission1Controller {
   

    public function GetUserDynamic(){
            if($_GET!=null){
                $data['status'] = -1;
                $data['info'] = 'cannot use POST to access this function';
                $data['size'] = 4;
                $data['url'] = null;
                $this->ajaxReturn($data,'JSON');
            }


            $did =(int) $_POST['did'];
            $uid =(int) $_POST['uid'];
            $dynamic = M('u_dynamics') ->where('Uid ='.$uid)->order('did asc')->select();

            if($dynamic[(count($dynamic)-1)]['did']==$did){
                $data['length'] = 0;
                $data['status'] = 2;
                $data['info'] = 'no more new datas';
                $data['size'] = 4;
                $data['url'] = $url;
                $this->ajaxReturn($data,'JSON');

            }else if($dynamic[(count($dynamic)-1)]['did']>$did&&$did!=null){


                $num_temp = null ; 
                for ($i=0; $i < count($dynamic) ; $i++) { 
                   if($dynamic[$i]['did']==$did) {
                        $num_temp=$i;
                        break;
                   }
                }

                for ($i=0; $i < ($num_temp+1) ; $i++) { 
                  array_splice($dynamic,0,1); 
                }
            $data['datas'] = $dynamic;
            $data['length'] = count($dynamic);
            $data['status'] = 1;
            $data['info'] = 'permission access';
            $data['size'] = 4;
            $data['url'] = null;
            $this->ajaxReturn($data,'JSON');

            }else{
            $data['datas'] = $dynamic;
            $data['length'] = count($dynamic);
            $data['status'] = 1;
            $data['info'] = 'permission access';
            $data['size'] = 4;
            $data['url'] = $url;

            $this->ajaxReturn($data,'JSON');
            }
           }



    public function GetMoreUserDynamic(){
        if($_GET!=null){
                $data['status'] = -1;
                $data['info'] = 'cannot use GET to access this interface';
                $data['size'] = 4;
                $data['url'] = null;
                $this->ajaxReturn($data,'JSON');
            }
            $DATA_ID = $_POST['data_id'];
            $uid =(int) $_POST['uid'];

            $dynamic = M('u_dynamics') ->where('Uid ='.$uid)->order('did asc')->select();



            if($DATA_ID >= count($dynamic)){
                $data['length'] = 0;
                $data['status'] = 2;
                $data['info'] = 'no more datas';
                $data['size'] = 5;
                $data['url'] = $url;
                $this->ajaxReturn($data,'JSON');

            }

            

            $dynamic =  array_slice($dynamic,$DATA_ID,3) ;
                


            $data['datas'] = $dynamic;
            $data['length'] = count($dynamic);
            $data['status'] = 1;
            $data['info'] = 'permission access';
            $data['size'] = 6;
            $data['url'] = $url;

            $this->ajaxReturn($data,'JSON');

           }
}