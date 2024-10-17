<?php

/**
 * Actions are class for process
 */

namespace App\Actions\PageSetting;

use App\Repositories\PageSettingRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DeletePageSettingAction
{
    public PageSettingRepositoryEloquent $repository;


    public function __construct()
    {
        $this->repository = App::make(PageSettingRepositoryEloquent::class);
    }


    public function handle(Request $request)
    {
        $data = $this->repository->find($request->id) ;
        if (!empty($data->data) && count($data->data) > 0){
            throw new \Exception('رکورد مورد نظر دارای اطلاعات میباشد');
        }
        return $this->repository->delete($request->id);
    }
}
