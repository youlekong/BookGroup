<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookCateRequest;
use App\Models\BookCate;

class BookCateController extends ApiController
{

    public function index(BookCate $bookCate)
    {
        $data = $bookCate->select(['id', 'name', 'c_time'])->paginate($this->pageNum);
        return $this->success($data);
    }

    public function allCates(BookCate $bookCate)
    {
        $data = $bookCate->select(['id', 'name'])->get();
        return $this->success($data);
    }

    public function create(BookCateRequest $request)
    {
        $params = $request->all();

        $result = BookCate::create($params);
        if (!$result ) {
            return $this->error('新增失败');
        }

        return $this->success('新建成功');
    }

    public function update(BookCateRequest $request, BookCate $bookCate)
    {
        $params = $request->all();
        $id = $params['id'];
        unset($params['id']);

        $result = $bookCate->where(['id' => $id])->update($params);
        if (!$result ) {
            return $this->error('更新失败');
        }

        return $this->success('更新成功');
    }

    public function delete(BookCateRequest $request)
    {
        $id = $request->input('id');

        $result = BookCate::destroy($id);
        if ( !$result ) {
            return $this->error('删除失败');
        }

        return $this->success('删除成功');
    }
}
