<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Language;

use App\Models\PageSetting\PageSetting;
use App\Models\PageSetting\PageSettingData;
use App\Models\SocialMedia\LanguageSocialMedia;
use App\Repositories\LanguageRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class UpdateLanguageAction
{
    public $repository;


    public function __construct()
    {
        $this->repository = App::make(LanguageRepositoryEloquent::class);
    }


    public function handle(Request $request, $id)
    {
        $data = $request->only([
            'title',
            'key',
            'active',
            'rtl'
        ]);

        return $this->repository->update($data, $id);
    }
}
