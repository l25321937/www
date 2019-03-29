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
}