<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Comment;

use App\Repositories\CommentRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GetAllCommentAction
{
	public CommentRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(CommentRepositoryEloquent::class);
	}


	public function handle(Request $request , $paginate = true)
	{
	    if ($paginate){
            return $this->repository->paginate();
        }else {
            return $this->repository->get();
        }
	}
}
