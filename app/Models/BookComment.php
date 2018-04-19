<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookComment extends Model
{
    protected $table = 'book_comment';

    public $timestamps = false;

    protected $fillable = [
        'content', 'u_id', 'p_id', 'b_id', 'hot',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User', 'u_id');
    }

    public function book() {
        return $this->belongsTo('App\Models\Book', 'b_id');
    }
}
