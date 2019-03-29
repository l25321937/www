<?php
namespace app\admin\controller;

class Admin extends Base
{
    public function index()
    {
//        return $this->fetch();
        return '123s';
    }

    //新增用户管理员
    public function add(){
        //判断是否是Post提交
        if(request()->isPost()){
            $data = input('post.');
            $validate = validate('AdminUser');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }

            $data['password'] = md5($data['password'].'_#sing_ty');
            $data['status'] =  1 ;

            //判断用户名是否存在
            $existPerson = model('AdminUser')->where(['username'=>$data['username']])->find();
            if($existPerson){
                $this->error('该用户名已存在！');
            }

            $id = model('AdminUser')->add($data);

            if($id){
                echo json_encode(['info'=>'提交成功','status'=>'y']);
            }else{
                echo json_encode(['info'=>'提交失败','status'=>'n']);
            }
        }else{
            return $this->fetch();
        }
    }

    //Ajax请求用户名验证
    public function checkUser()
    {
        $data = input('post.param');

        //判断用户名是否存在
        $existPersion = model('AdminUser')->where(['username' => $data])->find();

        if ($existPersion) {
            echo json_encode(['info' => '该用户名已注册']);
        } else {
            echo json_encode(['status'=>"y",'info'=>"该用户名可用"]);
        }
    }
}
