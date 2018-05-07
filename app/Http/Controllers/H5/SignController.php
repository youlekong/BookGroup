<?php

namespace App\Http\Controllers\H5;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\CaptchaHandle;
use App;
use Illuminate\Support\Facades\Log;

class SignController extends ApiController
{
    private $bHash;

    public function __construct()
    {
        $this->bHash = App::make('hash');
    }

    public function signIn(UserRequest $request)
    {
        $params = $request->all();
        $name = $params['name'];
        $password = $params['password'];
        $captcha = strtolower($params['code']);

        if ($captcha !== CaptchaHandle::getCaptchaCode())
            return $this->error('验证码错误');

        $user = User::where('name', $name)->first();
        if (!$user)
            return $this->error('用户不存在');

        if (!$this->bHash->check($password, $user['password']))
            return $this->error('密码错误');

        session()->put($this->getName(), $user['id']);

        unset($user['password']);
        return $this->success($user);
    }

    public function signUp(UserRequest $request)
    {

    }

    public function captcha()
    {
        $content = CaptchaHandle::generateCaptcha();
        return Response()->make($content)->header('Content-Type', 'image/png');
    }

    private function getName() {
        return 'login_h5';
    }
}