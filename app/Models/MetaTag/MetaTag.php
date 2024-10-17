<?php

namespace App\Models\MetaTag;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title2',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

}
