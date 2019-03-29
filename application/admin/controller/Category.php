<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/3/16
 * Time: 11:24 AM
 */
namespace app\admin\controller;

class Category extends Base{
    public function add(){

    }

    public function getCategoryInfo(){
        $id=input('get.id');
        if(!$id){
            return json_encode(['code'=>501,'message'=>'缺少参数']);
        }
        $where=['status'=>1,'id'=>$id];
        $result = model('Category')->getInfoByMap($where,'category_name');
        if(!$result){
            return json_encode(['code'=>503,'message'=>'请求失败']);
        }
        echo json_encode(['code'=>200,'message'=>'请求成功','result'=>$result]);
    }



    public function getCategoryList(){
        $field='category_name';
        $result = model('Category')->getListByMap([],$field);
        $arr=[];
        foreach($result as $value){
            $arr[] = $value['category_name'];
        }
//        halt($arr);
        return json_encode(['code'=>200,'message'=>'请求成功','result'=>$arr]);

    }
}