<?php
namespace app\admin\controller;

class Admin extends Base
{
    public function index()
    {
//        return $this->fetch();
        return '123s';
    }

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

            //捕捉异常
            try{
                $id = model('AdminUser')->add($data);
            }catch (\Exception $e){
                echo $e->getMessage();
            }

            if($id){
                $this->success('id='.$id.'的用户新增成功');
            }else{
                $this->error('插入失败');
            }
        }else{
            return $this->fetch();
        }
    }
}
