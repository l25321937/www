<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/3/18
 * Time: 1:29 PM
 */

namespace app\common\model;
use think\Model;

class News extends Model{
    protected $autoWriteTimestamp = true;
    public function add($data){
        if(!is_array($data)){
            exception('传递的数据不合法');
        }
        $record=$this->allowField(true)->save($data);
        return $record;
    }

    //获取所有的新闻内容
    public function getNews($where=[],$field=null,$page=null,$listRows=null){
        $result = model("news")->field($field)->where($where)->page($page,$listRows)->select();
        return $result;
    }

    public function getCount($where=[]){
        $result = model("news")->where($where)->count();
        return $result;
    }

    public function delNew($id)
    {
       $record = $this->destroy(['id'=>$id]);
       return $record;
    }

    public function changeStatus($id,$status){
        $record = $this->where('id',$id)->update(['status'=>$status]);
        return $record;

    }

}