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
     * @param array $data 新闻各个字段的数据
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
     * 获取多条新闻内容
     * @param arr $where 查询的条件
     * @param string $field 要查询的字段
     * @param num $limit 限制查询的数目
     * @param array $order 顺序 如['id asc']
     * @param num $page 页数
     * @param num $listRows 每页的总数
     */
    public function getListNews($where=[],$field=true,$limit=null,$order=[],$page=null,$listRows=null){
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
     * @param arr $where 查询的条件
     * @param string $field 要查询的字段
     *
     */
    public function getNew($where=[],$field=null){
        $result = model('news')->where($where)
                            ->field($field)
                            ->find()
                            ->toArray();

        return $result;
    }


    /*
     * 获取查询数据的总数
     * @param arr $where 查询的条件
     *
     */
    public function getCount($where=[]){
        $result = model("news")->where($where)->count();
        return $result;
    }

    /*
     * 硬删除某条数据
     * @param num $id id值
     */
    public function delNew($id)
    {
       $record = $this->destroy(['id'=>$id]);
       return $record;
    }

    /*
     * 改变新闻的状态
     * @param num $id 新闻id
     * @param num $status 要更新设置的新闻状态
     */
    public function changeStatus($id,$status){
        $record = $this->where('id',$id)->update(['status'=>$status]);
        return $record;
    }

    /*
     * 新闻字段自增
     * @param arr $where 条件
     * @param string $field 要自增的字段
     * @param num $num 自增步长
     */
    public function countInc($where=[],$field,$num=1){
        $record = $this->where($where)->setInc($field,$num);
        return $record;
    }


    /*
     * 更新一条新闻内容
     * @param arr $where 条件
     * @param arr $allowField 允许更新的字段,格式如['name','email']
     * @param arr $data 更新的数据
     */
    public function updateNew($where=[],$data){
        $record=$this->isUpdate(true)->save($data,$where);
        return $record;
    }

}