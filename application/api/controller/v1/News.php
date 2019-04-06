<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/4/4
 * Time: 10:33 AM
 */

namespace app\api\controller\v1;
use app\api\controller\Common;

class News extends Common{
    public function index(){
        $catId=input('get.catid');
        $page=input('get.page');
        $size=input('get.size');

        if(!$catId || !$page || !$size ){
            return show(config('code.error'),'参数不完整',[],500);
        }
        $where=['catid'=>$catId,'status'=>1];
        $news=model('News')->getListNews($where,'id,small_title,image,description,read_count',null,['create_time desc'],$page,$size);
        $total=model('News')->getCount($where);
//        halt($total);
        $result=[
            'total'=>$total,
            'page'=>$page,
            'size'=>$size,
            'list'=>$news,
        ];

        return show(config('code.success'),'ok',$result,200);
    }
}