<?php

/**
 * Actions are class for process
 */

namespace App\Actions\PageSetting;

use App\Models\Language\Language;
use App\Models\PageSetting\PageSetting;
use App\Models\PageSetting\PageSettingData;
use App\Repositories\PageSettingRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;

class UpdatePageSettingDataAction
{
	public PageSettingRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(PageSettingRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
        $language = Language::where('key' , $request->key)->first();
        if (!empty($request->page_setting) && count($request->page_setting) > 0){
            foreach ($request->page_setting as $key => $val){
                $pageSetting = PageSetting::find($key);
                if (!empty($val) && $val instanceof UploadedFile){
                    $type = $val->getMimeType();
                    $fileHash = str_replace('.' . $val->extension(), '', $val->hashName());
                    $fileName = $fileHash . '.' . $val->getClientOriginalExtension();
                    $path = $val->storeAs('pageSetting', $fileName, 'uploads');
                    $content = 'uploads/' . $path;

                    PageSettingData::updateOrCreate([
                        'page_setting_id' => $key,
                        'language_id' => $language->id,
                        'page_setting_type_id' => $pageSetting->page_setting_type_id
                    ] , [
                        'content' => $content
                    ]);
                }else if(!empty($val)){
                    PageSettingData::updateOrCreate([
                        'page_setting_id' => $key,
                        'language_id' => $language->id,
                        'page_setting_type_id' => $pageSetting->page_setting_type_id
                    ] , [
                        'content' => $val
                    ]);
                }
            }
        }else{
            throw new \Exception('عملیات با خطا مواجه شد');
        }
	}
}
