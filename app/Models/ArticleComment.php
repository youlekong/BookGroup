<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleComment extends Model
{
    protected $table = 'article_comment';

    public $timestamps = false;

    protected $fillable = [
        'content', 'u_id', 'p_id', 'a_id', 'hot',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User', 'u_id');
    }

    public function article() {
        return $this->belongsTo('App\Models\Article', 'a_id');
    }
}
