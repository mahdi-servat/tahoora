<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Slider.
 *
 * @package namespace App\Entities;
 */
class Slider extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'user_id',
        'language_id',
        'status_id',
        'slider_type_id',
        'title',
        'description',
    ];

}
