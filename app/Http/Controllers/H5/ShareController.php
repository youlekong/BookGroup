<?php

namespace App\Http\Controllers\H5;

use App\Http\Requests\ShareRequest;
use App\Models\Book;
use App\Models\Share;

class ShareController extends ApiController
{
    public function index()
    {
        $data = Share::withCount(['book' => function($query) {
            $query->where('status', Book::STATUS_RENTALING);
        }])->get();
        return $this->success($data);
    }

    public function create(ShareRequest $request)
    {
        $params = $request->all();

        $result = Share::create($params);
        if (!$result ) {
            return $this->error('新增失败');
        }

        return $this->success('新建成功');
    }

    public function update(ShareRequest $request, Share $book)
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

    public function delete(ShareRequest $request)
    {
        $id = $request->input('id');

        $result = Share::destroy($id);
        if ( !$result ) {
            return $this->error('删除失败');
        }

        return $this->success('删除成功');
    }
}