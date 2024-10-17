<?php

namespace App\Models\Article;

use App\Models\Category\ModelCategory;
use App\Models\Language\Language;
use App\Models\MetaTag\MetaTag;
use App\Models\MetaTag\ModelMetaTag;
use App\Models\Status;
use App\Models\User;
use App\Scopes\LocalizationScope;
use App\Scopes\StatusScope;
use App\Traits\CategoryAble;
use App\Traits\Commentable;
use App\Traits\Localization;
use App\Traits\StatusAble;
use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    use HasFactory , Commentable , Taggable , CategoryAble , StatusAble , Localization;

    protected $fillable =[
        'language_id',
        'title',
        'title2',
        'second_title',
        'second_title2',
        'thump',
        'author',
        'summary',
        'content',
        'status_id',
        'user_id',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    protected static function booted()
    {
        static::creating(function ($data) {
            if (empty($data->user_id)) {
                $data->user_id = Auth::id();
            }
        });
        static::addGlobalScope(new LocalizationScope);
        static::addGlobalScope(new StatusScope);
    }
}
