<?php
namespace App\Scopes;

use App\Models\Language\Language;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Http\Request;

class LocalizationScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        if (app(Request::class)->wantsJson()){
            $language = Language::where('key' ,app()->getLocale())->first();

            $builder->where('language_id', '=', $language->id);
        }
    }
}
