<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Page;

use App\Repositories\PageRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class FindPageAction
{
    public PageRepositoryEloquent $repository;

	public function __construct()
	{
		$this->repository = App::make(PageRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
        return $this->repository->find($request->id);
	}
}
