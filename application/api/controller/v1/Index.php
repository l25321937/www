<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/4/3
 * Time: 11:31 AM
 */
namespace app\api\controller\v1;
use app\api\controller\Common;

class Index extends Common{
    /*
     * 获取首页头图
     */
    public function headImg(){
        $where=['status'=>1,'is_head_figure'=>1];
        $images=model('News')->getListNews($where,'image',3);
        return show(config('code.success'),'ok',$images,200);
    }

    /*
     * 获取推荐位
     */
    public function getPosition(){
        $where=['status'=>1,'is_position'=>1];
        $position=model('News')->getListNews($where,'id,image,title,catid,read_count',null,'id desc');
        $cats=$this->getDealNews();
        $arr=[];
        foreach($position as $key=>$value){
            $arr[$key]['id']=$value['id'];
            $arr[$key]['iamge']=$value['image'];
            $arr[$key]['title']=$value['title'];
            $arr[$key]['catid']=$cats[$value['catid']];
            $arr[$key]['read_count']=$value['read_count'];
        }

        return show(config('code.success'),'ok',$arr,200);
    }



}