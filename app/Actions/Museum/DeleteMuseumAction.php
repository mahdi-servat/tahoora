<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Museum;

use App\Repositories\MuseumRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DeleteMuseumAction
{
	public MuseumRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(MuseumRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
        $museum = $this->repository->find($request->id);

        if (!empty($museum->modelTags) && count($museum->modelTags) > 0){
            foreach ($museum->modelTags as $item){
                $item->delete();
            }
        }
        if (!empty($museum->category)){
            $museum->category->delete();
        }

        return $museum->delete();
	}
}
