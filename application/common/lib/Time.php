<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/3/30
 * Time: 4:34 PM
 */
namespace app\common\lib;

class Time{
    //获取十三位的时间戳
    public static function getTimeStamp(){

        list($t1,$t2) = explode(' ', microtime());
        return $t2.ceil($t1*1000);
    }
}