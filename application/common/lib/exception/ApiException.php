<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/3/29
 * Time: 2:21 PM
 */

namespace app\common\lib\exception;
use think\exception;

class ApiException extends exception{
    /*
     * @param string $message
     * @param int $httpCode
     * @param $code = 0
     */
    public $message = '';
    public $httpCode =500;
    public $code = 0;
    public function __construct($message = '',$httpCode =0,$code =0){
            $this->httpCode = $httpCode;
            $this->message = $message;
            $this->code = $code;
    }
}