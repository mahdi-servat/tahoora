<?php

namespace App\Traits;

use App\Models\Language\Language;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait Localization
{
    public function language(): HasOne
    {
        return $this->hasOne(Language::class , 'id' , 'language_id');
    }
}
