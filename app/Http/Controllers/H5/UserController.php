<?php

namespace App\Http\Controllers\H5;

use App\Models\Share;
use App\Models\User;
use App\Models\Book;
use App\Models\Rental;
use App\Http\Requests\UserRequest;

class UserController extends ApiController
{
    public function userBookInfo(UserRequest $request)
    {
        $params = $request->all();
        $u_id = $params['uid'];

        if (!$u_id) {
            return $this->error('uid不存在');
        }

        $books = Book::where('u_id', $u_id)->get();
        $rental = Rental::where('u_id', $u_id)->get();
        $data = array('book' => $books, 'rental' => $rental);

        return $this->success($data);
    }
}