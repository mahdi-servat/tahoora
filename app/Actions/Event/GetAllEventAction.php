<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Event;

use App\Repositories\EventRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GetAllEventAction
{
	public EventRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(EventRepositoryEloquent::class);
	}


	public function handle(Request $request , $paginate = true)
	{
        if ($paginate){
            return $this->repository->paginate();
        } else{
            return $this->repository->get();
        }
	}
}
