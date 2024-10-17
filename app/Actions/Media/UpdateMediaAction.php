<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Media;

use App\Actions\MetaTag\CreateMetaTagAction;
use App\Actions\MetaTag\FindMetaTagByTitleAction;
use App\Models\Attachment\ModelAttachment;
use App\Models\MetaTag\ModelMetaTag;
use App\Repositories\AttachmentRepositoryEloquent;
use App\Repositories\MediaRepositoryEloquent;
use App\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class UpdateMediaAction
{
    public MediaRepositoryEloquent $repository;


    public function __construct()
    {
        $this->repository = App::make(MediaRepositoryEloquent::class);
    }


    public function handle(Request $request, $id)
    {
        $data = $request->only([
            'language_id',
            'thump',
            'title',
            'status_id',
            'description',
            'date',
        ]);
        $data['date'] = Util::toGregorian($request->date);

        $data['title2'] = str_replace(' ', '', $data['title']);
        $media = $this->repository->update($data, $id);


        foreach ($media->modelTags as $item) {
            $item->delete();
        }

        $requestTags = json_decode($request->tags);
        $tagIds = [];
        if (!empty($request->tags) && count($requestTags) > 0) {
            foreach ($requestTags as $item) {
                if (!empty($item->value)) {
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
        $modelType = "App\\Models\\Media\\Media";

        foreach ($tagIds as $item) {
            ModelMetaTag::create([
                'meta_tag_id' => $item,
                'model_type' => $modelType,
                'model_id' => $media->id,
            ]);
        }

        $attachmentId = [];

        $attachmentRepository = app(AttachmentRepositoryEloquent::class);
        if (!empty($request->atch_title[0])) {
            foreach ($request->atch_title as $key => $val) {
                $atchData = [
                    'title' => $val,
                    'title2' => str_replace(' ', '', $val),
                    'sort' => $request->atch_sort[$key],
                    'description' => $request->atch_des[$key],
                ];

                if (empty($request->atch_file_id[$key])) {
                    throw new \Exception('بارگذاری با مشکل مواجه شده است');
                }

                $attachment = $attachmentRepository->find($request->atch_file_id[$key]);
                $attachment->update($atchData);

                $modelAttachment = ModelAttachment::create([
                    'attachment_id' => $attachment->id,
                    'model_type' => $modelType,
                    'model_id' => $media->id
                ]);
                array_push($attachmentId, $modelAttachment->id);
            }
        }
        $attachmentModel = $request->attachment_model;
        if (!empty($media->modelAttachments) && count($media->modelAttachments) > 0) {
            foreach ($media->modelAttachments as $item) {
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
        return $media;
    }
}
