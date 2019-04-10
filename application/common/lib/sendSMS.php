<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/4/10
 * Time: 2:37 PM
 */
namespace app\common\lib;
use yuntongxun\sendSms\SendCode;
use think\Cache;
use think\Log;
class sendSMS{
    /*
     * 声明一个静态变量，要来保存类中的唯一一个实例
     */
    private static  $_instance = null;

    /*
     * 声明一个私有的构造方法，为了防止外部代码使用new来创建对象
     */
    private function __construct()
    {

    }

    /*
     * 声明一个getInstance()静态方法
     * 单例模式的唯一入口，用于检测是否有实例对象
     */
    public static function getInstance(){
        if(is_null( self::$_instance)){
            //保存类中的唯一一个实例
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /*
     * 设置短信验证码
     * @param string $phone 手机号码，如 '18928211756'
     * @param string $time 过期时间,如 '5'
     */
    public function sendMessage($phone,$time){
        //如果手机号码不存在，则返回false;
        if(!$phone || !$time){
            return false;
        }

        //随机生成验证码
        $code=rand(1000,9999);
        //实例化sdk包里的sendCode()
        try{
            $sendSms = new SendCode();
            $record = $sendSms->sendTemplateSMS($phone,array($code,$time),"1");
        }catch (\Exception $e){
            Log::write('set--------'.$e->getMessage());
            return false;
        }

        if($record['success_msg'] !== 'Sendind TemplateSMS success!'){
            return false;
        }
        //容联云通讯已做了验证码过期的限制，后端也去设置验证码的失效时间
        Cache::set($phone,config('ronglianyun.identify_time'));
        return true;
   }

   /*
    * 根据手机号码查询验证码是否存在
    * @param string $phone 手机号码，如 '18928211756'
    */
   public function checkSmsIdentify($phone=0){
        if(!$phone){
            return false;
        }   
        return Cache::get($phone);
   }

}