<?php

namespace App\Models\Footer;

use App\Models\Language\Language;
use App\Models\Status;
use App\Scopes\LocalizationScope;
use App\Scopes\StatusScope;
use App\Traits\Localization;
use App\Traits\StatusAble;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Footer extends Model
{
    use HasFactory , Localization , StatusAble;

    protected $fillable = [
        'language_id',
        'title',
        'parent_id',
        'url',
        'sort',
        'status_id',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function parent(): HasOne
    {
        return $this->hasOne(Footer::class , 'id' , 'parent_id');
    }
    public function children(): HasMany
    {
        return $this->hasMany(Footer::class , 'parent_id' , 'id');
    }

    protected static function booted()
    {
        static::addGlobalScope(new LocalizationScope);
        static::addGlobalScope(new StatusScope);
    }
}
