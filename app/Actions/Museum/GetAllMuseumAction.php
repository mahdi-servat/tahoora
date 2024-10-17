<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Museum;

use App\Repositories\MuseumRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GetAllMuseumAction
{
	public MuseumRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(MuseumRepositoryEloquent::class);
	}


	public function handle(Request $request , $paginate = true)
	{
        if ($paginate){
            return $this->repository->paginate();
        }else{
            return $this->repository->get();
        }
	}
}
