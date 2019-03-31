<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/3/16
 * Time: 11:28 AM
 */
namespace app\common\model;
use think\Model;

class Category extends Model{
    protected $autoWriteTimestamp = true;
    public function add(){

    }

    //$map 为条件
    public function getInfoByMap($map=[],$field=true){
        $result=$this->where($map)->field($field)->find()->hidden(['create_time','update_time']);
        return $result;
//        append的用法
//        return $result->append(['sex']);
    }

    //获取器的使用
//    public function getSexAttr(){
//        $sex=[1=>'male','0'=>'female','-1'=>'gay'];
//        return $sex;
//    }

    public function getListByMap($map=[],$field=true){
        return $this->where($map)->field($field)->select();
    }
}