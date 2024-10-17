<?php

/**
 * Actions are class for process
 */

namespace App\Actions\User;

use App\Repositories\NewsRepositoryEloquent;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DeleteUserAction
{
    public $repository;


    public function __construct()
    {
        $this->repository = App::make(UserRepositoryEloquent::class);
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
