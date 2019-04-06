<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/4/4
 * Time: 12:46 PM
 */
namespace app\api\controller\v1;
use app\api\controller\Common;

class Content extends Common
{
    public function index(){
        $id=input('get.id',0,'intval');
        if(!$id){
            return show(config('code.error'),'参数不完整',[],500);
        }
        $where=['status'=>1,
                'id'=>$id,
                ];

        $record=model('News')->getNew($where,'id,title,read_count,content,image,catid,create_time');
        $inc=model('News')->countInc(['id'=>$id],'read_count');
        if(!($inc==1)){
            return show(config('code.error'),'阅读书自增失败',[],500);
        }

        if(!$record){
            return show(config('code.error'),'该新闻不存在',[],500);
        }

        $category=$this->getDealNews();
        $arr=[];
        $arr['key'] = $record['id'];
        $arr['title'] = $record['title'];
        $arr['read_count'] = $record['read_count'];
        $arr['content'] = $record['content'];
        $arr['image'] = $record['image'];
        $arr['cat'] = $category[$record['catid']];
        $arr['create_time'] = $record['create_time'];
        return show(config('code.success'),'ok',$arr,200);
    }
}
