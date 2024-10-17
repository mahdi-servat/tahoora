<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Article;

use App\Repositories\ArticleRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GetAllArticleAction
{
	public ArticleRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(ArticleRepositoryEloquent::class);
	}


	public function handle(Request $request , $paginate = true)
	{
        if ($paginate){
            return $this->repository->paginate();
        }else{
            return $this->repository->get();
        }
	}
}
