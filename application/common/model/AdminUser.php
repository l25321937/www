<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/2/21
 * Time: 1:44 PM
 */

namespace app\common\model;
use think\Model;

class AdminUser extends Model{
    protected $autoWriteTimestamp = true;
    public function add($data){
        if(!is_array($data)){
            exception('传递数据不合法');
        }
        $this->allowField(true)->save($data);
        //获取自增id,即是插入数据的最后一个id

        return $this->id;
    }
}