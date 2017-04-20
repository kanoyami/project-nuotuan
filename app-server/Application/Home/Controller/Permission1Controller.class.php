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

class Permission1Controller extends Controller {

     public function _initialize()

    {

          $data = null ;
          $token = null;
       if ($_GET!=null||$_POST!=null) {
          if($_GET!=null){
              $token = I('get.token');
          }else{
              $token =urldecode( I('post.token'));

          }
           $data['token'] = $token ;
           $decodekey = base64_decode($token);
           $keystore = M('decodekey')->where('id = 1')->find();
           $key = $keystore['key'];
           $str =AES::decode($key,$decodekey);          
           $tokenKey = substr($str,32,3);
           $data['str'] = $tokenKey;
           if($tokenKey=='001'||$tokenKey=='002'){
           }else{
                    $data['status'] = 0;
                    $data['info'] = 'access denied';
                    $data['size'] = 4;
                    $data['url'] = null;

                    $this->ajaxReturn($data,'JSON');
           }
       }else{
                    $data['status'] = 2;
                    $data['info'] = 'no datas catched';
                    $data['size'] = 4;
                    $data['url'] = null;
                    $this->ajaxReturn($data,'JSON');
       }
    }
}