<?php

namespace App\Contracts;

interface WishlistServiceInterface
{
    function create($model_type, $model_id, $type);

    function delete($model_type, $model_id, $type);

}
