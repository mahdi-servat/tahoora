<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Language;


use App\Repositories\LanguageRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CreateLanguageAction
{
    public $repository;


    public function __construct()
    {
        $this->repository = App::make(LanguageRepositoryEloquent::class);
    }


    public function handle(Request $request)
    {
        $data = $request->only([
            'title',
            'key',
            'active',
            'rtl'
        ]);

        return $this->repository->create($data);
    }
}
