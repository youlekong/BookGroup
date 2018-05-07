<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'user';

    public $timestamps = false;

    protected $fillable = [
        'name', 'password',
    ];

    public function oweBooks() {
        return $this->belongsToMany('App\Models\Book', 'user_book', 'u_id', 'b_id');
    }

}
