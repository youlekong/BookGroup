<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleCommentRequest;
use App\Models\Article;
use App\Models\ArticleComment;

use App\Models\User;

class ArticleCommentController extends ApiController
{

    public function index()
    {
        $params = request()->input();

        $model = ArticleComment::with(['user', 'article']);
        // filter
//        if (!empty($params['keyword'])) {
//            $kw = $params['keyword'];
//            $model = $model->where('id', 'like', "%{$kw}%")
//                ->orWhere('a_name', 'like', "%{$kw}%");
//        }
        if ( !empty($params['id']) ) {
            $model->where('id', $params['id']);
        }

        if ( !empty($params['content']) ) {
            $kw = $params['keyword'];
            $model = $model->where('content', 'like', "%{$kw}%");
        }

        if ( !empty($params['u_name']) ) {
            $u_ids = User::where('name', $params['u_name'])->select('id');
            $model = $model->whereIn('u_id', $u_ids);
        }

        if ( !empty($params['a_title']) ) {
            $ids = Article::where('name', $params['a_title'])->select('id');
            $model = $model->whereIn('a_id', $ids);
        }

        $data = $model->select()->paginate($this->pageNum);
        return $this->success($data);
    }

    public function create(ArticleCommentRequest $request)
    {
        $params = $request->all();

        $result = ArticleComment::create($params);
        if (!$result ) {
            return $this->error('新增失败');
        }

        return $this->success('新建成功');
    }

    public function update(ArticleCommentRequest $request, ArticleComment $model)
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

    public function delete(ArticleCommentRequest $request)
    {
        $id = $request->input('id');

        $result = ArticleComment::destroy($id);
        if ( !$result ) {
            return $this->error('删除失败');
        }

        return $this->success('删除成功');
    }
}
