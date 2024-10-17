<?php

namespace App\Http\Controllers\web\Artist;

use App\Models\Category\Category;
use App\Models\Museum\Museum;
use App\Models\Status;
use App\Repositories\LanguageRepositoryEloquent;
use Kris\LaravelFormBuilder\Form;

class ArtistForm extends Form
{
    protected $formOptions = [
        'language_name' => 'validation.attributes',
    ];

    public function buildForm()
    {
        $this
            ->add("language_id", "entity", [
                "label_attr" => ["class" => "form-label d-block"],
                "wrapper" => ["class" => "col-12 col-sm-4 col-md-4 mb-1 form-group"],
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
            ->add("status_id", "entity", [
                "label_attr" => ["class" => "form-label"],
                "wrapper" => ["class" => "col-12 col-sm-4 col-md-4 form-group"],
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
            ->add("title", "text", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-sm-4 col-md-4 mb-1"], "value" => function ($data) {
                return $data;
            }, "attr" => ["class" => "form-control"]])
            ->add("thump", "file", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-md-4 mb-1"], "value" => function ($data) {
                return $data;
            }, "attr" => ["class" => "form-control col-12 col-md-3 mb-1 "]])
            ->add("services", "entity", [
                "label_attr" => ["class" => "form-label"],
                "wrapper" => ["class" => "col-12 col-sm-6 col-md-4 form-group"],
                "attr" => ["class" => "form-control select2", "multiple" => "multiple"],
                "class" => "App\Models\Museum\Museum",
                "property" => "title",
                "property_key " => "id",
                "selected" => function () {
                    $id = [];
                    if (!empty($this->model->museums) && count($this->model->museums) > 0) {
                        foreach ($this->model->museums as $item) {
                            $id[] = $item->museum_id;
                        }
                    }
                    return $id;
//                    return !empty($this->model) && !empty($this->model->category) ? $this->model->category->id : null;
                },
                "query_builder" => function () {
                    return Museum::all();
                }
            ])
            ->add("category_id", "entity", [
                "label_attr" => ["class" => "form-label"],
                "wrapper" => ["class" => "col-12 col-sm-6 col-md-4 form-group"],
                "attr" => ["class" => "form-control select2", 'disabled'],
                "class" => "App\Models\Category\Category",
                "property" => "title",
                "property_key " => "id",
                "empty_value" => __("validation.attributes.choose"),
                "selected" => function () {
                    return !empty($this->model) && !empty($this->model->category) ? $this->model->category->id : null;
                },
                "query_builder" => function () {
                    return Category::where('category_type_id', 4)->get();
                }
            ])
            ->add("summary", "textarea", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-md-12 mb-1"], "value" => function ($data) {
                return $data;
            }, "attr" => ["class" => "form-control ck"]])
            ->add("content", "textarea", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-md-12 mb-1"], "value" => function ($data) {
                return $data;
            }, "attr" => ["class" => "form-control ck"]])
            ->add('send', 'submit', ['wrapper' => ['class' => 'col-12 mt-2'], 'attr' => ['name' => 'send', 'class' => 'btn btn-info btn-tall waves-effect waves-light']])
        ;
    }
}
