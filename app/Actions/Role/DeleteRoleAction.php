<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Role;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DeleteRoleAction
{
    public function handle(Request $request)
    {
        $role = Role::find($request->id);
        return $role->delete();
    }
}
