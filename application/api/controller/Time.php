<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/3/31
 * Time: 3:43 PM
 */

namespace app\api\controller;

use think\Controller;

class Time extends Controller{
    public function index(){
        return show(1,'ok',time());
    }
}