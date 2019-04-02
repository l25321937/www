<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/2/21
 * Time: 5:10 PM
 */
namespace app\admin\controller;
use app\common\lib\ToolsService;
use think\Controller;


class Base extends Controller
{
    //初始化方法
    public function _initialize()
    {
        ToolsService::corsOptionsHandle();
       $isLogin = $this->isLogin();
       if(!$isLogin){
           return $this->redirect('login/index');
       }
    }

    //判断用户是否登录
    public function isLogin(){
        $user = session(config('admin.session_user'), '' ,config('admin.session_user_scope'));
        if($user && $user->id){
            return true;
        }

        return false;
    }

    //更新状态逻辑
    public function updateStatus($id, $status){
        //验证id参数是否存在
        if(!intval($id)){
            return json_encode(['code'=>401,'message'=>'ID不合法']);
        }

        $model = $this->model ?? request()->controller();

        try{
            model($model)->changeStatus($id,$status);
        }catch(\Exception $e){
            return json_encode(['code'=>404,'message'=>'更新状态失败','result'=>$e->getMessage()]);
        }
        return true;
    }




}