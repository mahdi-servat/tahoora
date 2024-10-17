<?php

namespace App\Models\Comment;

use App\Models\Article\Article;
use App\Models\Event\Event;
use App\Models\Media\Media;
use App\Models\News\News;
use App\Traits\Localization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Comment extends Model
{
    use HasFactory, Localization;

    protected $fillable = [
        'language_id',
        'name',
        'phone',
        'title',
        'description',
        'status_id',
        'parent_id',
        'date',
        'model_type',
        'model_id',
        'user_id',
    ];


    public function status(): HasOne
    {
        return $this->hasOne(CommentStatus::class, 'id', 'status_id');
    }

    public function childs()
    {
        return $this->morphMany(Comment::class, 'model');

    }

    public function getClassName(): string
    {
        $model = $this->model_type;

        if ($model == News::class) {
            $name = 'اخبار';
        }
        elseif ($model == Event::class) {
            $name = 'رویداد';
        }
        elseif ($model == Media::class) {
            $name = 'رسانه';
        }
        elseif ($model == Article::class) {
            $name = 'مقالات';
        }

        return $name;
    }
}
