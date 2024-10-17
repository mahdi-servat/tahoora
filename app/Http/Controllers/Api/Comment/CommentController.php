<?php

namespace App\Http\Controllers\Api\Comment;

use App\Actions\Comment\CreateCommentAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Comment\CommentResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        $data = [
            [
                'key' => 'News' ,
                'model_type' => 'App\Models\News\News'
            ],
            [
                'key' => 'Event' ,
                'model_type' => 'App\Models\Event\Event'
            ],
            [
                'key' => 'Media' ,
                'model_type' => 'App\Models\Media\Media'
            ],
            [
                'key' => 'Article' ,
                'model_type' => 'App\Models\Article\Article'
            ],
            [
                'key' => 'Museum' ,
                'model_type' => 'App\Models\Museum\Museum'
            ],
        ];

        return $data;
    }


    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = app(CreateCommentAction::class)->handle($request);
            DB::commit();
            return new CommentResource($data);
        }catch (\Exception $e){
            return response(['message' => $e->getMessage()] , 500);
        }
    }
}
