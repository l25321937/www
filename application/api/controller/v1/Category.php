<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/3/31
 * Time: 10:38 PM
 */
namespace app\api\controller\v1;
use app\api\controller\Common;

class Category extends Common
{
    public function index(){
        $record=model('Category')->getListByMap([],'id,category_name');
        $record[count($record)+1]=['id'=>4,'category_name'=>'首页'];

        return show(config('code.success'),'ok',$record,200);
    }

}