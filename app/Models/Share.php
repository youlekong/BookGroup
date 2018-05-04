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


    public function book() {
        return $this->hasMany('App\Models\Book', 's_id');
    }
}