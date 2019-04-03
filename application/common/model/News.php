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

    /*
     * 添加新闻内容操作
     * array $data 新闻各个字段的数据
     *
     */
    public function add($data){

        if(!is_array($data)){
            exception('传递的数据不合法');
        }
        $record=$this->allowField(true)->save($data);
        return $record;
    }

    /*
     * 获取所有的新闻内容
     * arr $where 查询的条件
     * string $field 要查询的字段
     * num $limit 限制查询的数目
     * array $order 顺序 如['id asc']
     * num $page 页数
     * num $listRows 每页的总数
     */
    public function getListNews($where=[],$field=null,$limit=null,$order=[],$page=null,$listRows=null){
        if(is_null($limit)){
            $result = model("news")->field($field)
                ->where($where)
                ->page($page,$listRows)
                ->order($order)
                ->select()
                ->toArray();
        }else{
            $result = model("news")->field($field)
                ->where($where)
                ->page($page,$listRows)
                ->order($order)
                ->limit($limit)
                ->select()
                ->toArray();
        }

        return $result;
    }


    /*
     * 获取查询数据的总数
     * arr $where 查询的条件
     * */
    public function getCount($where=[]){
        $result = model("news")->where($where)->count();
        return $result;
    }

    /*
     * 硬删除某条数据
     * num $id id值
     */
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