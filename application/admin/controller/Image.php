<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/2/22
 * Time: 11:47 AM
 */

namespace app\admin\controller;
use think\Request;
use app\common\lib\Upload;

class Image extends Base
{

    /*本地图片上传*/
    public function upload(){
        //file方法里的参数名必须与文件上传域的name相同
        $file = Request::instance()->file('file');
        //把图片上传到指定文件夹中,下面代码会在public中新建一个upload文件夹，并把图片存入按时间日期命名的新建文件夹内
        $info = $file->move('upload');
        if($info && $info->getPathname()){
            $data = [
                'status'=>1,
                'message'=>'ok',
                'data'=>'/'.$info->getPathname(),
            ];
            echo json_encode($data);exit;
        }
        echo json_encode(['status'=>0,'message'=>'上传失败']) ;
    }

    /*七牛图片上传*/
    public function qiniuUpload(){
        try {
            $image = Upload::image();
        }catch(\Exception $e){
            echo json_encode(['status' => 0, 'message' => $e -> getMessage()]);
        }
        if($image){
            $data = [
                'status'=>1,
                'message'=>'ok',
                'data'=> config('qiniu.image_url').'/'.$image,
            ];
            echo json_encode($data);exit;
        } else {
            echo json_encode(['status' => 0, 'message' => '上传失败']);
        }
    }
}