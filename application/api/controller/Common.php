<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/3/29
 * Time: 4:07 PM
 */

namespace app\api\controller;
use think\Controller;

//API模块公共控制器
class Common extends Controller{
    //初始化的方法
    public function _initialize(){

        $this->checkRequestAuth();
    }

    //校验每次app请求的数据是否合法
    public function checkRequestAuth(){
        //首先需要获取headers
        $headers=request()->header();
        halt($headers);
    }
}