<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Support\Facades\Log;

class BookController extends ApiController
{

    public function index()
    {
        $params = request()->input();

        $book = Book::with('cate');
        // filter
        if (!empty($params['keyword'])) {
            $kw = $params['keyword'];
            $book = $book->where('id', 'like', "%{$kw}%")
                ->orWhere('name', 'like', "%{$kw}%")
                ->orWhere('author', 'like', "%{$kw}%");
        }

//        if (!empty($params['c_id'])) {
//            $book = $book->where('c_id', $params['c_id']);
//        }

        $data = $book->select()->paginate($this->pageNum);
        return $this->success($data);
    }

    public function create(BookRequest $request)
    {
        $params = $request->all();

        $result = Book::create($params);
        if (!$result ) {
            return $this->error('新增失败');
        }

        return $this->success('新建成功');
    }

    public function update(BookRequest $request, Book $book)
    {
        $params = $request->all();
        $id = $params['id'];
        unset($params['id']);

        $result = $book->where(['id' => $id])->update($params);
        Log::info($result);
        if (!$result ) {
            return $this->error('更新失败');
        }

        return $this->success('更新成功');
    }

    public function delete(BookRequest $request)
    {
        $id = $request->input('id');

        $result = Book::destroy($id);
        if ( !$result ) {
            return $this->error('删除失败');
        }

        return $this->success('删除成功');
    }
}
