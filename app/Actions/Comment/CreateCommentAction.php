<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Comment;


use App\Repositories\CommentRepositoryEloquent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CreateCommentAction
{
    public CommentRepositoryEloquent $repository;


    public function __construct()
    {
        $this->repository = App::make(CommentRepositoryEloquent::class);
    }


    public function handle(Request $request)
    {
        $user = auth('sanctum')->user();
        $data = $request->only([
            'title',
            'description',
            'model_type',
            'model_id',
            'language_id',
        ]);
        $data['date'] = Carbon::now()->format('Y-m-d');
        $data['name'] = $user->name ?? $request->get('name');;
        $data['phone'] = $user->phone ?? $request->get('phone');
        $data['user_id'] = !empty($request->bearerToken()) ? $user->id : null;
        return $this->repository->create($data);
    }
}
