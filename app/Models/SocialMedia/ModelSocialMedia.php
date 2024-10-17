<?php

namespace App\Models\SocialMedia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ModelSocialMedia extends Model
{
    use HasFactory;

    protected $table = 'model_social_media';

    protected $fillable = [
        'social_media_id',
        'model_type',
        'model_id',
        'value',
    ];

    public function socialMedia(): HasOne
    {
        return $this->hasOne(SocialMedia::class , 'id' , 'social_media_id');
    }

    public function model(): MorphTo
    {
        return $this->morphTo('model');
    }
}
