<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Category;

use App\Repositories\CategoryRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DeleteCategoryAction
{
	public $repository;


	public function __construct()
	{
		$this->repository = App::make(CategoryRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
        return $this->repository->delete($request->id);
    }
}
