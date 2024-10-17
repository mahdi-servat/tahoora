<?php

namespace App\Models\Media;

use App\Models\Attachment\Attachment;
use App\Models\Attachment\ModelAttachment;
use App\Models\Language\Language;
use App\Models\MetaTag\MetaTag;
use App\Models\MetaTag\ModelMetaTag;
use App\Models\Status;
use App\Scopes\LocalizationScope;
use App\Scopes\StatusScope;
use App\Traits\AttachmentAble;
use App\Traits\Commentable;
use App\Traits\Localization;
use App\Traits\StatusAble;
use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Media extends Model
{
    use HasFactory , Commentable , Localization , StatusAble , Taggable , AttachmentAble;

    protected $fillable = [
        'title',
        'title2',
        'description',
        'language_id',
        'status_id',
        'thump',
        'date',
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
