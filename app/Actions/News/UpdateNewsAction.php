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

class UpdateNewsAction
{
    public $repository;


    public function __construct()
    {
        $this->repository = App::make(NewsRepositoryEloquent::class);
    }


    public function handle(Request $request, $id)
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
        $news = $this->repository->find($id);
        foreach ($news->modelTags as $item) {
            $item->delete();
        }

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

        $news = $this->repository->update($data, $id);
        $modelType = "App\\Models\\News\\News";
        if (!empty($data['category_id'])) {
            $category = ModelCategory::updateOrCreate([
                'model_type' => $modelType,
                'model_id' => $news->id
            ], [
                'category_id' => $data['category_id']
            ]);
        } else {
            !empty($news->category) ? $news->category->delete() : null;
        }

        if (count($tagIds) > 0) {
            foreach ($tagIds as $item) {
                ModelMetaTag::create([
                    'meta_tag_id' => $item,
                    'model_type' => $modelType,
                    'model_id' => $news->id,
                ]);
            }
        }


        $attachmentId = [];

        $attachmentRepository = app(AttachmentRepositoryEloquent::class);
        if (!empty($request->atch_title[0])) {
            foreach ($request->atch_title as $key => $val) {
                $file = $request->atch_image[$key];
                $type = $file->getMimeType();
                $fileHash = str_replace('.' . $file->extension(), '', $file->hashName());
                $fileName = $fileHash . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('News/', $fileName, 'uploads');

                $atchData = [
                    'title' => $val,
                    'title2' => str_replace(' ', '', $val),
                    'mime_type' => $type,
                    'path' => 'uploads/' . $path,
                    'sort' => $request->atch_sort[$key],
                    'attachment_type_id' => 1,
                ];
                $attachment = $attachmentRepository->create($atchData);

                $modelAttachment = ModelAttachment::create([
                    'attachment_id' => $attachment->id,
                    'model_type' => $modelType,
                    'model_id' => $news->id
                ]);
                array_push($attachmentId, $modelAttachment->id);
            }
        }
        $attachmentModel = $request->attachment_model;
        if (!empty($news->modelAttachments) && count($news->modelAttachments) > 0) {
            foreach ($news->modelAttachments as $item) {
                if (!empty($attachmentModel) && is_array($attachmentModel) && !in_array($item->id, $attachmentModel)) {
                    if (count($attachmentId) > 0) {
                        !in_array($item->id, $attachmentId) ? $item->delete() : null;
                    } else {
                        $item->delete();
                    }
                }
                if (empty($attachmentModel) && !is_array($attachmentModel)) {
                    if (count($attachmentId) > 0) {
                        !in_array($item->id, $attachmentId) ? $item->delete() : null;
                    } else {
                        $item->delete();
                    }
                }
            }
        }

        return $news;
    }
}
