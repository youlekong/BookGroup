<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\Controller;

class ArticleController extends Controller
{
    public function test() {
        $result = ['api'=> 'v1'];
        return $this->response->array($result)->setStatusCode(201);
    }
}