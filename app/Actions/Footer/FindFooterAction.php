<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Footer;

use App\Repositories\FooterRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class FindFooterAction
{
	public FooterRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(FooterRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
	    return $this->repository->find($request->id);
	}
}
