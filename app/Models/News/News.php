<?php

namespace App\Models\News;

use App\Models\User;
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
use Illuminate\Support\Facades\Auth;

class News extends Model
{
    use HasFactory, Localization, Taggable, AttachmentAble, CategoryAble, StatusAble, Comments;

    protected $fillable = [
        'title',
        'title2',
        'top_title',
        'status_id',
        'date',
        'thump',
        'description',
        'content',
        'language_id',
        'user_id',
        'views',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    protected static function booted()
    {
        static::creating(function ($news) {
            if (empty($news->user_id)) {
                $news->user_id = Auth::id();
            }
        });
        static::addGlobalScope(new LocalizationScope);
        static::addGlobalScope(new StatusScope);
    }

}
