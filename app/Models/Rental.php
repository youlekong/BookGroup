<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $table = 'rental';

    public $timestamps = false;

    protected $fillable = [
        'from_id', 'u_id', 'mark', 'b_id', 'start_time', 'end_time'
    ];

    public function fromUser() {
        return $this->belongsTo('App\Models\User', 'from_id');
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'u_id');
    }

    public function book() {
        return $this->belongsTo('App\Models\Book', 'b_id');
    }
}