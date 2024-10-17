<?php

namespace App\Models\Slider;

use App\Models\Language\Language;
use App\Models\User;
use App\Scopes\LocalizationScope;
use App\Scopes\StatusScope;
use App\Traits\Localization;
use App\Traits\StatusAble;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Slider extends Model
{
    use HasFactory, Localization, StatusAble;

    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = [
        'user_id',
        'language_id',
        'status_id',
        'slider_type_id',
        'title',
        'description',
    ];

    public function countOfSlider()
    {
        return $this->slides()->count();
    }

    public function language(): HasOne
    {
        return $this->hasOne(Language::class, 'id', 'language_id');
    }

    public function type(): HasOne
    {
        return $this->hasOne(SliderTypes::class, 'id', 'slider_type_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function slides(): HasMany
    {
        return $this->hasMany(SliderSlides::class, 'slider_id', 'id');
    }

    protected static function booted()
    {
        static::addGlobalScope(new LocalizationScope);
        static::addGlobalScope(new StatusScope);
    }

}
