<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Article;

use App\Repositories\ArticleRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DeleteArticleAction
{
	public ArticleRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(ArticleRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
        $article = $this->repository->find($request->id);

        if (!empty($article->modelTags) && count($article->modelTags) > 0){
            foreach ($article->modelTags as $item){
                $item->delete();
            }
        }
        if (!empty($article->category)){
            $article->category->delete();
        }
        return $article->delete($request->id);
	}
}
