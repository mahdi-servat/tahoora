<?php

namespace App\Models\PageSetting;

use App\Models\Language\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;

class PageSetting extends Model
{
    use HasFactory;

    protected $table = 'page_settings';

    protected $fillable = [
      'title',
      'page_setting_type_id',
      'key',
      'default',
    ];

    public function type(): HasOne
    {
        return $this->hasOne(PageSettingType::class , 'id' , 'page_setting_type_id');
    }

    public function languageKey(string $key): Model|null
    {
        $language = Language::where('key' , $key)->first();

        return $this->data()->where('language_id' , $language->id)->first();
    }

    public function languageId(int $id): Model
    {
        return $this->data()->where('language_id' , $id)->first();
    }

    public function data(): HasMany
    {
        return $this->hasMany(PageSettingData::class , 'page_setting_id' , 'id');
    }

    public function scopeTitleFilter(Builder $query): void
    {
        $query->where('page_setting_type_id' , 1);
    }
    public function scopeAttachmentFilter(Builder $query): void
    {
        $query->where('page_setting_type_id' , 2);
    }
}
