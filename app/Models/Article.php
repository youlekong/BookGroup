<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';

//    public $timestamps = false;
    const CREATED_AT = 'c_time';
    const UPDATED_AT = 'u_time';

    protected $fillable = [
        'title', 'desc', 'b_id', 'u_id', 'a_id', 'g_id'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User', 'u_id');
    }

    public function activity() {
        return $this->belongsTo('App\Models\Activity', 'a_id');
    }

    public function book() {
        return $this->belongsTo('App\Models\Book', 'b_id');
    }
}
