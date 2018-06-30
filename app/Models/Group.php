<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'bookGroup';

    const CREATED_AT = 'c_time';
    const UPDATED_AT = 'u_time';

    protected $fillable = [
        'name', 'desc', 'c_id', 'u_id', 'icon'
    ];

    public function cate() {
        return $this->belongsTo('App\Models\GroupCate', 'c_id');
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'u_id');
    }
}