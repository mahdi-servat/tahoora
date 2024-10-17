<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Role;

use App\Repositories\NewsRepositoryEloquent;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Spatie\Permission\Models\Role;

class FindRoleAction
{
	public function handle(Request $request)
	{
	    return Role::find($request->id);
	}
}
