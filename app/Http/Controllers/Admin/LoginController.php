<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;

class LoginController extends ApiController
{
    public function login()
    {
        $params = request()->all();
        $name = $params['name'];
        $password = $params['password'];
        $remember = $params['remember'];

        if ( $rs = Auth::attempt(['name' => $name, 'password' => $password], $remember) ) {
            return $this->success('登录成功');
        }

        return $this->error('登录失败');
    }

    public function logout() {
        Auth::logout();
        return $this->success('登出成功');
    }
}