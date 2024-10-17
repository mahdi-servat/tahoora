<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Slider;

use App\Repositories\SliderRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CreateSliderAction
{
    public $repository;


    public function __construct()
    {
        $this->repository = App::make(SliderRepositoryEloquent::class);
    }


    public function handle(Request $request)
    {
        $data = $request->only([
            'language_id',
            'status_id',
            'slider_type_id',
            'title',
            'description',
        ]);
        $data['user_id'] = auth()->id();

        $slider = $this->repository->create($data);

        return $slider;
    }

}
