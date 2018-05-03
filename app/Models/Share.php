<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    protected $table = 'share';

//    public $timestamps = false;
    const CREATED_AT = 'c_time';
    const UPDATED_AT = 'u_time';

    protected $fillable = [
        'lat', 'lng', 'info', 'b_id', 'loc', 'name'
    ];

//    public function fromUser() {
//        return $this->belongsTo('App\Models\User', 'from_id');
//    }
//
//    public function user() {
//        return $this->belongsTo('App\Models\User', 'u_id');
//    }
//
//    public function book() {
//        return $this->belongsTo('App\Models\Book', 'b_id');
//    }
}