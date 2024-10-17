<?php

namespace App\Models\PageSetting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSettingType extends Model
{
    use HasFactory;

    protected $table = 'page_setting_type';

    protected $fillable = [
        'title'
    ];
}
