<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Page;

use App\Repositories\PageRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GetAllPageAction
{
	public PageRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(PageRepositoryEloquent::class);
	}


	public function handle(Request $request, $paginate = true)
	{
        if ($paginate){
            return $this->repository->paginate();
        }else{
            return $this->repository->get();
        }
	}
}
