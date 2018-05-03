<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ShareRequest;
use App\Models\Share;

class ShareController extends ApiController
{
    public function index()
    {
        $params = request()->input();

        $model = new Share();//Share::with(['user', 'fromUser', 'book']);
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
        if ( !empty($params['loc']) ) {
            $desc = $params['loc'];
            $model = $model->where('loc', 'like', "%{$desc}%");
        }

        $data = $model->select()->paginate($this->pageNum);
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