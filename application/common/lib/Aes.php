<?php
/*
* AES 算法
*/
namespace app\common\lib;

class Aes {

    private $hex_iv = '00000000000000000000000000000000';

    private $key = '397e2eb61307109f6e68006ebcb62f98';

    function __construct($key) {
        $this->key = $key;
        $this->key = hash('sha256', $this->key, true);
    }
    /*
    * 字符串加密 不写入文件
    */
    public function encrypt($input)
    {
        $data = openssl_encrypt($input, 'AES-256-CBC', $this->key, OPENSSL_RAW_DATA, $this->hexToStr($this->hex_iv));
        $data = base64_encode($data);
        return $data;
    }

    /*
    * aes 给PHP文件加密
    * 写入设置文件
    */
    public function filecrypt($filename)
    {
        $type=strtolower(substr(strrchr($filename,'.'),1));
        if ('php' == $type && is_file($filename) && is_writable($filename)) {
            $contents = file_get_contents($filename);
            // echo $contents;exit;
            $contents = php_strip_whitespace($filename);
            // echo $contents;exit;
            // $headerPos = strpos($contents,'<?php');
            // echo $headerPos;exit;


            // $contents = substr($contents, $headerPos + 5, $footerPos - $headerPos);
            // echo $contents;exit;
            $data = openssl_encrypt($contents, 'AES-256-CBC', $this->key, OPENSSL_RAW_DATA, $this->hexToStr($this->hex_iv));
            // echo $data;exit;
            $data = base64_encode($data);
            // echo $data;exit;
            return file_put_contents($filename, $data);
        }
        return false;
    }
    /*
    * 字符串解密
    */
    public function decrypt($input)
    {
        $decrypted = openssl_decrypt(base64_decode($input), 'AES-256-CBC', $this->key, OPENSSL_RAW_DATA, $this->hexToStr($this->hex_iv));
        return $decrypted;
    }

    /*
      For PKCS7 padding
     */

    private function addpadding($string, $blocksize = 16) {

        $len = strlen($string);

        $pad = $blocksize - ($len % $blocksize);

        $string .= str_repeat(chr($pad), $pad);

        return $string;

    }

    private function strippadding($string) {

        $slast = ord(substr($string, -1));

        $slastc = chr($slast);

        $pcheck = substr($string, -$slast);

        if (preg_match("/$slastc{" . $slast . "}/", $string)) {

            $string = substr($string, 0, strlen($string) - $slast);

            return $string;

        } else {

            return false;

        }

    }

    function hexToStr($hex)
    {

        $string='';

        for ($i=0; $i < strlen($hex)-1; $i+=2)

        {

            $string .= chr(hexdec($hex[$i].$hex[$i+1]));

        }

        return $string;
    }

}
$key = '397e2eb61307109f6e68006ebcb62f98';
$aes = new Aes($key);
$filename = __DIR__.'\exchange.php';
// $filename = 'Y6RCuF6ETPC5J57hfhxovg==';
// 加密
$string = $aes->filecrypt($filename);
// echo $string;
//echo "OK,加密完成！" ;