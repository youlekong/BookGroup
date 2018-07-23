<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use Notifiable;

    protected $table = 'user';

    public $timestamps = false;

    protected $fillable = [
        'name', 'password',
    ];

    // protected $dispatchesEvents = [
        // created => UserCreated::class,
    // ];

//    public function oweBooks() {
//        return $this->belongsToMany('App\Models\Book', 'user_book', 'u_id', 'b_id');
//    }

    public function info() {
        return $this->hasOne('App\Models\UserInfo', 'u_id', 'id');//->withPivot('integral');
    }

}
