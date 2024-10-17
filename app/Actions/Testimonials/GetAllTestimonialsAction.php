<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Testimonials;

use App\Repositories\TestimonialsRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GetAllTestimonialsAction
{
	public $repository;


	public function __construct()
	{
		$this->repository = App::make(TestimonialsRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
        return $this->repository->orderBy('created_at' , 'desc')->paginate();
	}

	public function take6(Request $request)
	{
        return $this->repository->orderBy('created_at' , 'desc')->take(6)->get();
	}
}
