<?php

namespace App\Http\Controllers\H5;

use App\Http\Controllers\Controller;
use App\Models\Book;

class ApiController extends Controller
{
    public $pageNum = 10;

    public function success($data, $cookie = null) {
        $result = $this->resJson($data, 1);
        if ($cookie)
            return response()->json($result)->withCookie($cookie);
        else
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
