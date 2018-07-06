<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'book';

//    public $timestamps = false;
    const CREATED_AT = 'c_time';
    const UPDATED_AT = 'u_time';

    const STATUS_RENTALED = 1;
    const STATUS_RENTALING = 0;

    protected $fillable = [
        'name', 'desc', 'author', 'c_id'
    ];

    // 书籍分类
    public function cate() {
        return $this->belongsTo('App\Models\BookCate', 'c_id');
    }

    // 书籍拥有者
    public function user() {
        return $this->belongsTo('App\Models\User', 'u_id');
    }

    // 书籍分享点
    public function share() {
        return $this->belongsTo('App\Models\Share', 's_id');
    }
}
