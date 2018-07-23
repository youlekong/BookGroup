<?php

namespace App\Http\Controllers\H5;

use App\Models\Group;
use App\Models\Book;
use App\Models\Rental;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\Share;
use App\Http\Requests\UserRequest;
use App\Models\UserGroup;
use Illuminate\Support\Facades\DB;

class UserController extends ApiController
{

    public function userInfo(UserRequest $request) 
    {
        $params = $request->all();
        if ( !$request->has(['uid']) )
            return $this->error('uid不存在');

        $u_id = $params['uid'];
        $info = UserInfo::where('u_id', $u_id)->first();
        
        return $this->success($info);
    }

    public function userBookInfo(UserRequest $request)
    {
        $params = $request->all();
        if ( !$request->has(['uid']) )
            return $this->error('uid不存在');

        $a_rental = [];
        if ( $request->has(['sid']) ) {
            // 可借书籍
            $s_id = $params['sid'];
            $a_rental = Share::where('id', $s_id)->withCount(['book' => function($query) {
                $query->where('status', Book::STATUS_RENTALING);
            }])->get();
        }

        $u_id = $params['uid'];
        // 我分享的书
        $books = Book::where(['u_id'=> $u_id, 'status' => Book::STATUS_RENTALING])->get();
        // 我借的书
        $rental = Rental::where(['u_id' => $u_id, 'status' => Rental::RENTAL_RENTALED])->get();
        // 我借出的书
        $f_rental = Rental::where(['from_id' => $u_id, 'status' => Rental::RENTAL_RENTALED])->get();
        // 我发起的圈子
        $sponsorGroup = Group::where('u_id', $u_id)->get();
        // 我参加的圈子
        $joinGroup = UserGroup::where('u_id', $u_id)->get();

        $data = array('book' => $books, 'rental' => $rental, 'a_rental' => $a_rental,
            'fRental' => $f_rental, 'sponsorGroup' => $sponsorGroup, 'joinGroup' => $joinGroup);
        return $this->success($data);
    }

    public function recommends(UserRequest $request) 
    {

        $uid = $request->cookie('laravel_bg_h5');
        $books = $this->myRentalBooks($uid);
        $b_ids = array_column($books, 'b_id');

        $sql = 'select bc.b_id from book_group.book_comment as bc where b_id not in (' . implode(',', $b_ids) . ') group by b_id order by b_id desc limit 5;';
        $book = Db::select($sql);
        $sql = 'select bg.u_id from book_group.bookGroup as bg group by u_id order by u_id desc limit 5;';
        $user = Db::select($sql);
        $group = Db::select('select ug.g_id from book_group.user_group as ug where u_id <> ' . $uid  .  ' group by g_id order by g_id desc limit 5;');


        $bookData = array();
        foreach($book as $key => $val) {
            $bookData[$key] = Book::where('id', $val->b_id)->first();
        }

        $userData = array();
        foreach($user as $key => $val) {
            $userData[$key] = User::where('id', $val->u_id)->first();
        }

        $groupData = array();
        foreach($group as $key => $val) {
            $groupData[$key] = Group::where('id', $val->g_id)->first();
        }

        $data = array('book' => $bookData, 'user' => $userData, 'group' => $groupData);
        return $this->success($data);
    }

    private function myRentalBooks($uid) 
    {
        return Rental::where(['u_id'=> $uid, 'status' => Rental::RENTAL_RENTALED])->select('id', 'b_id')->get()->toArray();
    }


}