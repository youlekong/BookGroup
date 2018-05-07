<?php

namespace App\Http\Controllers\H5;

use App\Models\Group;
use App\Models\GroupCate;
use App\Http\Requests\GroupRequest;

class GroupController extends ApiController
{
    public function getGroups(GroupRequest $request)
    {
        $params = $request->all();
        $type = $params['type'];

        if ( $type == 0) {
            $uid = session()->get('login_h5');
            $model = Group::where('u_id', $uid);
        } elseif ( $type == 1 ) {
            $model = Group::where('hot', '<>', 0);
        }

        $data = $model->get();
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
}