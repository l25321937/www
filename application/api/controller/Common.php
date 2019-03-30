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

//API模块公共控制器
class Common extends Controller{
    //初始化的方法
    public function _initialize(){

        $this->checkRequestAuth();
        //$this->unlockSign();
    }

    //校验每次app请求的数据是否合法
    public function checkRequestAuth(){
        //首先需要获取headers
        $headers=request()->header();
        if(empty($headers['sign'])){}

        //sign 加密需要客户端开发工程师 解密需要服务端开发工程师
    }


    //sign解密
    public function unlockSign($data){
        $string=(new aes(config('app.aes_key')))->decrypt($data);
        echo $string;exit;
    }
}