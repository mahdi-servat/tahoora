<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Attachment;

use App\Repositories\AttachmentRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class FindAttachmentAction
{
	public $repository;


	public function __construct()
	{
		$this->repository = App::make(AttachmentRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
	    return $this->repository->find($request->id);
	}
}
