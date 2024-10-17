<?php

namespace App\Http\Controllers\web\Slider;

use App\Actions\Slider\CreateSliderAction;
use App\Actions\Slider\DeleteSliderAction;
use App\Actions\Slider\FindSliderAction;
use App\Actions\Slider\GetAllSliderAction;
use App\Actions\Slider\UpdateSliderAction;
use App\Http\Requests\Slider\Web\CreateSliderRequest;
use App\Http\Requests\Slider\Web\DeleteSliderRequest;
use App\Http\Requests\Slider\Web\FindSliderRequest;
use App\Http\Requests\Slider\Web\GetAllSliderRequest;
use App\Http\Requests\Slider\Web\StoreSliderRequest;
use App\Http\Requests\Slider\Web\UpdateSliderRequest;
use Mmwdali\ContainerBuilder\Http\AutoWebController;

class SliderController extends AutoWebController
{
    public function getClass(): array
    {
        return [
            'indexRequest' => GetAllSliderRequest::class,
            'createRequest' => CreateSliderRequest::class,
            'editRequest' => FindSliderRequest::class,
            'storeRequest' => StoreSliderRequest::class,
            'updateRequest' => UpdateSliderRequest::class,
            'deleteRequest' => DeleteSliderRequest::class,
            'indexAction' => GetAllSliderAction::class,
            'createAction' => CreateSliderAction::class,
            'deleteAction' => DeleteSliderAction::class,
            'findAction' => FindSliderAction::class,
            'updateAction' => UpdateSliderAction::class,
            'form' => SliderForm::class,
            'viewPath' => 'admin.layouts.slider',
            'routePrefix' => 'slider',
            'list_title' => 'اسلایدرها',
            'add_title' => 'اسلایدر',
        ];
    }
}
