<?php

/**
 * Actions are class for process
 */

namespace App\Actions\News;

use App\Repositories\NewsRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DeleteNewsAction
{
    public $repository;


    public function __construct()
    {
        $this->repository = App::make(NewsRepositoryEloquent::class);
    }


    public function handle(Request $request)
    {
        $news = $this->repository->find($request->id);
        foreach ($news->modelTags as $item) {
            $item->delete();
        }
        if (!empty($news->category)) {
            $news->category->delete();
        }
        return $this->repository->delete($request->id);
    }
}
