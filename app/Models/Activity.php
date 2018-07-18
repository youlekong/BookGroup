<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activity';

    public $timestamps = false;

    protected $fillable = [
        'name', 'desc', 'u_id', 'start_time', 'end_time'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User', 'u_id');
    }

    public function group() {
        return $this->belongsTo('App\Models\Group', 'g_id');
    }

}
