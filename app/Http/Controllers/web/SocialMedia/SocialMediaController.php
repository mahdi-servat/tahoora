<?php

namespace App\Http\Controllers\web\SocialMedia;

use App\Actions\Language\GetAllLanguageAction;
use App\Actions\SocialMedia\FindSocialMediaAction;
use App\Actions\SocialMedia\GetAllSocialMediaAction;
use App\Actions\SocialMedia\GetAllSocialMediaByLanguageAction;
use App\Actions\SocialMedia\UpdateSocialMediaAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SocialMediaController extends Controller
{
    public function chooseLanguage(Request $request): View
    {
        $languages = app(GetAllLanguageAction::class)->handle($request);

        return view('admin.layouts.social_media.choose_language' , ['data' => $languages]);
    }


    public function index(Request $request): View
    {
        $data = app(GetAllSocialMediaAction::class)->handle($request );

        return view('admin.layouts.social_media.list' , ['data' => $data]);
    }

    public function edit(Request $request): View
    {
        $data = app(FindSocialMediaAction::class)->handle($request);

        return view('admin.layouts.social_media.create' , ['data' => $data]);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = app(UpdateSocialMediaAction::class)->handle($request);
            DB::commit();
            return redirect(route('socialMedia.index' ,['key' => $request->key]))->with('success', __('messages.success_message'));
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
