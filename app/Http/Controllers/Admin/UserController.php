<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends ApiController
{

    public function index(User $user)
    {
        $params = request()->input();

        // filter
        if (!empty($params['keyword'])) {
            $kw = $params['keyword'];
            $user = $user->where('id', 'like', "%{$kw}%")
                ->orWhere('name', 'like', "%{$kw}%");
        }

        $userList = $user->select()->paginate($this->pageNum);
        return $this->success($userList);
    }

    public function create(UserRequest $request)
    {
        $params = $request->all();

        $result = User::create($params);
        if (!$result ) {
            return $this->error('新增失败');
        }

        return $this->success('新建成功');
    }

    public function update(UserRequest $request, User $user)
    {
        $params = $request->all();
        $id = $params['id'];
        unset($params['id']);

        $result = $user->where(['id' => $id])->update($params);
        if (!$result ) {
            return $this->error('更新失败');
        }

        return $this->success('更新成功');
    }

    public function delete(UserRequest $request)
    {
        $id = $request->input('id');

        $result = User::destroy($id);
        if ( !$result ) {
            return $this->error('删除失败');
        }

        return $this->success('删除成功');
    }
}
