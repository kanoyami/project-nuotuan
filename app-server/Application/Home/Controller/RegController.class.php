<?php
namespace Home\Controller;
use Think\Controller;
/** 
 * 利用mcrypt做AES加密解密 
 * @author ts24<tsxw24@gmail.com> 
 */  
  
abstract class AES{  
    /** 
     * 算法,另外还有192和256两种长度 
     */  
    const CIPHER = MCRYPT_RIJNDAEL_128;  
    /** 
     * 模式  
     */  
    const MODE = MCRYPT_MODE_ECB;  
  
    /** 
     * 加密 
     * @param string $key   密钥 
     * @param string $str   需加密的字符串 
     * @return type  
     */  
    static public function encode( $key, $str ){  
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(self::CIPHER,self::MODE),MCRYPT_RAND);  
        return mcrypt_encrypt(self::CIPHER, $key, $str, self::MODE, $iv);  
    }  
      
    /** 
     * 解密 
     * @param type $key 
     * @param type $str 
     * @return type  
     */  
    static public function decode( $key, $str ){  
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(self::CIPHER,self::MODE),MCRYPT_RAND);  
        return mcrypt_decrypt(self::CIPHER, $key, $str, self::MODE, $iv);  
    }  
} 



class RegController extends BaseController {
    public function reg(){
                $phone =$_POST['phone'];

                if(M('user')->where('phone ='.$phone)->find()!=null){
                    $data['status'] = 3;
                    $data['info'] = 'phone is allready exist';
                    $data['size'] = 6;
                    $data['url'] = null;
                    $data['username'] = null;
                    $data['uid'] = null;
                    $this->ajaxReturn($data,'JSON');
                }



                $str = I('post.passwords').'001';
                $keystore = M('decodekey')->where('id = 1')->find();
                $key = $keystore['key'];
  
                $str1=AES::encode($key, $str);
                $token = base64_encode($str1);

                $savedata = array('username' =>I('post.name') , 'password' => I('post.passwords'),'email'=>I('post.email'),'phone'=>I('post.phone'),'token'=>$token);
                //$name = 'admin';
                //$passwd = '123456';
                
                $result = M('user')->add($savedata);

                $nowUser = M('user')->where('phone ='.$phone)->find();
                $default = array('Uid' => (int)$nowUser['uid'],'Gid'=>1 );
                $saveDefault = M('relations') -> add($default);

                $defaultDy = array('Uid' => (int)$nowUser['uid'],'description'=>"今天我来到糯团啦",'date'=>date("y-m-d",$time));
                $saveDefaultDy = M('u_dynamics') -> add($defaultDy);
                if($result != null){
                    $data['status'] = 1;
                    $data['info'] = 'registe success';
                    $data['size'] = 4;
                    $data['url'] = null;
                    $this->ajaxReturn($data,'JSON');
                }else{
                    $data['status'] = 0;
                    $data['info'] = 'registe error';
                    $data['size'] = 9;
                    $data['url'] = null;
                    $data['username'] = null;
                    $data['uid'] = null;
                    $this->ajaxReturn($data,'JSON');
                }

            }



           }