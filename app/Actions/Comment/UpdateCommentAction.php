<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Comment;

use App\Repositories\CommentRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class UpdateCommentAction
{
    public CommentRepositoryEloquent $repository;


    public function __construct()
    {
        $this->repository = App::make(CommentRepositoryEloquent::class);
    }


    public function handle(Request $request, $id)
    {
        $data = $request->only([
            'title',
            'key',
            'active',
            'rtl'
        ]);

        return $this->repository->update($data, $id);
    }
}
