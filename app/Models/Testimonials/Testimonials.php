<?php

namespace App\Models\Testimonials;

use App\Models\Attachment\Attachment;
use App\Models\Museum\Museum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Testimonials extends Model
{
    use HasFactory;
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
