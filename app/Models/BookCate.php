<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookCate extends Model
{
    protected $table = 'book_cate';

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

//    public function books() {
//        return $this->hasMany('App\Models\Book');
//    }
}
