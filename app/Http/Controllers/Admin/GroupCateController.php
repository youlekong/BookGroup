<?php

namespace App\Http\Controllers\Admin;

use App\Models\GroupCate;
use App\Http\Requests\GroupCateRequest;

class GroupCateController extends ApiController
{
    public function index(GroupCate $model)
    {
        $data = $model->select()->paginate($this->pageNum);
        return $this->success($data);
    }

    public function allCates(GroupCate $model)
    {
        $data = $model->select(['id', 'name'])->get();
        return $this->success($data);
    }

    public function create(GroupCateRequest $request)
    {
        $params = $request->all();

        $result = GroupCate::create($params);
        if (!$result ) {
            return $this->error('新增失败');
        }

        return $this->success('新建成功');
    }

    public function update(GroupCateRequest $request, GroupCate $model)
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

    public function delete(GroupCateRequest $request)
    {
        $id = $request->input('id');

        $result = GroupCate::destroy($id);
        if ( !$result ) {
            return $this->error('删除失败');
        }

        return $this->success('删除成功');
    }
}