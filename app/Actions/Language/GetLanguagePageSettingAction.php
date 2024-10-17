<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Language;

use App\Models\Language\Language;
use App\Repositories\LanguageRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GetLanguagePageSettingAction
{
	public LanguageRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(LanguageRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
        $language = Language::where('key' , $request->key)->first();

        $language->load('pageSetting');

        $pageSetting = array();

//        dd($language->pageSetting);
        foreach ($language->pageSetting as $item){
            if (!empty($item->pivot) && !empty($item->pivot->content)){
                $pageSetting[$item->key] = $this->changeContent($item->page_setting_type_id , $item->pivot->content);
            }else{
                $pageSetting[$item->key] = $this->changeContent($item->page_setting_type_id , $item->default);
            }
        }

        return $pageSetting;
	}


    public function changeContent($typeId , $value)
    {
        if ($typeId == 2){
            return env('APP_URL') . '/' . $value ;
        }else{
            return $value;
        }
    }
}
