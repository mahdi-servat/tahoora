<?php

namespace App\Http\Controllers\Api\Testimonials;

use App\Actions\Testimonials\GetAllTestimonialsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Testimonials\Web\GetAllTestimonialsRequest;
use App\Http\Resources\Testimonials\TestimonialsResources;

class TestimonialsController extends Controller
{
    public function index(GetAllTestimonialsRequest $request)
    {
        return TestimonialsResources::collection(app(GetAllTestimonialsAction::class)->take6($request));
    }
}
