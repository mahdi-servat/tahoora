<?php

namespace App\Models\Attachment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachmentType extends Model
{
    use HasFactory;

    public $timestamps=false;

    protected $fillable = [
        'title',
        'path_url',
    ];
}
