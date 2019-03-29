<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/2/21
 * Time: 12:43 PM
 */

namespace app\common\validate;
use think\Validate;
class AdminUser extends Validate{
    protected $rule = [
        'username' => 'require|max:20',
        'password' => 'require|max:20',
    ];
}