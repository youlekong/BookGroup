<?php

namespace App\Http\Controllers;


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
}
