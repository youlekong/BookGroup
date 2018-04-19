<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookCommentRequest;
use App\Models\BookComment;

use App\Models\Book;
use App\Models\User;

class BookCommentController extends ApiController
{

    public function index()
    {
        $params = request()->all();

        $model = BookComment::with(['user', 'book']);
        // filter
//        if (!empty($params['keyword'])) {
//            $kw = $params['keyword'];
//            $model = $model->where('id', 'like', "%{$kw}%")
//                ->orWhere('content', 'like', "%{$kw}%");
//        }
        if ( !empty($params['id']) ) {
            $model->where('id', $params['id']);
        }

        if ( !empty($params['content']) ) {
            $kw = $params['keyword'];
            $model = $model->where('content', 'like', "%{$kw}%");
        }

        if ( !empty($params['u_name']) ) {
            $u_ids = User::where('name', $params['u_name'])->select('id');
            $model = $model->whereIn('u_id', $u_ids);
        }

        if ( !empty($params['b_name']) ) {
            $b_ids = Book::where('name', $params['b_name'])->select('id');
            $model = $model->whereIn('b_id', $b_ids);
        }

        $data = $model->select()->paginate($this->pageNum);
        return $this->success($data);
    }

    public function create(BookCommentRequest $request)
    {
        $params = $request->all();

        $result = BookComment::create($params);
        if (!$result ) {
            return $this->error('新增失败');
        }

        return $this->success('新建成功');
    }

    public function update(BookCommentRequest $request, BookComment $model)
    {
        $params = $request->all();
        $id = $params['id'];
        unset($params['id']);

        $result = $model->where(['id' => $id])->update($params);
        if (!$result ) {
            return $this->error('更新失败');
        }

        return $this->success('更新成功');
    }

    public function delete(BookCommentRequest $request)
    {
        $id = $request->input('id');

        $result = BookComment::destroy($id);
        if ( !$result ) {
            return $this->error('删除失败');
        }

        return $this->success('删除成功');
    }
}
