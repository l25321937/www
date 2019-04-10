<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/4/3
 * Time: 11:31 AM
 */
namespace app\api\controller\v1;
use app\api\controller\Common;
use app\common\lib\exception\ApiException;

//返回首页页面
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


    /*
     * 客户端初始化接口
     *
     *
     */
    public function init(){

        //1.检测APP是否需要升级
        $where=[
            'app_type'=>'android',
            'status'=>1,
        ];
        $order='version desc';
        $limit=1;
        $version = model('Version')->getVersion($where,$order,$limit);
        if(empty($version)){
            return new ApiException('error',404);
        }

        //$version['is_update'] 的值为0时不更新，1为需要更新，2为强制更新
        if($version['version'] > $this->headers['version']){
            $version['is_update'] = $version['is_force'] ? 2 : 1;
        }else{
            $version['is_update'] = 0;
        }

        //2.记录用户的基本信息，用于统计
        $actives=[
            'version'=> $this->headers['version'],
            'app_type'=> $this->headers['app_type'],
            'did'=> $this->headers['did'],
            'version_code'=>$this->headers['version_code'],
        ];

        try{
            model('AppActive')->addActive($actives);
        }catch(\Exception $e){
            echo $e->getMessage();
        }

        return show( config('code.success'),'ok',$version,200);
    }

}