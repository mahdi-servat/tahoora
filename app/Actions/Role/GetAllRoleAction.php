<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Role;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class GetAllRoleAction
{
	public function handle(Request $request , $paginate = true)
	{
	    return Role::paginate();
	}
}
