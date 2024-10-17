<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Attachment;

use App\Repositories\AttachmentRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GetAllAttachmentAction
{
	public $repository;


	public function __construct()
	{
		$this->repository = App::make(AttachmentRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
	    return $this->repository->orderBy('created_at' , 'desc')->paginate();
	}
}
