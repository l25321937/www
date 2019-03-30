<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/3/29
 * Time: 4:07 PM
 */

namespace app\api\controller;

use app\common\lib\IAuth;
use think\Controller;
use app\common\lib\Aes;
use think\Exception;
use app\common\lib\Time;

//API模块公共控制器
class Common extends Controller{
    //初始化成员属性$headers,方便日后调用header头数据
    public $headers=[];
    //初始化的方法
    public function _initialize(){

        $this->checkRequestAuth();
//      $this->testAes();
    }

    //校验每次app请求的数据是否合法
    public function checkRequestAuth(){
        //首先需要获取header头信息
        $headers=request()->header();
//        halt($headers);
        //判断sign参数是否存在
        if(empty($headers['sign'])){
            throw new exception('sign不存在',400);
        }

        //判断系统名是否正确
        if(!in_array($headers['app_type'],config('app.app_type'))){
            throw new exception('系统类型不合法',400);
        }

        //判断sign验签是否正确
        if(!IAuth::checkSignPass($headers)){
            throw new exception('授权码sign校验失败',401);
        }

        //定义header头数据
        $this->headers = $headers;

        //sign 加密需要客户端开发工程师 解密需要服务端开发工程师
    }


    public function testAes(){

        $headers = [
            'did'=>'edns6vf43jilkd',
            'version'=>'1.0.0',
            'time'=>Time::getTimeStamp(),
        ];
//        halt($headers);
        $string=http_build_query($headers);
//        dump($headers);
        $aes_string = (new Aes(config('app.aes_key')))->encrypt($string);
        echo $aes_string;exit;
    }
}