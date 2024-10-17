<?php

namespace App\Models\Museum;

use App\Entities\Testimonials;
use App\Models\Artist\MuseumArtist;
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
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

class Museum extends Model
{
    use HasFactory, Localization, StatusAble, Taggable, CategoryAble, AttachmentAble, Comments;

    protected $fillable = [
        'language_id',
        'status_id',
        'user_id',
        'title',
        'summary',
        'content',
        'thump',
        'price',
    ];

    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonials::class, 'museum_id');
    }

    public function randomTestimonials($serviceID)
    {
        return Testimonials::where('museum_id', $serviceID)->inRandomOrder()->first();
    }

    public function getIconAttribute()
    {
        if (!empty($this->attachments->where('attachment_type_id', 5)[0]))
            return $this->attachments()->where('attachment_type_id', 5)->orderBy('attachments.created_at', 'desc')->pluck('path')->first();
        return null;
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function artists()
    {
        return $this->hasMany(MuseumArtist::class, 'museum_id', 'id');
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
