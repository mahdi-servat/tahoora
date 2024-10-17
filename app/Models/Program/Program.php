<?php

namespace App\Models\Program;

use App\Models\Language\Language;
use App\Models\Status;
use App\Scopes\LocalizationScope;
use App\Scopes\StatusScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'language_id',
        'status_id',
        'title',
        'description',
        'thump',
        'url',
        'sort',
    ];

    public function language(): HasOne
    {
        return $this->hasOne(Language::class, 'id', 'language_id');
    }

    public function status(): HasOne
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    protected static function booted()
    {
        static::addGlobalScope(new LocalizationScope);
        static::addGlobalScope(new StatusScope);
    }
}
