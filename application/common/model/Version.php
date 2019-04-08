<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/4/8
 * Time: 1:00 PM
 */
namespace app\common\model;
use think\Model;

class Version extends Model{
    protected $autoWriteTimestamp = true;

    /*
     * 获取一条版本信息
     * @param arr $where
     *
     */
    public function getVersion($where,$order,$limit){
        return $this->where($where)->order($order)->limit($limit)->find()->toArray();
    }
}