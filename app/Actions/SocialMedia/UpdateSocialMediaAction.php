<?php

/**
 * Actions are class for process
 */

namespace App\Actions\SocialMedia;

use App\Models\Language\Language;
use App\Models\SocialMedia\ModelSocialMedia;
use App\Repositories\SocialMediaRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class UpdateSocialMediaAction
{
	public SocialMediaRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(SocialMediaRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
        $language = Language::where('key' , $request->key)->first();


        return ModelSocialMedia::updateOrCreate([
                'social_media_id' => $request->id ,
                'model_type' => "App\Models\Language\Language",
                'model_id' => $language->id
            ],
            [
                'value' => $request->value
            ]);
	}
}
