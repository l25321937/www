<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

/*
 * 通用化API接口数据输出
 * @param int $status 业务状态吗
 * @param string $message 信息提示
 * @param array $data 数据
 * @param int $httpCode http状态码
 * @return array
 */
function show($status, $message ,$data=[], $httpCode=200){
    $result = [
        'status'=>$status,
        'message'=>$message,
        'data'=>$data,
    ];
    return json($result,$httpCode);
};