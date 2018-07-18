<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class UserActivity extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'user_activity';

    public $timestamps = false;

    protected $fillable = [
        'u_id', 'a_id',
    ];

}