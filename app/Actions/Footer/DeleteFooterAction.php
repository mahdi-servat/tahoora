<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Footer;

use App\Repositories\FooterRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DeleteFooterAction
{
	public FooterRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(FooterRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
        $data = $this->repository->find($request->id);

        if (!empty($data->children) && count($data->children) > 0){
            throw new \Exception('رکورد مورد نظر دارای فرزند میباشد');
        }

	    return $this->repository->delete($request->id);
	}
}
