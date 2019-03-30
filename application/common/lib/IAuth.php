<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/2/21
 * Time: 4:02 PM
 */
namespace app\common\lib;

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

    /*
     * 检查sign是否正常
     * @param array $headers 请求头文件
     * @return boolean
     */
    public static function checkSignPass($headers){
        //对header头信息的sign进行aes解密
        $str = (new aes(config('app.aes_key')))->decrypt($headers['sign']);
        //判断$str是否为空
        if(empty($str)){
            return false;
        }
        //把查询字符串解析到$arr数组中
        parse_str($str,$arr);
        //判断$arr是否存在，判断数组中是否存在did的数据，判断数组中是否存在version的数据，判断sign解密后的did数据是否和header头信息的did数据相符
        if(!is_array($arr) || empty($arr['did']) || empty($arr['version']) ||$arr['did'] != $headers['did'] ){
            return false;
        }

        //判断请求时间是否超过10分钟
        if((time()-ceil($arr['time']/1000))>config('app.app_sign_time')){
            return false;
        }

        return true;
    }
}