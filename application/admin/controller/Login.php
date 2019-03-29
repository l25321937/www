<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/2/21
 * Time: 3:00 PM
 */

namespace app\admin\controller;
use app\common\lib\IAuth;

class Login extends Base{
    public function _initialize(){
    }

    public function index(){
        //如果后台用户已经登录，需要跳转到后台首页
        $isLogin=$this->isLogin();
        if($isLogin){
            $this->redirect('index/index');
        }else{
            return $this->fetch();
        }
        return $this->fetch();
    }

    public function check(){
        if(request()->isPost()){
            $data = input('post.');
            //判断输入的验证码是否正确
            if(!captcha_check($data['code'])){
                $this->error('验证码不正确');
            }

            try{
                $user=model('AdminUser')->get(['username' => $data['username']]);
            }catch (\Exception $e){
                $e->getMessage();
            }

            if(!$user || $user->status != config('code.status_normal')){
                $this->error('该用户不存在');
            }

            if(IAuth::setPassword($data['password']) != $user['password']){
                $this->error('密码不正确');
            }

            //更新数据库，如登录时间，登录ip
            $udata=['last_login_time' => time(),
                    'last_login_ip' => request()->ip()
                ];
            try{
                model('AdminUser')->save($udata,['id'=>$user->id]);
            }catch(\Exception $e){
                $e->getMessage();
            }


            //将数据保存于session中
            session(config('admin.session_user'), $user ,config('admin.session_user_scope'));
            $this->success('登陆成功','index/index');
        }else{
            $this->error('请求不合法');
        }

    }

    public function logout(){
        session(null , config('admin.session_user_scope'));
        $this->redirect('login/index');
    }
}