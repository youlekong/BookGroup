<?php

namespace App\Http\Requests;

class ShareRequest extends Request
{

    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            {
                return [
                    'info' => 'required|max:100',
                    'loc' => 'required|max:100',
                    'name' => 'required|max:20'
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
            'max' => '最多'
        ];
    }

    public function attributes() {
        return [
            'info' => '分享描述',
            'loc' => '分享地址',
            'name' => '名称'
        ];
    }

}
