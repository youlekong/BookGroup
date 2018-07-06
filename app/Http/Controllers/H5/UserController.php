<?php

namespace App\Http\Controllers\H5;

use App\Models\Group;
use App\Models\Book;
use App\Models\Rental;
use App\Http\Requests\UserRequest;
use App\Models\UserGroup;

class UserController extends ApiController
{
    public function userBookInfo(UserRequest $request)
    {
        $params = $request->all();
        $u_id = $params['uid'];

        if ( !$request->has(['uid']) )
            return $this->error('uid不存在');

        // 我分享的书
        $books = Book::where(['u_id'=> $u_id, 'status' => Book::STATUS_RENTALING])->get();
        // 我借的书
        $rental = Rental::where('u_id', $u_id)->get();
        // 我借出的书
        $f_rental = Rental::where('from_id', $u_id)->get();
        // 我发起的圈子
        $sponsorGroup = Group::where('u_id', $u_id)->get();
        // 我参加的圈子
        $joinGroup = UserGroup::where('u_id', $u_id)->get();

        $data = array('book' => $books, 'rental' => $rental,
            'fRental' => $f_rental, 'sponsorGroup' => $sponsorGroup, 'joinGroup' => $joinGroup);
        return $this->success($data);
    }


}