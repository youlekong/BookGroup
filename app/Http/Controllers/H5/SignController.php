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

        $this->userSession($user['id']);

        unset($user['password']);
        return $this->success($user);
    }

    public function signUp(UserRequest $request)
    {
        $params = $request->all();

        $captcha = strtolower($params['code']);
        if ($captcha !== CaptchaHandle::getCaptchaCode())
            return $this->error('验证码错误');

        if ( User::where('name', $params['name'])->first() ) {
            return $this->error('用户已经存在');
        }

        if ( $params['rePassword'] !== $params['password'] ) {
            return $this->error('两次密码不一样');
        }

        $user = ['name' => $params['name'], 'password' => $params['password']];
        $user['password'] = $this->bHash->make($user['password']);
        if ( !User::create($user) ) {
            return $this->error('注册失败');
        }

        $user = User::where('name', $params['name'])->first();
        $this->userSession($user['id']);

        return $this->success($user);
    }

    public function captcha()
    {
        $content = CaptchaHandle::generateCaptcha();
        return Response()->make($content)->header('Content-Type', 'image/png');
    }

    private function getName() {
        return 'login_h5';
    }

    private function userSession($uid) {
        session()->put($this->getName(), $uid);
    }
}