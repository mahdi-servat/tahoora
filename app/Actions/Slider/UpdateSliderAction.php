<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Slider;

use App\Repositories\SliderRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class UpdateSliderAction
{
	public $repository;


	public function __construct()
	{
		$this->repository = App::make(SliderRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
	}
}
