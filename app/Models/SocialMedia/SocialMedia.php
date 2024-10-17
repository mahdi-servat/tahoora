<?php

namespace App\Models\SocialMedia;

use App\Models\Artist\Artist;
use App\Models\Language\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class SocialMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'icon',
        'key',
        'default',
    ];

    public function languages(): MorphToMany
    {
        return $this->morphedByMany(Language::class , 'model' , 'model_social_media')->withPivot('value');
    }

    public function artists(): MorphToMany
    {
        return $this->morphedByMany(Artist::class , 'model' , 'model_social_media')->withPivot('value');
    }

    public function languageKey(string $key)
    {
        return $this->languages()->where('key' , $key)->first();
    }

    public function artistId($id)
    {
        return $this->artists()->find($id);
    }
}
