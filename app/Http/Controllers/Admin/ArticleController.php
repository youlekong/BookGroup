<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\User;

class ArticleController extends ApiController
{

    public function index()
    {
        $params = request()->input();

        $model = Article::with(['user', 'activity', 'book']);
        // filter
//        if (!empty($params['keyword'])) {
//            $kw = $params['keyword'];
//            $model = $model->where('id', 'like', "%{$kw}%")
//                ->orWhere('title', 'like', "%{$kw}%");
//        }
        if ( !empty($params['id']) ) {
            $model = $model->where('id', $params['id']);
        }

        if ( !empty($params['title']) ) {
            $model = $model->where('title', $params['title']);
        }

        if ( !empty($params['desc']) ) {
            $desc = $params['desc'];
            $model = $model->where('desc', 'like', "%{$desc}");
        }

        if ( !empty($params['u_name']) ) {
            $u_ids = User::where('name', $params['u_name'])->select('id');
            $model = $model->whereIn('u_id', $u_ids);
        }

        $data = $model->select()->paginate($this->pageNum);
        return $this->success($data);
    }

    public function create(ArticleRequest $request)
    {
        $params = $request->all();

        $uName = $params['u_name'];
        unset($params['u_name']);
        $user = $this->getUser($uName);
        if ( !$user ) {
            return $this->error('用户名不存在');
        }

        $params['u_id'] = $user['id'];
        $result = Article::create($params);
        if (!$result ) {
            return $this->error('新增失败');
        }

        return $this->success('新建成功');
    }

    public function update(ArticleRequest $request, Article $model)
    {
        $params = $request->all();
        $id = $params['id'];
        unset($params['id']);

        $uName = $params['u_name'];
        unset($params['u_name']);
        $user = $this->getUser($uName);
        if ( !$user ) {
            return $this->error('用户名不存在');
        }

        $params['u_id'] = $user['id'];
        $result = $model->where(['id' => $id])->update($params);
        if (!$result ) {
            return $this->error('更新失败');
        }

        return $this->success('更新成功');
    }

    public function delete(ArticleRequest $request)
    {
        $id = $request->input('id');

        $result = Article::destroy($id);
        if ( !$result ) {
            return $this->error('删除失败');
        }

        return $this->success('删除成功');
    }

}
