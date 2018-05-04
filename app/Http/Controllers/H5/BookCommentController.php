<?php

namespace App\Http\Controllers\H5;

use App\Models\BookComment;
use App\Http\Requests\BookCommentRequest;

class BookCommentController extends ApiController
{
    public function getComments(BookCommentRequest $request)
    {
        $params = $request->all();

        $data = BookComment::with(['user'])
            ->where('b_id', $params['bid'])
            ->where('p_id', 0)
            ->get();
        return $this->success($data);
    }
}