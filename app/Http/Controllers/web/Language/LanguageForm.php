<?php

namespace App\Http\Controllers\web\Language;

use Kris\LaravelFormBuilder\Form;

class LanguageForm extends Form
{
    protected $formOptions = [
        'language_name' => 'validation.attributes',
    ];

    public function buildForm()
    {
        $this
            ->add("title", "text", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-md-4 mb-1"], "value" => function ($data) {
                return $data;
            }, "attr" => ["class" => "form-control"]])
            ->add("key", "text", ["label_attr" => ["class" => "form-label"], "wrapper" => ["class" => "col-12 col-md-4 mb-1"], "value" => function ($data) {
                return $data;
            }, "attr" => ["class" => "form-control"]])
            ->add('send', 'submit', ['wrapper' => ['class' => 'col-12'], 'attr' => ['name'=>'send','class' => 'btn btn-info btn-tall waves-effect waves-light mt-2']]);
    }
}
