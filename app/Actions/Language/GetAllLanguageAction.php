<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Language;

use App\Repositories\LanguageRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GetAllLanguageAction
{
	public $repository;


	public function __construct()
	{
		$this->repository = App::make(LanguageRepositoryEloquent::class);
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
