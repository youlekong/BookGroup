<?php

namespace App\Http\Controllers\H5;

use App\Models\User;
use App\Models\Book;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\DB;

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
            $data = $model->get();
        } elseif ($type == 1) {    // 还书
            $uid = session()->get('login_h5');
//            $model = User::find($uid)->oweBooks()->with(['user']);
            $rental = DB::table('rental')
                ->join('book', 'book.id', '=', 'rental.b_id')
                ->where('rental.u_id', $uid)
                ->where('book.s_id', $params['sid'])
                ->select('book.*', 'rental.u_id')
                ->get();
            $rental = json_decode($rental, true);

            $data = array();
            foreach ($rental as $k => $r) {
                $r['user'] = User::where('id', $r['u_id'])->get();
                $data[$k] = $r;
            }
        }

        return $this->success($data);
    }
}