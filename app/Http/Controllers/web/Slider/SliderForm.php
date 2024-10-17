<?php

namespace App\Http\Controllers\web\Slider;

use App\Models\Slider\SliderTypes;
use App\Models\Status;
use App\Repositories\LanguageRepositoryEloquent;
use Kris\LaravelFormBuilder\Form;

class SliderForm extends Form
{
    public function buildForm()
    {
        $this
            ->add("language_id", "entity", [
                'label' => __('validation.attributes.language_id'),
                "label_attr" => ["class" => "form-label d-block"],
                'rules' => ['required'],
                "wrapper" => ["class" => "col-12 col-sm-6 col-md-3 form-group reqiured"],
                "attr" => ["class" => "form-control select2 col-12 col-sm-6 col-md-3"],
                "class" => "App\Models\Language\Language",
                "property" => "title",
                "property_key " => "id",
                "empty_value" => __("validation.attributes.choose"),
                "selected" => function () {
                    return !empty($this->model->language_id) ? $this->model->language_id : null;
                },
                "query_builder" => function () {
                    return app(LanguageRepositoryEloquent::class)->all();
                }
            ])
            ->add("status_id", "entity", [
                'label' => __('validation.attributes.status_id'),
                "label_attr" => ["class" => "form-label"],
                "wrapper" => ["class" => "col-12 col-sm-6 col-md-3 form-group"],
                "attr" => ["class" => "form-control select2"],
                "class" => "App\Models\Status",
                "property" => "title",
                "property_key " => "id",
                "selected" => function () {
                    return !empty($this->model) && !empty($this->model->status_id) ? $this->model->status_id : null;
                },
                "query_builder" => function () {
                    return Status::all();
                }
            ])
            ->add("slider_type_id", "entity", [
                'label' => __('validation.attributes.slider_type_id'),
                "label_attr" => ["class" => "form-label"],
                "wrapper" => ["class" => "col-12 col-sm-6 col-md-3 form-group"],
                "attr" => ["class" => "form-control select2"],
                "class" => "App\Models\Slider\SliderTypes",
                "property" => "title",
                "property_key " => "id",
                "selected" => function () {
                    return !empty($this->slider_type_id) ? $this->model->status_id : null;
                },
                "query_builder" => function () {
                    return SliderTypes::all();
                }
            ])
            ->add("title", "text", ['label' => __('validation.attributes.title'), "label_attr" => ["class" => "form-label"], 'rules' => ['required'], "wrapper" => ["class" => "col-12 col-md-3 mb-1"], "value" => function ($data) {

                return $data;
            }, "attr" => ["class" => "form-control"]])
            ->add("description", "textarea", ['label' => __('validation.attributes.description'), "label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-md-12 mb-1"], "value" => function ($data) {
                return $data;
            }, "attr" => ["class" => "form-control ", "rows" => 3]])
            ->add('send', 'submit', ['label' => __('validation.attributes.send'), 'wrapper' => ['class' => 'col-12'], 'attr' => ['name' => 'send', 'class' => 'btn btn-info btn-tall waves-effect waves-light mt-1']]);
    }
}
