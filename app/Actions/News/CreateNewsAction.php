<?php

/**
 * Actions are class for process
 */

namespace App\Actions\News;

use App\Actions\MetaTag\CreateMetaTagAction;
use App\Actions\MetaTag\FindMetaTagByTitleAction;
use App\Models\Attachment\ModelAttachment;
use App\Models\Category\ModelCategory;
use App\Models\MetaTag\ModelMetaTag;
use App\Repositories\AttachmentRepositoryEloquent;
use App\Repositories\NewsRepositoryEloquent;
use App\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CreateNewsAction
{
    public $repository;


    public function __construct()
    {
        $this->repository = App::make(NewsRepositoryEloquent::class);
    }


    public function handle(Request $request)
    {
        $data = $request->only([
            'language_id',
            'thumpUrl',
            'title',
            'top_title',
            'date',
            'category_id',
            'description',
            'content',
            'status_id',
        ]);
        $data['thump'] = $request->thumpUrl;
        $data['title2'] = str_replace(' ', '', $data['title']);
        $data['date'] = Util::toGregorian($data['date'], false, '-');

        $requestTags = json_decode($request->tags);
        $tagIds = [];
        if (!empty($request->tags) && count($requestTags) > 0){
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

        $news = $this->repository->create($data);
        $modelType = "App\\Models\\News\\News";

        if (!empty($request->category_id) && $request->category_id != null){
            $category = ModelCategory::create([
                'category_id' => $data['category_id'],
                'model_type' => $modelType ,
                'model_id' => $news->id
            ]);
        }

        foreach ($tagIds as $item) {
            ModelMetaTag::create([
                'meta_tag_id' => $item,
                'model_type' => $modelType,
                'model_id' => $news->id,
            ]);
        }

        $attachmentRepository = app(AttachmentRepositoryEloquent::class);

        if (!empty($request->atch_title[0])){
            foreach($request->atch_title as $key => $val){
                $file = $request->atch_image[$key];
                $type = $file->getMimeType();
                $fileHash = str_replace('.' . $file->extension(), '', $file->hashName());
                $fileName = $fileHash . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('Media/', $fileName, 'uploads');

                $atchData = [
                    'title' => $val ,
                    'title2' => str_replace(' ', '', $val) ,
                    'mime_type' => $type ,
                    'path' => 'uploads/' . $path ,
                    'sort' => $request->atch_sort[$key],
                    'attachment_type_id' => 1 ,
                ];
                $attachment = $attachmentRepository->create($atchData);

                ModelAttachment::create([
                    'attachment_id' => $attachment->id ,
                    'model_type' => $modelType ,
                    'model_id' => $news->id
                ]);
            }
        }

        return $news;
    }
}
