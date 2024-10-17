<?php

/**
 * Actions are class for process
 */

namespace App\Actions\ContactUs;

use App\Repositories\ContactUsRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GetAllContactUsAction
{
	public $repository;


	public function __construct()
	{
		$this->repository = App::make(ContactUsRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
	}
}
