<?php

namespace App\Http\Controllers\H5;

use App\Models\User;
use App\Models\Book;
use App\Http\Requests\BookRequest;

class BookController extends ApiController
{
//    const bookTypes = [
//        1 => 'borrowBooks',
//        2 => 'returnBooks'
//    ];

    public function getBooks(BookRequest $request)
    {
        $params = $request->all();

        $type = $params['type'];
        if ($type == 0) {      // 借书
            $model = Book::with(['user']);
            $model->where('s_id', $params['sid']);
        } elseif ($type == 1) {    // 还书
            $uid = session()->get('login_h5');
            $model = User::find($uid)->oweBooks()->with(['user']);
        }

        $data = $model->get();
        return $this->success($data);
    }
}