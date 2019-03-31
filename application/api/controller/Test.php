<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/3/29
 * Time: 12:25 PM
 */
namespace app\api\controller;
use app\common\lib\exception\ApiException;
use app\common\lib\Aes;
class Test extends Common
{
    public function index(){
        return [
            'status'=>200,
            'message'=>'测试成功'
        ];
    }

    public function update($id=0){
        $result=model("Category")->getListByMap();

        halt($result);
//        return $id;
    }

    public function delete($id=0){
        halt(input('delete.'));
    }

    public function save(){
//        if($data['ids']){
//            echo 1;exit;
//        }
        $data =input('post.');
//        halt($data);
        if($data['mt']!=1){
            throw new ApiException('您提交的数据不合法',400);
        }


        return show(1,'ok',(new Aes(config('app.app_key')))->encrypt(json_encode($data)),201);
//        return show(1,'ok',input('post.'),201);
    }
}