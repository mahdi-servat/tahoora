<?php

namespace App\Http\Controllers\web\Category;

use App\Models\Category\CategoryType;
use App\Repositories\CategoryRepositoryEloquent;
use App\Repositories\LanguageRepositoryEloquent;
use Kris\LaravelFormBuilder\Form;

class CategoryForm extends Form
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
                "property_key" => "id",
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
            ->add("category_type_id", "entity", [
                "label_attr" => ["class" => "form-label"],
                "wrapper" => ["class" => "col-12 col-sm-6 col-md-3 form-group"],
                "attr" => ["class" => "form-control select2" ],
                "class" => "App\Models\Category\CategoryType",
                "property" => "title",
                "property_key " => "id",
                "empty_value" => __("validation.attributes.choose"),
                "selected" => function () {
                    return !empty($this->model) && !empty($this->model->category_type_id) ? $this->model->category_type_id : null;
                },
                "query_builder" => function () {
                    return CategoryType::all();
                }
            ])
            ->add("parent_id", "entity", [
                "label_attr" => ["class" => "form-label"],
                "wrapper" => ["class" => "col-12 col-sm-6 col-md-3 form-group"],
                "attr" => ["class" => "form-control select2" , 'disabled'],
                "class" => "App\Models\Category\Category",
                "property" => "title",
                "property_key " => "id",
                "empty_value" => __("validation.attributes.choose"),
                "selected" => function () {
                    return !empty($this->model) && !empty($this->model->parent_id) ? $this->model->parent_id : null;
                },
                "query_builder" => function () {
                    return app(CategoryRepositoryEloquent::class)->all();
                }
            ])
            ->add('send', 'submit', ['wrapper' => ['class' => 'col-12 mt-2'], 'attr' => ['name'=>'send','class' => 'btn btn-info btn-tall waves-effect waves-light']]);
    }
}
