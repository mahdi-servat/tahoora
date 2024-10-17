<?php

/**
 * Actions are class for process
 */

namespace App\Actions\MetaTag;

use App\Repositories\MetaTagRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DeleteMetaTagAction
{
	public $repository;


	public function __construct()
	{
		$this->repository = App::make(MetaTagRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
	}
}
