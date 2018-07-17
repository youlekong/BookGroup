<?php

namespace App\Handlers;

use Illuminate\Support\Facades\Log;

class CaptchaHandle
{
    public static function generateCaptcha()
    {
        ob_clean();

        $charset = 'abcdefghkmnprstuvwxyzABCDEFGHKMNPRSTUVWXYZ23456789';
        $code = ''; //验证码
        $codelen = 4; //验证码长度
        $width = 102; //宽度
        $height = 40; //高度
        // if (strrpos(strtolower(PHP_OS), "win") === false) {
        //     $font = '/usr/share/fonts/bitstream-vera/VeraBd.ttf';
        // } else {
        //     $font = public_path('fonts/captcha/VeraBd.ttf'); //指定的字体
        // }
        $font = public_path('fonts/captcha/VeraBd.ttf'); //指定的字体
        $fontsize = 20; //指定字体大小
        $img = imagecreatetruecolor($width, $height);
        $color = imagecolorallocate($img, mt_rand(157, 255), mt_rand(157, 255), mt_rand(157, 255));
        imagefilledrectangle($img, 0, $height, $width, 0, $color);

        $_len = strlen($charset) - 1;
        for ($i = 0; $i < $codelen; $i++) {
            $code .= $charset[mt_rand(0, $_len)];
        }

        for ($i = 0; $i < 6; $i++) {
            $color = imagecolorallocate($img, mt_rand(0, 156), mt_rand(0, 156), mt_rand(0, 156));
            imageline($img, mt_rand(0, $width), mt_rand(0, $height), mt_rand(0, $width), mt_rand(0, $height), $color);
        }
        for ($i = 0; $i < 100; $i++) {
            $color = imagecolorallocate($img, mt_rand(200, 255), mt_rand(200, 255), mt_rand(200, 255));
            imagestring($img, mt_rand(1, 5), mt_rand(0, $width), mt_rand(0, $height), '*', $color);
        }
        $_x = $width / $codelen;
        for ($i = 0; $i < $codelen; $i++) {
            $fontcolor = imagecolorallocate($img, mt_rand(0, 156), mt_rand(0, 156), mt_rand(0, 156));
            imagettftext($img, $fontsize, mt_rand(-30, 30), $_x * $i + mt_rand(1, 5), $height / 1.4, $fontcolor, $font, $code[$i]);
        }

        session()->put('captcha', $code);

        ob_start();
        imagepng($img);
        $content = ob_get_contents();
        imagedestroy($img);
        ob_end_clean();

        return $content;//$response = Response()->make($content)->header('Content-Type', 'image/png');
    }

    public static function getCaptchaCode() {
        $code = session()->get('captcha');
        session()->forget('captcha');
        return strtolower($code);
    }
}