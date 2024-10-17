<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Museum;

use App\Actions\MetaTag\FindOrCreateMetaTagAction;
use App\Models\Attachment\Attachment;
use App\Models\Attachment\ModelAttachment;
use App\Models\Category\ModelCategory;
use App\Models\MetaTag\ModelMetaTag;
use App\Repositories\MuseumRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CreateMuseumAction
{
    public MuseumRepositoryEloquent $repository;


    public function __construct()
    {
        $this->repository = App::make(MuseumRepositoryEloquent::class);
    }


    public function handle(Request $request)
    {
        $data = $request->only([
            'language_id',
            'title',
            'status_id',
            'summary',
            'content',
            'price',
        ]);

        if ($request->has('thump')) {
            $file = $request->thump;
            $fileName = str_replace('.' . $file->extension(), '', $file->hashName()) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('museumImage', $fileName, 'uploads');
            $data['thump'] = 'uploads/' . $path;
        }
        else $data['thump'] = '';



        $museum = $this->repository->create($data);

        if ($request->has('icon')) {
            $file = $request->icon;
            $fileName = str_replace('.' . $file->extension(), '', $file->hashName()) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('museumImage', $fileName, 'uploads');
           $attach =  Attachment::create([
                'title' => $data['title'],
                'path' => 'uploads/' . $path,
                'mime_type' => $file->getMimeType(),
                'attachment_type_id' => 5,
            ]);
            ModelAttachment::create([
                'attachment_id'=>$attach->id,
                'model_type'=>"App\\Models\\Museum\\Museum",
                'model_id'=>$museum->id,
            ]);
        }
        $modelType = "App\\Models\\Museum\\Museum";

        if (!empty($request->category_id)) {
            $category = ModelCategory::create([
                'category_id' => $request->category_id,
                'model_id' => $museum->id,
                'model_type' => $modelType
            ]);
        }

        if (!empty($request->tags)) {
            $tagsId = app(FindOrCreateMetaTagAction::class)->handle($request->tags);

            foreach ($tagsId as $item) {
                ModelMetaTag::create([
                    'meta_tag_id' => $item,
                    'model_type' => $modelType,
                    'model_id' => $museum->id,
                ]);
            }
        }

        return $museum;
    }
}
