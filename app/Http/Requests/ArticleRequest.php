<?php

namespace App\Http\Requests;

class ArticleRequest extends Request
{

    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            {
                return [
                    'title' => 'required|between:1,15',
                    'desc' => 'required',
                ];
            }
            // UPDATE
            case 'PUT':
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            }
        }
    }

    public function messages()
    {
        return [
            'required' => ':attribute不能为空。',
        ];
    }

    public function attributes() {
        return [
            'title' => '文章标题',
            'desc' => '文章内容',
        ];
    }

}
