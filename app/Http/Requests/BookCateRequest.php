<?php

namespace App\Http\Requests;

class BookCateRequest extends Request
{

    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            {
                return [
                    'name' => 'required|between:1,15',
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
            'name' => '类别名',
        ];
    }

}
