<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Menu;

use App\Repositories\MenuRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class FindMenuAction
{
	public $repository;


	public function __construct()
	{
		$this->repository = App::make(MenuRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
        return $this->repository->find($request->id);
    }
}
