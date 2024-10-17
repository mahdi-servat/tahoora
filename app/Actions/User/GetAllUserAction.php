<?php

/**
 * Actions are class for process
 */

namespace App\Actions\User;

use App\Repositories\NewsRepositoryEloquent;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GetAllUserAction
{
	public $repository;


	public function __construct()
	{
		$this->repository = App::make(UserRepositoryEloquent::class);
	}


	public function handle(Request $request , $paginate = true)
	{
	    return $this->repository->paginate();
	}
}
