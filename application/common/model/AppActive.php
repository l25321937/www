<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/4/8
 * Time: 11:29 PM
 */
namespace app\common\model;
use think\Model;

class AppActive extends Model{
    protected $autoWriteTimestamp = true;
    /*
     * 增加app用户的记录
     *
     */
    public function addActive($active){
        $record=$this->save($active);
        return $record;
    }
}