<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'book';

//    public $timestamps = false;
    const CREATED_AT = 'c_time';
    const UPDATED_AT = 'u_time';

    protected $fillable = [
        'name', 'desc', 'author', 'c_id'
    ];

    public function cate() {
        return $this->belongsTo('App\Models\BookCate', 'c_id');
    }
}
