<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/3/29
 * Time: 12:25 PM
 */
namespace  app\api\controller;
use think\Controller;

class Test extends Controller{
    public function index(){
        return [
            'status'=>200,
            'message'=>'测试成功'
        ];
    }

    public function update($id=0){
        halt(input('put.'));
//        return $id;
    }

    public function delete($id=0){
        halt(input('delete.'));
    }

    public function save(){
        return show(1,'ok',input('post.'),201);
    }
}