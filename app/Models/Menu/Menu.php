<?php

namespace App\Models\Menu;

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
use Illuminate\Support\Facades\Auth;

class Menu extends Model
{
    use HasFactory , Localization , StatusAble;

    protected $fillable = [
        'title',
        'url',
        'parents_id',
        'language_id',
        'user_id',
        'parent_id',
        'status_id',
        'sort',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function parent(): HasOne
    {
        return $this->hasOne(Menu::class, 'id', 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id')->orderBy('sort');
    }


    protected static function booted()
    {
        static::addGlobalScope(new LocalizationScope);
        static::addGlobalScope(new StatusScope);
    }
}
