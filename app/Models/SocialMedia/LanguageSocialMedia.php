<?php

namespace App\Models\SocialMedia;

use App\Models\Language\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageSocialMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'social_media_id',
        'language_id',
        'url',
    ];

    public function language()
    {
        return $this->hasOne(Language::class , 'id' , 'language_id');
    }
    public function socialMedia()
    {
        return $this->hasOne(SocialMedia::class , 'id' , 'social_media_id');
    }


}
