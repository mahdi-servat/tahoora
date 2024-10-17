<?php

namespace App\Http\Controllers\web\Testimonials;

use App\Entities\Museum;
use Kris\LaravelFormBuilder\Form;

class TestimonialsForm extends Form
{
    public function buildForm()
    {
        $this
            ->add("title", "text", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-md-4 mb-1"], "value" => function ($data) {
                return $data;
            }, "attr" => ["class" => "form-control"]])

            ->add("thump", "file", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-sm-6 col-md-4 mb-1"], "value" => function ($data) {
                return $data;
            }, "attr" => ["class" => "form-control col-12 col-md-3 mb-1 "]])
            ->add("museum_id", "entity", [
                "label_attr" => ["class" => "form-label"],
                "wrapper" => ["class" => "col-12 col-sm-6 col-md-4 form-group"],
                "attr" => ["class" => "form-control select2"],
                "class" => "App\Models\Museum\Museum",
                "property" => "title",
                "property_key " => "id",
                "empty_value" => __("validation.attributes.choose"),
                "selected" => function () {
                    return !empty($this->model->museum_id)? $this->model->museum_id : null;
                },
                "query_builder" => function () {
                    return Museum::all();
                }
            ])
            ->add("description", "textarea", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-md-12 mb-1"], "value" => function ($data) {
                return $data;
            }, "attr" => ["class" => "form-control ck"]])
            ->add('send', 'submit', ['wrapper' => ['class' => 'col-12'], 'attr' => ['name' => 'send', 'class' => 'btn btn-info btn-tall waves-effect waves-light']])
        ;

    }
}
