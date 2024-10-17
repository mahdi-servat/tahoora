<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Language;

use App\Repositories\LanguageRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DeleteLanguageAction
{
	public $repository;


	public function __construct()
	{
		$this->repository = App::make(LanguageRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
        return $this->repository->delete($request->id);
	}
}
