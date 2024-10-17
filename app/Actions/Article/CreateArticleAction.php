<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Article;

use App\Actions\MetaTag\FindOrCreateMetaTagAction;
use App\Models\Category\ModelCategory;
use App\Models\MetaTag\ModelMetaTag;
use App\Repositories\ArticleRepositoryEloquent;
use App\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CreateArticleAction
{
	public ArticleRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(ArticleRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
        $data = $request->only([
            'language_id',
            'title',
            'second_title',
            'author',
            'date',
            'status_id',
            'summary',
            'content',
        ]);

        $data['title2'] = str_replace(' ' , '' , $data['title']);

        if (!empty($data['second_title'])){
            $data['second_title2'] = str_replace(' ' , '' , $data['second_title']);
        }

        if ($request->has('thump')) {
            $file = $request->thump;
            $type = $file->getMimeType();
            $fileHash = str_replace('.' . $file->extension(), '', $file->hashName());
            $fileName = $fileHash . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('articleImage', $fileName, 'uploads');
            $data['thump'] = 'uploads/' . $path;
        }

        $article = $this->repository->create($data);

        $modelType = "App\\Models\\Article\\Article";

        if(!empty($request->category_id)){
            $category = ModelCategory::create([
                'category_id' => $request->category_id ,
                'model_id' => $article->id ,
                'model_type' => $modelType
            ]);
        }

        if (!empty($request->tags)){
            $tagsId = app(FindOrCreateMetaTagAction::class)->handle($request->tags);

            foreach ($tagsId as $item){
                ModelMetaTag::create([
                    'meta_tag_id' => $item,
                    'model_type' => $modelType,
                    'model_id' => $article->id,
                ]);
            }
        }

        return $article;
	}
}
