<?php

namespace App\Models\Comment;

use Illuminate\Database\Eloquent\Model;

class CommentStatus extends Model
{
    public $timestamps = false;
    protected $table = 'comment_status';

    protected $fillable = [
        'title',
    ];

}
