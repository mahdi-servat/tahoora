<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Reserve extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'user_id',
        'artist_id',
        'museum_id',
        'price',
        'date',
    ];

}
