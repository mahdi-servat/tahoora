<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Role;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class CreateRoleAction
{
    public function handle(Request $request)
    {
        $data = $request->only([
            'display_name',
        ]);
        $data['guard_name'] = 'web';
        $data['name'] = $request->name_en;

        $role = Role::create($data);
        foreach ($request->permissions as $item) {
            $permission = $role->givePermissionTo($item);
        }

        return $role;
    }
}
