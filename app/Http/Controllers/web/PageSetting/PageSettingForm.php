<?php

namespace App\Http\Controllers\web\PageSetting;

use App\Models\PageSetting\PageSettingType;
use Kris\LaravelFormBuilder\Form;

class PageSettingForm extends Form
{
    protected $formOptions = [
        'language_name' => 'validation.attributes',
    ];

    public function buildForm()
    {
        $this
            ->add("page_setting_type_id", "entity", [
                "label_attr" => ["class" => "form-label d-block"],
                "wrapper" => ["class" => "col-12 mb-1 form-group"],
                "attr" => ["class" => "form-control select2 col-12 col-sm-6 col-md-3"],
                "class" => "App\Models\PageSetting\PageSettingType",
                "property" => "title",
                "property_key " => "id",
                "empty_value" => __("validation.attributes.choose"),
                "selected" => function () {
                    return !empty($this->model) && !empty($this->model->page_setting_type_id) ? $this->model->page_setting_type_id : null;
                },
                "query_builder" => function () {
                    return PageSettingType::all();
                }
            ])
            ->add("key", "text", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-md-3 mb-1"], "value" => function ($data) {
                return $data;
            }, "attr" => ["class" => "form-control"]])
            ->add("title", "text", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-md-3 mb-1"], "value" => function ($data) {
                return $data;
            }, "attr" => ["class" => "form-control"]])
            ->add("file", "file", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-md-3 mb-1" , "id" => "file_component" , "style" => "display:none"], "value" => function ($data) {
                return $data;
            }, "attr" => ["class" => "form-control"]])

            ->add("default", "textarea", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-md-12 mb-1" , "id" => "default_component" , "style" => "display:none"], "value" => function ($data) {
                return $data;
            }, "attr" => ["class" => "form-control"]])
            ->add('send', 'submit', ['wrapper' => ['class' => 'col-12'], 'attr' => ['name'=>'send','class' => 'btn btn-info btn-tall waves-effect waves-light']]);
    }
}
