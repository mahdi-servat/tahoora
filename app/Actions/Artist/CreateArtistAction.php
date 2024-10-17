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

class CreateArtistAction
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

        if ($request->has('thump')) {
            $file = $request->thump;
            $type = $file->getMimeType();
            $fileHash = str_replace('.' . $file->extension(), '', $file->hashName());
            $fileName = $fileHash . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('artistImage', $fileName, 'uploads');
            $data['thump'] = 'uploads/' . $path;
        }

        $artist = $this->repository->create($data);
        $artist->museums()->delete();
        foreach ($request->services as $item) {
            MuseumArtist::create([
                'artist_id' => $artist->id,
                'museum_id' => $item,
            ]);
        }
        $modelType = "App\\Models\\Artist\\Artist";

        if (!empty($request->category_id)) {
            $category = ModelCategory::create([
                'category_id' => $request->category_id,
                'model_id' => $artist->id,
                'model_type' => $modelType
            ]);
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


        $attachmentRepository = app(AttachmentRepositoryEloquent::class);


        foreach ($request->atch_title as $key => $val) {
            $atchData = [
                'title' => $val,
                'sort' => $request->atch_sort[$key],
            ];

            if (empty($request->atch_file_id[$key])) {
                throw new \Exception('بارگذاری با مشکل مواجه شده است');
            }
            $attachment = $attachmentRepository->find($request->atch_file_id[$key]);
            $attachment->update($atchData);

            ModelAttachment::create([
                'attachment_id' => $attachment->id,
                'model_type' => $modelType,
                'model_id' => $artist->id
            ]);
        }

        return $artist;

    }
}
