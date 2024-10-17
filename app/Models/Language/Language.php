<?php

namespace App\Models\Language;

use App\Models\PageSetting\PageSetting;
use App\Models\PageSetting\PageSettingData;
use App\Models\SocialMedia\LanguageSocialMedia;
use App\Models\SocialMedia\SocialMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'title',
        'active',
        'rtl',
        'default',
    ];

    public function socialMedia(): MorphToMany
    {
        return $this->morphToMany(SocialMedia::class , 'model' , 'model_social_media')->withPivot('value');
    }

    public function pageSettingData(): HasMany
    {
        return  $this->hasMany(PageSettingData::class , 'language_id' , 'id');
    }
    public function pageSetting(): BelongsToMany
    {
        return  $this->belongsToMany(PageSetting::class , 'page_setting_data' , 'language_id' , 'page_setting_id')->withPivot('content');
    }
}
