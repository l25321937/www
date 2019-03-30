<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/2/21
 * Time: 4:02 PM
 */
namespace app\common\lib;
use app\common\lib\Aes;
class IAuth{
    //设置密码
    public static function setPassword($data){
        return md5($data.config('app.password_pre_halt'));
    }

    /*
     * 生成每次请求的sign
     * @param array $data
     * @return string
     */
    public static function setSign($data=[]){
        //1.按字段排序
        ksort($data);
        //2.生成 URL-encode 之后的请求字符串,如：device=iphone6s&time=4321333
        $string=http_build_query($data);
        //3.通过aes加密
        $aes_string=(new aes(config('app.aes_key')))->encrypt($string);
        return $aes_string;
    }
}