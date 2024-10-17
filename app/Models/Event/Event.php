<?php

namespace App\Models\Event;

use App\Models\Language\Language;
use App\Models\MetaTag\MetaTag;
use App\Models\MetaTag\ModelMetaTag;
use App\Models\Status;
use App\Scopes\LocalizationScope;
use App\Scopes\StatusScope;
use App\Traits\Commentable;
use App\Traits\Localization;
use App\Traits\StatusAble;
use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    use HasFactory , SoftDeletes , Commentable , Localization , Taggable , StatusAble;

    protected $fillable =[
        'language_id',
        'status_id',
        'title',
        'second_title',
        'thump',
        'start_date',
        'end_date',
        'price',
        'url_path',
        'live_url_path',
        'contacts',
        'location_text',
        'summary',
        'content',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new LocalizationScope);
        static::addGlobalScope(new StatusScope);
    }
}
