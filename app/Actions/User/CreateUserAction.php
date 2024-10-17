<?php

/**
 * Actions are class for process
 */

namespace App\Actions\User;

use App\Actions\MetaTag\CreateMetaTagAction;
use App\Actions\MetaTag\FindMetaTagByTitleAction;
use App\Models\Category\ModelCategory;
use App\Models\MetaTag\ModelMetaTag;
use App\Repositories\NewsRepositoryEloquent;
use App\Repositories\UserRepositoryEloquent;
use App\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUserAction
{
    public $repository;


    public function __construct()
    {
        $this->repository = App::make(UserRepositoryEloquent::class);
    }


    public function handle(Request $request)
    {
        $data = $request->only([
            'first_name',
            'last_name',
            'username',
            'email',
            'phone',
        ]);
        $modelType = "App\\Models\\User";

        if (!empty($request->phone)) {
            $phone = Util::convertToEn($data['phone']);
            if ($phone[0] == '0') {
                $phone = '98' . substr($phone, 1);
            }
            $data['phone'] = $phone;
        }
        if ($request->has('avatar')) {
            $file = $request->avatar;
            $type = $file->getMimeType();
            $fileHash = str_replace('.' . $file->extension(), '', $file->hashName());
            $fileName = $fileHash . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('usersThumpAttachments', $fileName, 'uploads');

            $data['avatar'] = 'uploads/' . $path;
        }

        if ($request->password == $request->confirmed_password) {
            $data['password'] = Hash::make($request->password);
        } else {
            throw new \Exception('رمز عبور و تایید آن یکسان نمیباشد');
        }


        $user = $this->repository->create($data);

        if (!empty($request->roles) && count($request->roles) > 0) {
            foreach ($request->roles as $role) {
                $user->assignRole($role);
            }
        }
        if (!empty($request->permissions) && count($request->permissions) > 0) {
            foreach ($request->permissions as $item) {
                $user->givePermissionTo($item);
            }
        }

        return $user;
    }
}
