<?php

/**
 * Actions are class for process
 */

namespace App\Actions\MetaTag;

use App\Repositories\MetaTagRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CreateMetaTagAction
{
    public $repository;


    public function __construct()
    {
        $this->repository = App::make(MetaTagRepositoryEloquent::class);
    }


    public function handle(Request $request)
    {
        $data = $request->only([
            'title',
        ]);

        $data['title2'] = str_replace(' ', '', $data['title']);

        return $this->repository->create($data);
    }
}
