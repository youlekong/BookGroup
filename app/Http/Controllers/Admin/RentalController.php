<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rental;
use App\Http\Requests\RentalRequest;
use App\Models\User;
use App\Models\Book;

class RentalController extends ApiController
{
    public function index()
    {
        $params = request()->input();

        $model = Rental::with(['user', 'fromUser', 'book']);
        // filter
//        if (!empty($params['keyword'])) {
//            $kw = $params['keyword'];
//            $model = $model->where('id', 'like', "%{$kw}%");
//        }
        if ( !empty($params['id']) ) {
            $model = $model->where('id', $params['id']);
        }
        if ( !empty($params['name']) ) {
            $model = $model->where('name', $params['name']);
        }
        if ( !empty($params['mark']) ) {
            $desc = $params['mark'];
            $model = $model->where('mark', 'like', "%{$desc}%");
        }
        if ( !empty($params['u_name']) ) {
            $ids = User::where('name', $params['u_name'])->select('id');
            $model = $model->whereIn('u_id', $ids);
        }
        if ( !empty($params['from_name']) ) {
            $ids = User::where('name', $params['from_name'])->select('id');
            $model = $model->whereIn('from_id', $ids);
        }
        if ( !empty($params['b_name']) ) {
            $ids = Book::where('name', $params['b_name'])->select('id');
            $model = $model->whereIn('b_id', $ids);
        }

        $data = $model->select()->paginate($this->pageNum);
        return $this->success($data);
    }

    public function create(RentalRequest $request)
    {
        $params = $request->all();

        $result = Rental::create($params);
        if (!$result ) {
            return $this->error('新增失败');
        }

        return $this->success('新建成功');
    }

    public function update(RentalRequest $request, Rental $book)
    {
        $params = $request->all();
        $id = $params['id'];
        unset($params['id']);

        $result = $book->where(['id' => $id])->update($params);
        if (!$result ) {
            return $this->error('更新失败');
        }

        return $this->success('更新成功');
    }

    public function delete(RentalRequest $request)
    {
        $id = $request->input('id');

        $result = Rental::destroy($id);
        if ( !$result ) {
            return $this->error('删除失败');
        }

        return $this->success('删除成功');
    }
}