<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Footer;

use App\Repositories\FooterRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GetAllFooterAction
{
	public FooterRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(FooterRepositoryEloquent::class);
	}


	public function handle(Request $request , $paginate = true)
	{
	    if ($paginate){
            return $this->repository->paginate();
        }else {
            if (@$request->content_type == 'json'){
                return $this->repository->where('parent_id' , null)->get();
            }
            return $this->repository->get();
        }
	}
}
