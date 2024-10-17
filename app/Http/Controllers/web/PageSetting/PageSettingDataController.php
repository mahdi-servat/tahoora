<?php

namespace App\Http\Controllers\web\PageSetting;

use App\Actions\Language\GetAllLanguageAction;
use App\Actions\PageSetting\FindPageSettingAction;
use App\Actions\PageSetting\GetAllPageSettingAction;
use App\Actions\PageSetting\UpdatePageSettingDataAction;
use App\Http\Controllers\Controller;
use App\Models\PageSetting\PageSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class PageSettingDataController extends Controller
{
    public function chooseLanguage(Request $request): View
    {
        $languages = app(GetAllLanguageAction::class)->handle($request);

        return view('admin.layouts.page_setting_data.choose_language' , ['data' => $languages]);
    }


    public function index(Request $request): View
    {
        $titles = PageSetting::titleFilter()->get();
        $attachment = PageSetting::attachmentFilter()->get();

        return view('admin.layouts.page_setting_data.list' , ['titles' => $titles , 'attachments' => $attachment]);
    }

    public function edit(Request $request): View
    {
        $data = app(FindPageSettingAction::class)->handle($request);

        return view('admin.layouts.page_setting_data.create' , ['data' => $data]);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = app(UpdatePageSettingDataAction::class)->handle($request);
            DB::commit();
            return redirect(route('pageSettingData.index' ,['key' => $request->key]))->with('success', __('messages.success_message'));
        }catch (\Exception $e){
            DB::rollBack();

            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                $msg = 'messages.duplicate_entry';
            } else {
                $msg = $e->getMessage() . ' ' . $e->getLine();
            }
            return redirect()->back()->withInput()->with('error', __($msg));
        }
    }
}
