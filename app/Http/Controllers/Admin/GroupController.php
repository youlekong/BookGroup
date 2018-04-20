<?php

namespace App\Http\Controllers\Admin;

use App\Models\Group;
use App\Http\Requests\GroupRequest;
use App\Models\User;

class GroupController extends ApiController
{

    public function index()
    {
        $params = request()->all();

        $model = Group::with(['cate', 'user']);
        // filter
//        if (!empty($params['keyword'])) {
//            $kw = $params['keyword'];
//            $model = $model->where('id', 'like', "%{$kw}%")
//                ->orWhere('name', 'like', "%{$kw}%");
//        }

        if ( !empty($params['id']) ) {
            $model = $model->where('id', $params['id']);
        }

        if ( !empty($params['name']) ) {
            $model = $model->where('name', $params['name']);
        }

        if ( !empty($params['u_name']) ) {
            $u_ids = User::where('name', $params['u_name'])->select('id');
            $model = $model->whereIn('u_id', $u_ids);
        }

        $data = $model->select()->paginate($this->pageNum);
        return $this->success($data);
    }

    public function create(GroupRequest $request)
    {
        $params = $request->all();

        $result = Group::create($params);
        if (!$result ) {
            return $this->error('新增失败');
        }

        return $this->success('新建成功');
    }

    public function update(GroupRequest $request, Group $model)
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

    public function delete(GroupRequest $request)
    {
        $id = $request->input('id');

        $result = Group::destroy($id);
        if ( !$result ) {
            return $this->error('删除失败');
        }

        return $this->success('删除成功');
    }
}