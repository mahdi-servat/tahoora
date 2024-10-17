<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Testimonials;

use App\Repositories\TestimonialsRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DeleteTestimonialsAction
{
	public $repository;


	public function __construct()
	{
		$this->repository = App::make(TestimonialsRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
        return $this->repository->delete($request->id);

	}
}
