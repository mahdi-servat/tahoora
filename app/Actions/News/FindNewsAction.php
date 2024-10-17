<?php

/**
 * Actions are class for process
 */

namespace App\Actions\News;

use App\Repositories\NewsRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class FindNewsAction
{
	public $repository;


	public function __construct()
	{
		$this->repository = App::make(NewsRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
	    $data = $this->repository->find($request->id);
        if (!empty($request->content_type) && $request->content_type == 'api'){
            $data->update([
                'views' => $data->views + 1
            ]);
        }

	    return $data->load('comments' , 'attachments');
	}
}
