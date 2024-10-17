<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Media;

use App\Repositories\MediaRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GetAllMediaAction
{
	public MediaRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(MediaRepositoryEloquent::class);
	}


	public function handle(Request $request , $paginate = true)
	{
	    return $this->repository->orderBy('date' , 'desc')->orderBy('created_at' , 'desc')->paginate();
	}
}
