<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Page;

use App\Actions\MetaTag\CreateMetaTagAction;
use App\Actions\MetaTag\FindMetaTagByTitleAction;
use App\Actions\MetaTag\FindOrCreateMetaTagAction;
use App\Models\MetaTag\ModelMetaTag;
use App\Repositories\PageRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CreatePageAction
{
	public $repository;


	public function __construct()
	{
		$this->repository = App::make(PageRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
        $data = $request->only([
            'language_id',
            'title',
            'url',
            'status_id',
            'description',
            'content',
        ]);

        if ($request->has('thump')) {
            $file = $request->thump;
            $type = $file->getMimeType();
            $fileHash = str_replace('.' . $file->extension(), '', $file->hashName());
            $fileName = $fileHash . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('articleImage', $fileName, 'uploads');
            $data['thump'] = 'uploads/' . $path;
        }

        $modelType = "App\\Models\\Page\\Page";

        $page = $this->repository->create($data);

        if (!empty($request->tags)){
            $tagsId = app(FindOrCreateMetaTagAction::class)->handle($request->tags);

            foreach ($tagsId as $item){
                ModelMetaTag::create([
                    'meta_tag_id' => $item,
                    'model_type' => $modelType,
                    'model_id' => $page->id,
                ]);
            }
        }

        return $page;
	}
}
