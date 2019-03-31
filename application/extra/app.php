<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/2/21
 * Time: 4:05 PM
 */

return [
    'password_pre_halt' => '_#sing_ty' ,//密码加密盐
    'aes_key'=>'144090060hyk', //aes密钥，服务端和客户端必须保持一致
    'app_type'=> ['ios','android','window','macOS','windowPhone','ubuntu'],//请求app的系统
    'app_sign_time'=>10000,//app请求的失效时间
    'app_sign_cache_time'=>2000,//sign缓存失效时间
];