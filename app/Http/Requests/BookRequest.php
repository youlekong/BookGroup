<?php

namespace App\Http\Requests;

class BookRequest extends Request
{

    public function rules()
    {
        switch($this->method())
        {
            // CREATE, UPDATE
            case 'POST':
            {
                return [
                    'name' => 'required|between:1,15',
                    'desc' => 'required|max:500',
                    'author' => 'required'
                ];
            }
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
            'name' => '书名',
            'desc' => '描述',
            'author' => '作者'
        ];
    }

}
