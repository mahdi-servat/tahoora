<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Program;

use App\Repositories\ProgramRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DeleteProgramAction
{
	public ProgramRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(ProgramRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
        return $this->repository->delete($request->id);
	}
}
