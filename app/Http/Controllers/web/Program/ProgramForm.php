<?php

namespace App\Http\Controllers\web\Program;

use App\Models\Status;
use App\Repositories\LanguageRepositoryEloquent;
use Kris\LaravelFormBuilder\Form;

class ProgramForm extends Form
{
    protected $formOptions = [
        'language_name' => 'validation.attributes',
    ];

    public function buildForm()
    {
        $this
            ->add("language_id", "entity", [
                "label_attr" => ["class" => "form-label d-block"],
                "wrapper" => ["class" => "col-12 col-sm-6 col-md-3 mb-1 form-group"],
                "attr" => ["class" => "form-control select2 col-12 col-sm-6 col-md-3"],
                "class" => "App\Models\Language\Language",
                "property" => "title",
                "property_key " => "id",
                "empty_value" => __("validation.attributes.choose"),
                "selected" => function () {
                    return !empty($this->model) && !empty($this->model->language_id) ? $this->model->language_id : null;
                },
                "query_builder" => function () {
                    return app(LanguageRepositoryEloquent::class)->all();
                }
            ])
            ->add("title", "text", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-md-3 mb-1"], "value" => function ($data) {
                return $data;
            }, "attr" => ["class" => "form-control"]])
            ->add("url", "text", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-md-3 mb-1"], "value" => function ($data) {
                return $data;
            }, "attr" => ["class" => "form-control"]])
            ->add("thump", "file", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-md-3 mb-1"], "value" => function ($data) {
                return $data;
            }, "attr" => ["class" => "form-control col-12 col-md-3 mb-1 "]])
            ->add("status_id", "entity", [
                "label_attr" => ["class" => "form-label"],
                "wrapper" => ["class" => "col-12 col-sm-6 col-md-3 form-group"],
                "attr" => ["class" => "form-control select2"],
                "class" => "App\Models\Status",
                "property" => "title",
                "property_key " => "id",
                "empty_value" => __("validation.attributes.choose"),
                "selected" => function () {
                    return !empty($this->model) && !empty($this->model->status_id) ? $this->model->status_id : null;
                },
                "query_builder" => function () {
                    return Status::all();
                }
            ])
            ->add("description", "textarea", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-md-10 mb-1"], "value" => function ($data) {
                return $data;
            }, "attr" => ["class" => "form-control ck"]])
            ->add('send', 'submit', ['wrapper' => ['class' => 'col-12'], 'attr' => ['name'=>'send','class' => 'btn btn-info btn-tall waves-effect waves-light']]);
    }
}
