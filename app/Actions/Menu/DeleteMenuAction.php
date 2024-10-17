<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Menu;

use App\Repositories\MenuRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DeleteMenuAction
{
	public $repository;


	public function __construct()
	{
		$this->repository = App::make(MenuRepositoryEloquent::class);
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
