<?php

namespace App\Traits;

use App\Models\Comment\Comment;
use App\Models\Language\Language;
use App\Models\MetaTag\MetaTag;
use App\Models\MetaTag\ModelMetaTag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Taggable
{
    public function tags(): MorphToMany
    {
        return $this->morphToMany(MetaTag::class, 'model', 'model_meta_tags');
    }

    public function modelTags(): MorphMany
    {
        return $this->morphMany(ModelMetaTag::class, 'model');
    }

    public function relatedItems()
    {
        $dateField = in_array('date' , $this->getFillable()) ? 'date' : 'created_at';
        $items = $this->modelTags ;
        $dataId = $this->id ;
        $language = Language::where('key' ,app()->getLocale())->first();
        $id = [];
        foreach($items as $item){
            array_push($id , $item->meta_tag_id);
        }
        $data = $this->whereHas('modelTags' , function(Builder $query) use ($dataId, $id) {
            $query->whereIn('meta_tag_id', $id );
        })->whereNotIn('id', [$dataId])->orderBy($dateField, 'desc')->where('status_id' , 1)->take(9)->get();
        if (empty($data) && $data->count() == 0){
            return $this->take(9)->where('status_id' , 1)->get();
        }elseif (!empty($data) && ($data->count() < 9) ) {
            $count = 9 - $data->count();
            $data2 = $this->orderBy($dateField, 'desc')->whereNotIn('id' , $data->pluck('id')->toArray())->whereNotIn('id' , [$dataId])->where('status_id' , 1)->where('language_id' , $language->id)->take($count)->get();
            $data = $data->merge($data2);
        }

        return $data;
    }
}
