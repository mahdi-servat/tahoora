<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Category;

use App\Repositories\CategoryRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GetAllCategoryAction
{
	public CategoryRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(CategoryRepositoryEloquent::class);
	}


	public function handle(Request $request , $paginate = true)
	{
        if ($paginate){
            return $this->repository->paginate();
        }else {
            return $this->repository->get();
        }
	}
}
