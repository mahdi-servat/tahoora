<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Event;

use App\Repositories\EventRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DeleteEventAction
{
	public EventRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(EventRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
        return $this->repository->delete($request->id);
    }
}
