<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/4/4
 * Time: 11:19 AM
 */

namespace app\api\controller\v1;
use app\api\controller\Common;

//新闻搜索页列表
class Search extends Common
{
    public function index(){
        $keyword=input('get.keyword');
        if(!$keyword){
            return show(config('code.error'),'参数缺失',[],500);
        }
        $where=[
            'status'=>1,
            'title|small_title|content|description'=>['like','%'.$keyword.'%'],
        ];
        $result=model('News')->getListNews($where,'id,title,small_title,image,description,read_count',null);
        return show(config('code.success'),'ok',$result,200);
    }
}