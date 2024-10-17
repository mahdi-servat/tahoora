<?php

/**
 * Actions are class for process
 */

namespace App\Actions\SocialMedia;

use App\Repositories\SocialMediaRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GetAllSocialMediaByLanguageAction
{
	public SocialMediaRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(SocialMediaRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
        return $this->repository->filter();
	}
}
