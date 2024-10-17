<?php

namespace App\Models\Artist;

use App\Models\SocialMedia\ModelSocialMedia;
use App\Models\SocialMedia\SocialMedia;
use App\Scopes\LocalizationScope;
use App\Scopes\StatusScope;
use App\Traits\AttachmentAble;
use App\Traits\CategoryAble;
use App\Traits\Comments;
use App\Traits\Localization;
use App\Traits\StatusAble;
use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Artist extends Model
{
    use HasFactory, Localization, StatusAble, Taggable, CategoryAble, AttachmentAble, Comments;

    protected $fillable = [
        'language_id',
        'title',
        'thump',
        'summary',
        'content',
        'status_id',
    ];

    public function socialMedia(): MorphToMany
    {
        return $this->morphToMany(SocialMedia::class, 'model', 'model_social_media')->withPivot('value');
    }

    public function modelSocialMedia(): MorphMany
    {
        return $this->morphMany(ModelSocialMedia::class, 'model');
    }

    public function museums()
    {
        return $this->hasMany(MuseumArtist::class, 'artist_id', 'id');
    }

    protected static function booted()
    {
        static::addGlobalScope(new LocalizationScope);
        static::addGlobalScope(new StatusScope);
    }
}
