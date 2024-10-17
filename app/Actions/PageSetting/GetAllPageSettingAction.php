<?php

/**
 * Actions are class for process
 */

namespace App\Actions\PageSetting;

use App\Repositories\PageSettingRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GetAllPageSettingAction
{
	public PageSettingRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(PageSettingRepositoryEloquent::class);
	}


	public function handle(Request $request , $paginate = true)
	{
	    if ($paginate){
	        return $this->repository->paginate();
        }else {
            return $this->repository->get();
        }
	}
}
