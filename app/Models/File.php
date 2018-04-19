<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'file';

    protected $fillable = [
        'id', 'type', 'path', 'mime_type',
        'md5', 'title', 'folder', 'object_id',
        'size', 'width', 'height', 'downloads',
        'public', 'editor', 'status', 'created_op'
    ];
}
