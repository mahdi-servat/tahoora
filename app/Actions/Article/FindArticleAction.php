<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Article;

use App\Repositories\ArticleRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class FindArticleAction
{
	public ArticleRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(ArticleRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
        return $this->repository->find($request->id);
	}
}
