<?php

/**
 * Actions are class for process
 */

namespace App\Actions\PageSetting;

use App\Repositories\PageSettingRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CreatePageSettingAction
{
	public PageSettingRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(PageSettingRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
        $data = $request->only([
            'key',
            'title',
            'default',
            'page_setting_type_id',
        ]);

        if($request->page_setting_type_id == 2){
            if(empty($request->file)){
                throw new \Exception('فایل را بارگذاری کنید');
            }
            $file = $request->file;
            $type = $file->getMimeType();
            $fileHash = str_replace('.' . $file->extension(), '', $file->hashName());
            $fileName = $fileHash . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('pageSetting', $fileName, 'uploads');
            $data['default'] = 'uploads/' . $path;
        }


        return $this->repository->create($data);
	}
}
