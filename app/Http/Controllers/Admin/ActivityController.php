<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ActivityRequest;
use App\Models\Activity;

class ActivityController extends ApiController
{
    public function index()
    {
        $params = request()->all();

        $model = Activity::with(['user', 'group']);
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
        if ( !empty($params['desc']) ) {
            $desc = $params['desc'];
            $model = $model->where('desc', 'like', "%{$desc}%");
        }
        if ( !empty($params['start_time']) ) {
            $model = $model->where('start_time', '>=', $params['start_time']);
        }
        if ( !empty($params['end_time']) ) {
            $model = $model->where('end_time', '<=', $params['end_time']);
        }
        if ( !empty($params['u_name']) ) {
            $ids = User::where('name', $params['u_name'])->select('id');
            $model = $model->whereIn('u_id', $ids);
        }

        $data = $model->select()->paginate($this->pageNum);
        return $this->success($data);
    }

    public function create(ActivityRequest $request)
    {
        $params = $request->all();

        $uName = $params['u_name'];
        unset($params['u_name']);
        $user = $this->getUser($uName);
        if ( !$user ) 
            return $this->error('用户名不存在');

        $gName = $params['g_name'];
        unset($params['g_name']);
        $group = $this->getGroup($gName);
        if (!$group)
            return $this->error('书圈不存在');

        $params['u_id'] = $user['id'];
        $params['g_id'] = $group['id'];
        $result = Activity::create($params);
        if (!$result ) 
            return $this->error('新增失败');

        return $this->success('新建成功');
    }

    public function update(ActivityRequest $request, Activity $book)
    {
        $params = $request->all();
        $id = $params['id'];
        unset($params['id']);

        $uName = $params['u_name'];
        unset($params['u_name']);
        $user = $this->getUser($uName);
        if ( !$user ) 
            return $this->error('用户名不存在');
        
        $gName = $params['g_name'];
        unset($params['g_name']);
        $group = $this->getGroup($gName);
        if (!$group)
            return $this->error('书圈不存在');

        $params['u_id'] = $user['id'];
        $params['g_id'] = $group['id'];
        $result = $book->where(['id' => $id])->update($params);
        if (!$result ) {
            return $this->error('更新失败');
        }

        return $this->success('更新成功');
    }

    public function delete(ActivityRequest $request)
    {
        $id = $request->input('id');

        $result = Activity::destroy($id);
        if ( !$result ) {
            return $this->error('删除失败');
        }

        return $this->success('删除成功');
    }
}