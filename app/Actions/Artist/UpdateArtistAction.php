<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Artist;

use App\Actions\MetaTag\FindOrCreateMetaTagAction;
use App\Models\Artist\MuseumArtist;
use App\Models\Attachment\ModelAttachment;
use App\Models\Category\ModelCategory;
use App\Models\MetaTag\ModelMetaTag;
use App\Models\SocialMedia\ModelSocialMedia;
use App\Repositories\ArtistRepositoryEloquent;
use App\Repositories\AttachmentRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class UpdateArtistAction
{
    public ArtistRepositoryEloquent $repository;


    public function __construct()
    {
        $this->repository = App::make(ArtistRepositoryEloquent::class);
    }


    public function handle(Request $request)
    {
        $data = $request->only([
            'language_id',
            'title',
            'status_id',
            'summary',
            'content',
        ]);
        $artist = $this->repository->find($request->id);
        $artist->museums()->delete();
        foreach ($request->services as $item) {
            MuseumArtist::create([
                'artist_id' => $artist->id,
                'museum_id' => $item,
            ]);
        }

        if ($request->has('thump')) {
            $file = $request->thump;
            $fileHash = str_replace('.' . $file->extension(), '', $file->hashName());
            $fileName = $fileHash . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('artistImage', $fileName, 'uploads');
            $data['thump'] = 'uploads/' . $path;
        }

        $artist = $this->repository->find($request->id);
        $modelType = "App\\Models\\Artist\\Artist";
        $artist->update($data);

        if (!empty($artist->category)) {
            $artist->category->delete();
        }

        if (!empty($request->category_id)) {
            $category = ModelCategory::create([
                'category_id' => $request->category_id,
                'model_id' => $artist->id,
                'model_type' => $modelType
            ]);
        }

        if (!empty($article->modelTags) && count($article->modelTags) > 0) {
            foreach ($article->modelTags as $item) {
                $item->delete();
            }
        }

        if (!empty($request->tags)) {
            $tagsId = app(FindOrCreateMetaTagAction::class)->handle($request->tags);

            foreach ($tagsId as $item) {
                ModelMetaTag::create([
                    'meta_tag_id' => $item,
                    'model_type' => $modelType,
                    'model_id' => $artist->id,
                ]);
            }
        }
        if (!empty($artist->modelSocialMedia) && count($artist->modelSocialMedia) > 0) {
            foreach ($artist->modelSocialMedia as $item) {
                $item->delete();
            }
        }
        if (!empty($request->social_media) && count($request->social_media)) {
            foreach ($request->social_media as $key => $val) {
                $test = ModelSocialMedia::updateOrCreate([
                    'social_media_id' => $key,
                    'model_id' => $artist->id,
                    'model_type' => $modelType,
                ], [
                    'value' => $val
                ]);
            }
        }

        $attachmentId = [];

        $attachmentRepository = app(AttachmentRepositoryEloquent::class);
        if (!empty($request->atch_title[0])) {
            foreach ($request->atch_title as $key => $val) {
                $atchData = [
                    'title' => $val,
                    'title2' => str_replace(' ', '', $val),
                    'sort' => $request->atch_sort[$key],
                ];

                if (empty($request->atch_file_id[$key])) {
                    throw new \Exception('بارگذاری با مشکل مواجه شده است');
                }

                $attachment = $attachmentRepository->find($request->atch_file_id[$key]);
                $attachment->update($atchData);

                $modelAttachment = ModelAttachment::create([
                    'attachment_id' => $attachment->id,
                    'model_type' => $modelType,
                    'model_id' => $artist->id
                ]);
                array_push($attachmentId, $modelAttachment->id);
            }
        }
        $attachmentModel = $request->attachment_model;
        if (!empty($artist->modelAttachments) && count($artist->modelAttachments) > 0) {
            foreach ($artist->modelAttachments as $item) {
                if (!empty($attachmentModel) && is_array($attachmentModel) && !in_array($item->id, $attachmentModel)) {
                    if (count($attachmentId) > 0) {
                        !in_array($item->id, $attachmentId) ? $item->delete() : null;
                    }
                    else {
                        $item->delete();
                    }
                }
                if (empty($attachmentModel) && !is_array($attachmentModel)) {
                    if (count($attachmentId) > 0) {
                        !in_array($item->id, $attachmentId) ? $item->delete() : null;
                    }
                    else {
                        $item->delete();
                    }
                }
            }
        }

        return $artist;
    }
}
