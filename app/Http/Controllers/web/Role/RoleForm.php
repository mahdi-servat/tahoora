<?php

namespace App\Http\Controllers\web\Role;

use App\Repositories\CategoryRepositoryEloquent;
use App\Repositories\LanguageRepositoryEloquent;
use App\Util;
use Kris\LaravelFormBuilder\Form;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleForm extends Form
{
    protected $formOptions = [
        'language_name' => 'validation.attributes',
    ];

    public function buildForm()
    {
        $this
            ->add("name_en", "text", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-md-3 mb-1"], "value" => function ($data) {
                if (!empty($this->model->name)){
                    return $this->model->name;
                }
                return $data;
            }, "attr" => ["class" => "form-control"]])
            ->add("display_name", "text", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-md-3 mb-1"], "value" => function ($data) {
                return $data;
            }, "attr" => ["class" => "form-control"]])
            ->add("permissions", "entity", [
                "label_attr" => ["class" => "form-label"],
                "wrapper" => ["class" => "col-12 col-sm-6 col-md-3 form-group"],
                "attr" => ["class" => "form-control select2", "multiple" => "multiple"],
                "class" => "Spatie\Permission\Models\Permission",
                "property" => "display_name",
                "property_key " => "id",
//                "empty_value" => __("validation.attributes.choose"),
                "selected" => function () {
                    $id = [];
                    if (!empty($this->model->permissions) && count($this->model->permissions) > 0) {
                        foreach ($this->model->permissions->toArray() as $item) {
                            array_push($id, $item['id']);
                        }
                    }
                    return $id;
                },
                "query_builder" => function () {
                    return Permission::all();
                }
            ])
            ->add('send', 'submit', ['wrapper' => ['class' => 'col-12'], 'attr' => ['name'=>'send','class' => 'btn btn-info btn-tall waves-effect waves-light']]);
    }
}
