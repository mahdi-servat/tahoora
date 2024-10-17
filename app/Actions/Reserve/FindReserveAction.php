<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Reserve;

use App\Repositories\ReserveRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class FindReserveAction
{
	public $repository;


	public function __construct()
	{
		$this->repository = App::make(ReserveRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
	}
}
