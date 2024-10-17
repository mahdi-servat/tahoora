<?php

/**
 * Actions are class for process
 */

namespace App\Actions\MetaTag;

use App\Repositories\MetaTagRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class FindOrCreateMetaTagAction
{
	public MetaTagRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(MetaTagRepositoryEloquent::class);
	}


	public function handle($tags): array
	{
        $requestTags = json_decode($tags);
        $tagIds = [];

        if (!empty($tags) && count($requestTags) > 0){
            foreach ($requestTags as $item) {
                if (!empty($item->value)){
                    $tag = app(FindMetaTagByTitleAction::class)->handle($item->value);

                    if (!empty($tag)) {
                        array_push($tagIds, $tag->id);
                    } else {
                        $tagReq = Request::create('test', 'post', [
                            'title' => $item->value
                        ]);
                        $tagNew = app(CreateMetaTagAction::class)->handle($tagReq);

                        array_push($tagIds, $tagNew->id);
                    }
                }
            }
        }

        return $tagIds;
	}
}
