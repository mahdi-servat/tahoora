<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Program;

use App\Repositories\ProgramRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GetAllProgramAction
{
	public ProgramRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(ProgramRepositoryEloquent::class);
	}


	public function handle(Request $request , $paginate = true)
	{
        if ($paginate){
            return $this->repository->orderBy('sort')->paginate();
        }else{
            return $this->repository->orderBy('sort')->get();
        }
	}
}
