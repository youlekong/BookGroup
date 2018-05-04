<?php

namespace App\Http\Controllers\H5;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\CaptchaHandle;

class SignController extends ApiController
{
    public function signIn(UserRequest $request)
    {
        $params = $request->all();

        return $this->success($params);
    }

    public function signUp(UserRequest $request)
    {

    }

    public function captcha()
    {
        $captcha = new CaptchaHandle;
        $content = $captcha->generateCaptcha();
        return Response()->make($content)->header('Content-Type', 'image/png');
    }
}