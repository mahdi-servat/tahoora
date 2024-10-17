<?php

namespace App\Http\Controllers\web\Role;

use App\Actions\Attachment\CreateAttachmentAction;
use App\Actions\News\CreateNewsAction;
use App\Actions\News\DeleteNewsAction;
use App\Actions\News\FindNewsAction;
use App\Actions\News\GetAllNewsAction;
use App\Actions\News\UpdateNewsAction;
use App\Actions\Role\CreateRoleAction;
use App\Actions\Role\DeleteRoleAction;
use App\Actions\Role\FindRoleAction;
use App\Actions\Role\GetAllRoleAction;
use App\Actions\Role\UpdateRoleAction;
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
use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\DeleteRoleRequest;
use App\Http\Requests\Role\EditRoleRequest;
use App\Http\Requests\Role\GetAllRoleRequest;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\FindUserRequest;
use App\Http\Requests\User\GetAllUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Http\Request;
use Mmwdali\ContainerBuilder\Http\AutoWebController;

class RoleController extends AutoWebController
{
    public function getClass() : array
    {
        return [
            'indexRequest' => GetAllRoleRequest::class ,
            'createRequest' => CreateRoleRequest::class ,
            'editRequest' => EditRoleRequest::class ,
            'storeRequest' => StoreRoleRequest::class ,
            'updateRequest' => UpdateRoleRequest::class ,
            'deleteRequest' => DeleteRoleRequest::class ,
            'indexAction' => GetAllRoleAction::class ,
            'createAction' => CreateRoleAction::class ,
            'deleteAction' => DeleteRoleAction::class,
            'findAction' => FindRoleAction::class,
            'updateAction' => UpdateRoleAction::class,
            'form' => RoleForm::class,
            'viewPath' => 'admin.layouts.role',
            'routePrefix' => 'role',
            'list_title' => 'نقش ها',
            'add_title' => 'نقش',
        ];
    }
}
