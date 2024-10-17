<?php

namespace App\Http\Controllers\web\Testimonials;

use App\Actions\Testimonials\CreateTestimonialsAction;
use App\Actions\Testimonials\DeleteTestimonialsAction;
use App\Actions\Testimonials\FindTestimonialsAction;
use App\Actions\Testimonials\GetAllTestimonialsAction;
use App\Actions\Testimonials\UpdateTestimonialsAction;
use App\Http\Requests\Testimonials\Web\CreateTestimonialsRequest;
use App\Http\Requests\Testimonials\Web\DeleteTestimonialsRequest;
use App\Http\Requests\Testimonials\Web\FindTestimonialsRequest;
use App\Http\Requests\Testimonials\Web\GetAllTestimonialsRequest;
use App\Http\Requests\Testimonials\Web\StoreTestimonialsRequest;
use App\Http\Requests\Testimonials\Web\UpdateTestimonialsRequest;
use Mmwdali\ContainerBuilder\Http\AutoWebController;

class TestimonialsController extends AutoWebController
{
    /**
     * Display a listing of the resource.
     */
    public function getClass() : array
    {
        return [
            'indexRequest' => GetAllTestimonialsRequest::class ,
            'createRequest' => CreateTestimonialsRequest::class ,
            'editRequest' => FindTestimonialsRequest::class ,
            'storeRequest' => StoreTestimonialsRequest::class ,
            'updateRequest' => UpdateTestimonialsRequest::class ,
            'deleteRequest' => DeleteTestimonialsRequest::class ,
            'indexAction' => GetAllTestimonialsAction::class ,
            'createAction' => CreateTestimonialsAction::class ,
            'deleteAction' => DeleteTestimonialsAction::class,
            'findAction' => FindTestimonialsAction::class,
            'updateAction' => UpdateTestimonialsAction::class,
            'form' => TestimonialsForm::class,
            'viewPath' => 'admin.layouts.testimonial',
            'routePrefix' => 'testimonial',
            'list_title' => 'توصیفات',
            'add_title' => 'توصیف',
        ];
    }

}
