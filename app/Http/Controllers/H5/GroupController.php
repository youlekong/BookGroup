<?php

namespace App\Http\Controllers\H5;

use App\Models\Group;
use App\Models\GroupCate;
use App\Models\UserGroup;
use App\Http\Requests\GroupRequest;

class GroupController extends ApiController
{
    public function getGroups(GroupRequest $request)
    {
        $params = $request->all();
        $type = $params['type'];

        if ( $type == 0) {
            $uid = session()->get('login_h5');
            $model = Group::with(['user', 'cate'])->where('u_id', $uid);
        } elseif ( $type == 1 ) {
            $model = Group::with(['user', 'cate'])->where('hot', '<>', 0);
        }

        $data = $model->get();
        return $this->success($data);
    }

    public function getGroupsByCateId(GroupRequest $request)
    {
        $params = $request->all();

        if ( !$request->has('c_id') )
            return $this->error('c_id不存在');

        $c_id = $params['c_id'];
        $data = Group::with(['user', 'cate'])->where('c_id', $c_id)->get();
        return $this->success($data);
    }

    public function getGroupCategories()
    {
        $data = GroupCate::all();
        return $this->success($data);
    }

    public function getGroupActivities()
    {

    }

    public function joinGroup(GroupRequest $request)
    {
        $params = $request->all();

        if ( !$request->has(['u_id', 'g_id']) )
            return $this->error('u_id或g_id不存在');

        $condition = array('u_id' => $params['u_id'], 'g_id' => $params['g_id']);
        if ( UserGroup::where($condition)->first() )
            return $this->error('你已经加入书圈，无需重复加入');

        $result = UserGroup::create($params);
        if (!$result)
            return $this->error('加入书圈失败');

        return $this->success('加入书圈成功');
    }

    public function checkUserGroup(GroupRequest $request)
    {
        $params = $request->all();

        if ( !$request->has(['u_id', 'g_id']) )
            return $this->error('u_id或g_id不存在');

        $condition = array('u_id' => $params['u_id'], 'g_id' => $params['g_id']);
        if ( !UserGroup::where($condition)->first() )
            return $this->error(true);

        return $this->success(true);
    }

}