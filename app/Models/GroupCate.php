<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupCate extends Model
{
    protected $table = 'bookGroup_cate';

    public $timestamps = false;

    protected $fillable = [
        'name', 'icon'
    ];
}