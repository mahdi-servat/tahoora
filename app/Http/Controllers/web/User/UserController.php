<?php

namespace App\Http\Controllers\web\User;

use App\Actions\Attachment\CreateAttachmentAction;
use App\Actions\News\CreateNewsAction;
use App\Actions\News\DeleteNewsAction;
use App\Actions\News\FindNewsAction;
use App\Actions\News\GetAllNewsAction;
use App\Actions\News\UpdateNewsAction;
use App\Actions\User\CreateUserAction;
use App\Actions\User\DeleteUserAction;
use App\Actions\User\FindUserAction;
use App\Actions\User\GetAllUserAction;
use App\Actions\User\UpdateUserAction;
use App\Http\Requests\News\CreateNewsRequest;
use App\Http\Requests\News\DeleteNewsRequest;
use App\Http\Requests\News\FindNewsRequest;
use App\Http\Requests\News\GetAllNewsRequest;
use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\FindUserRequest;
use App\Http\Requests\User\GetAllUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserProfileRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mmwdali\ContainerBuilder\Http\AutoWebController;

class UserController extends AutoWebController
{
    public function getClass() : array
    {
        return [
            'indexRequest' => GetAllUserRequest::class ,
            'createRequest' => CreateUserRequest::class ,
            'editRequest' => FindUserRequest::class ,
            'storeRequest' => StoreUserRequest::class ,
            'updateRequest' => UpdateUserRequest::class ,
            'deleteRequest' => DeleteUserRequest::class ,
            'indexAction' => GetAllUserAction::class ,
            'createAction' => CreateUserAction::class ,
            'deleteAction' => DeleteUserAction::class,
            'findAction' => FindUserAction::class,
            'updateAction' => UpdateUserAction::class,
            'form' => UserForm::class,
            'viewPath' => 'admin.layouts.user',
            'routePrefix' => 'user',
            'list_title' => 'کاربران',
            'add_title' => 'کاربر',
        ];
    }


    public function profileShow(Request $request)
    {
        $props = $this->props;

        $data = auth()->user();

        $form = $this->formBuilder->create(UserProfileForm::class, [
            'method' => 'POST',
            'class' => 'form row',
            'url' => route('user.profile.update'),
            'model' => $data,
            'enctype' => 'multipart/form-data',
            'data' => []
        ]);

        return view('admin.layouts.user.create', compact('form', 'data', 'props'));
    }

    public function profileUpdate(UpdateUserProfileRequest $request)
    {
        DB::beginTransaction();
        try {
            DB::commit();
            $data = app(UpdateUserAction::class)->handle($request, auth()->user()->id);
            return redirect()->back()->with('success', __('messages.success_message'));
        } catch (\Exception $e) {
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                $msg = 'messages.duplicate_entry';
            } else {
                $msg = $e->getMessage() . ' ' . $e->getLine();
            }
            return redirect()->back()->withInput()->with('error', __($msg));
        }
    }
}
