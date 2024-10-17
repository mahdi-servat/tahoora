<?php

namespace App\Models\Page;

use App\Models\Language\Language;
use App\Models\MetaTag\MetaTag;
use App\Models\MetaTag\ModelMetaTag;
use App\Models\Status;
use App\Scopes\LocalizationScope;
use App\Scopes\StatusScope;
use App\Traits\Localization;
use App\Traits\StatusAble;
use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Page extends Model
{
    use HasFactory , Localization , StatusAble , Taggable;

    protected $fillable = [
        'title',
        'url',
        'description',
        'content',
        'thump',
        'language_id',
        'status_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new LocalizationScope);
        static::addGlobalScope(new StatusScope);
    }
}
