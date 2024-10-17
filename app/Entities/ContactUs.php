<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ContactUs.
 *
 * @package namespace App\Entities;
 */
class ContactUs extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='contact_uses';
    protected $fillable = [
        'category',
        'description',
        'name',
        'email',
        'phone',
        'user_id',
    ];

}
