<?php

namespace App\Services;

use App\Classes\Util;
use App\Contracts\WishlistServiceInterface;
use App\Models\Wishlist;

class WishlistService implements WishlistServiceInterface
{
    function create($model_type, $model_id, $type)
    {
        \DB::beginTransaction();
        try {
            Wishlist::create([
                'model_type' => Util::getModelType($model_type),
                'model_id' => $model_id,
                'user_id' => auth()->id(),
                'type' => $type,
            ]);
            \DB::commit();
        } catch (\Exception $exception) {
            \DB::rollBack();
            throw $exception;
        }
    }

    function delete($model_type, $model_id, $type)
    {
        \DB::beginTransaction();
        try {
            Wishlist::where([['model_type', Util::getModelType($model_type)], ['model_id', $model_id], ['type', $type]])->delete();
            \DB::commit();
        } catch (\Exception $exception) {
            \DB::beginTransaction();
            throw $exception;
        }
    }

}
