<?php

namespace App\Http\Controllers\web\Footer;

use App\Models\Footer\Footer;
use App\Models\Status;
use App\Repositories\LanguageRepositoryEloquent;
use Kris\LaravelFormBuilder\Form;

class FooterForm extends Form
{
    protected $formOptions = [
        'language_name' => 'validation.attributes',
    ];

    public function buildForm()
    {
        $this
            ->add("language_id", "entity", [
                "label_attr" => ["class" => "form-label d-block"],
                "wrapper" => ["class" => "col-12 mb-1 form-group"],
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
            ->add("sort", "number", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-md-3 mb-1"], "value" => function ($data) {
                return $data;
            }, "attr" => ["class" => "form-control"]])
            ->add("parent_id", "entity", [
                "label_attr" => ["class" => "form-label"],
                "wrapper" => ["class" => "col-12 col-sm-6 col-md-3 form-group"],
                "attr" => ["class" => "form-control select2" , 'disabled'],
                "class" => "App\Models\Footer\Footer",
                "property" => "title",
                "property_key " => "id",
                "empty_value" => __("validation.attributes.choose"),
                "selected" => function () {
                    return !empty($this->model) && !empty($this->model->parent_id) ? $this->model->parent_id : null;
                },
                "query_builder" => function () {
                    return Footer::where('status_id',1)->get();
                }
            ])
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
            ->add('send', 'submit', ['wrapper' => ['class' => 'col-12 mt-2'], 'attr' => ['name'=>'send','class' => 'btn btn-info btn-tall waves-effect waves-light']]);
    }
}
