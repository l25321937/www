<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/2/21
 * Time: 7:26 PM
 */

namespace app\admin\controller;

class News extends Base{
    //添加新闻
    public function add(){
        if(request()->isPost()){
            $data['title'] = input('post.title');
            $data['small_title'] = input('post.small_title');
            $data['catid'] = input('post.catid');
            $data['description'] = input('post.description');
            $data['is_allowcomments'] = input('post.is_allowcomments',0);
            $data['is_head_figure'] = input('post.is_head_figure',0);
            $data['is_position'] = input('post.is_position',0);
            $data['image'] = input('post.pic','');
            $data['content'] = input('post.content');
            try{
                $result=model('News')->save($data);
            }catch(\Exception $e){
                return json_encode(['info'=>$e->getMessage(),'status'=>'n',]);
            }

            return json_encode(['info'=>'新增成功','status'=>'y']);
        }else{
            return $this->fetch();
        }
    }

    //渲染新闻列表页面
    public function index(){
            return $this->fetch();
    }

    //获取新闻内容
    public function getNews(){
        $where = ['status'=>['in',[1,0]]];
        $result = model("news")->getNews($where);

        foreach ($result as $key=>$value){
             $arr[$key]['id']=$value['id'];
             $arr[$key]['title']=$value['title'];
             $arr[$key]['small_title']=$value['small_title'];
             $arr[$key]['catid']=$value['catid'];
             $arr[$key]['image']=$value['image'];
             $arr[$key]['create_time']=$value['create_time'];
             $arr[$key]['update_time']=$value['update_time'];
             $arr[$key]['status']= ($value['status']==1)?" <button class='layui-btn layui-btn-primary layui-btn-xs' name='status' value='".$value['status']."' data='".($value['id'])."'>已发布</button>":"<button class='layui-btn layui-btn-xs layui-btn-normal' name='status' data='".($value['id'])."' value='".$value['status']."'>待审核</button>";
             $arr[$key]['option']="<div class='layui-btn-group'><button class='layui-btn'>编辑</button><button name='del' class='layui-btn' value='".($value['id'])."'>删除</button></div>";
        }
        echo json_encode(['data'=>$arr]);
    }

    //按条件筛选新闻内容
    public function searchNews(){

        $catId=input('get.catid');
        $startTime=input('get.startTime','');
        $endTime=input('get.endTime','');
        $keyword=input('get.keyword');

        //栏目分类的条件
        $where=is_null($catId) || $catId==0 ? []:['catid'=>$catId];
        //时间分类的条件
        if($startTime && $endTime){
            $where['create_time']=['between time',[$startTime,$endTime]];
        }
        //关键词的条件

        $where['title|small_title|content']=['like','%'.$keyword.'%'];
        $result = model("news")->getNews($where);

        return json_encode($result);
    }

    //新闻硬删除
//    public function delNew(){
//       $id = input('get.id');
//       if($id){
//           $result = model("news")->delNew($id);
//           return json_encode(['code'=>$result,'message'=>'请求成功']);
//       }else{
//           return json_encode(['code'=>0,'message'=>'请求失败']);
//       }
//    }

    //新闻软删除
    public function delNew(){
       $id = input('id');
       //在news表中-1代表删除
       $res=$this->updateStatus($id,-1);
       if($res){
           return json_encode(['code'=>200,'message'=>'更新成功']);
       }

    }

    //切换状态
    public function switchStatus(){
        $data  = input('status');
        if(is_null($data)){
            return json_encode(['code'=>501,'message'=>'参数缺省']);
        }


        $id = input('id');
//        halt($data);
        $status = $data==1 ? 0:1 ;
        $res=$this->updateStatus($id,$status);
        if($res){
            return json_encode(['code'=>200,'message'=>'更新成功']);
        }
    }

    //



}