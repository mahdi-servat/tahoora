<?php

namespace App\Models\PageSetting;

use App\Models\Language\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PageSettingData extends Model
{
    use HasFactory;

    protected $table = 'page_setting_data';

    protected $fillable = [
        'page_setting_id' ,
        'language_id' ,
        'page_setting_type_id' ,
        'content' ,
    ];


    public function language(): HasOne
    {
        return $this->hasOne(Language::class , 'id' , 'language_id');
    }

    public function type(): HasOne
    {
        return $this->hasOne(PageSettingType::class , 'id' , 'page_setting_type_id');
    }

    public function pageSetting(): HasOne
    {
        return $this->hasOne(PageSetting::class , 'id' , 'page_setting_id');
    }
}
