<?php

namespace App\Http\Requests;

class BookCommentRequest extends Request
{

    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            {
                return [
                    'content' => 'required|max:500',
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
            'content' => '评论内容',
        ];
    }

}
