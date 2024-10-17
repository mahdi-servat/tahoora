<?php

namespace App\Entities;

use App\Models\Attachment\Attachment;
use App\Models\Museum\Museum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Testimonials.
 *
 * @package namespace App\Entities;
 */
class Testimonials extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'thump_id',
        'museum_id',
    ];
    public function thump(): HasOne
    {
        return $this->hasOne(Attachment::class, 'id', 'thump_id');
    }
    public function museum(): HasOne
    {
        return $this->hasOne(Museum::class, 'id', 'museum_id');
    }
}
