<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Museum;

use App\Repositories\MuseumRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class FindMuseumAction
{
	public MuseumRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(MuseumRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
        return $this->repository->find($request->id);
	}
}
