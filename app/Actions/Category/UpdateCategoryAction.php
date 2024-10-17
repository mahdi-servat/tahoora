<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Category;

use App\Repositories\CategoryRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class UpdateCategoryAction
{
	public $repository;


	public function __construct()
	{
		$this->repository = App::make(CategoryRepositoryEloquent::class);
	}


	public function handle(Request $request , $id)
	{
        $data = $request->only([
            'title',
            'parent_id',
            'language_id',
            'category_type_id',
        ]);

        $data['title2'] = str_replace(' ', '', $data['title']);


        return $this->repository->update($data , $id);
	}
}
