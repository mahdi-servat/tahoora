<?php

namespace App\Http\Controllers\web\User;

use App\Repositories\CategoryRepositoryEloquent;
use App\Repositories\LanguageRepositoryEloquent;
use App\Util;
use Kris\LaravelFormBuilder\Form;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserProfileForm extends Form
{
    protected $formOptions = [
        'language_name' => 'validation.attributes',
    ];

    public function buildForm()
    {
        $this
            ->add("first_name", "text", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-md-3 mb-1"], "value" => function ($data) {
                return $data;
            }, "attr" => ["class" => "form-control"]])
            ->add("last_name", "text", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-md-3 mb-1"], "value" => function ($data) {
                return $data;
            }, "attr" => ["class" => "form-control"]])
            ->add("username", "text", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-md-3 mb-1"], "value" => function ($data) {
                return $data;
            }, "attr" => ["class" => "form-control"]])
            ->add("email", "text", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-md-3 mb-1"], "value" => function ($data) {
                return $data;
            }, "attr" => ["class" => "form-control"]])
            ->add("phone", "text", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-md-3 mb-1"], "value" => function ($data) {
                return $data;
            }, "attr" => ["class" => "form-control"]])
            ->add("avatar", "file", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-md-3 mb-1"], "value" => function ($data) {
                return $data;
            }, "attr" => ["class" => "form-control col-12  mb-1 "]])
            ->add("password", "password", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-md-3 mb-1"], "value" => function ($data) {
                if (!empty($data)){
                    return '*****';
                }
                return $data;
            }, "attr" => ["class" => "form-control col-12  mb-1 "]])

            ->add("confirmed_password", "password", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-md-3 mb-1"], "value" => function ($data) {
                if (!empty($this->model->password)){
                    return '*****';
                }
                return $data;
            }, "attr" => ["class" => "form-control col-12  mb-1 "]])
            ->add('send', 'submit', ['wrapper' => ['class' => 'col-12'], 'attr' => ['name'=>'send','class' => 'btn btn-info btn-tall waves-effect waves-light']]);
    }
}
