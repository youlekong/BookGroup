<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class ApiController extends Controller
{
    public $pageNum = 10;

    public function success($data) {
        $result = $this->resJson($data, 1);
        return response()->json($result);
    }

    public function error($data) {
        $result = $this->resJson($data, 2);
        return response()->json($result);
    }

    public function resJson($data, $code) {
        $result = [
            'msg' => $data,
            'code' => $code
        ];
        return $result;
    }

    public function getUser($name)
    {
        $model = User::where('name', $name)->select('id')->first();
        return $model ? $model->toArray() : null;
    }
}
