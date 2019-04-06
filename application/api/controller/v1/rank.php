<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/4/4
 * Time: 12:24 PM
 */
namespace app\api\controller\v1;
use app\api\controller\Common;

//新闻推荐排行页
class Rank extends Common{
    //获取排行榜数据列表
    public function index(){
        $page=input('get.page');
        $size=input('get.size');
        $catid=input('get.catid');
        if(!$page || !$size){
            return show(config('code.error'),'参数缺失',[],500);
        }
        $where=[
            'status'=>1,
            'catid'=>$catid,
        ];
        $field='id,title,small_title,description,image,read_count';
        $order=['read_count desc'];
        $record=model('News')->getListNews($where,$field,null,$order,$page,$size);
        return show(config('code.success'),'ok',$record,200);
    }


}