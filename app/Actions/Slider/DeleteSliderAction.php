<?php

namespace App\Actions\Slider;

use App\Repositories\SliderRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DeleteSliderAction
{
    public $repository;


    public function __construct()
    {
        $this->repository = App::make(SliderRepositoryEloquent::class);
    }


    public function handle(Request $request)
    {
        return $this->repository->find($request->id)->delete();

    }
}
