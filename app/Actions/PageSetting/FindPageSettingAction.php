<?php

/**
 * Actions are class for process
 */

namespace App\Actions\PageSetting;

use App\Repositories\PageSettingRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class FindPageSettingAction
{
    public PageSettingRepositoryEloquent $repository;


    public function __construct()
    {
        $this->repository = App::make(PageSettingRepositoryEloquent::class);
    }


    public function handle(Request $request)
    {
        return $this->repository->find($request->id);
    }
}
