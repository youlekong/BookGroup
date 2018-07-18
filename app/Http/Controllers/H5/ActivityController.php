<?php

namespace App\Http\Controllers\H5;

use App\Models\Activity;
use App\Models\UserActivity;
use App\Http\Requests\ActivityRequest;

class ActivityController extends ApiController
{

    public function joinActivity(ActivityRequest $request)
    {
        $params = $request->all();
        if ( !$request->has('a_id') ) 
            return $this->error('缺少a_id');

        if ( !$request->has('u_id') )
            return $this->error('缺少u_id');

        $condition = array('u_id' => $params['u_id'], 'a_id' => $params['a_id']);
        if ( UserActivity::where($condition)->first() )
            return $this->error('你已经加入活动，无需重复加入');

        $result = UserActivity::create($params);
        if (!$result)
            return $this->error('加入活动失败');

        return $this->success('加入活动成功');
    }

    public function checkUserActivity(ActivityRequest $request)
    {
        $params = $request->all();

        if ( !$request->has(['u_id', 'a_id']) )
            return $this->error('u_id或a_id不存在');

        $condition = array('u_id' => $params['u_id'], 'a_id' => $params['a_id']);
        if ( !UserActivity::where($condition)->first() )
            return $this->error(true);

        return $this->success(true);
    }

}