<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Role;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UpdateRoleAction
{
    public function handle(Request $request, $id)
    {
        $data = $request->only([
            'display_name',
        ]);
        $data['guard_name'] = 'web';
        $data['name'] = $request->name_en;

        $role = Role::find($id);

        $role->update($data);

        foreach ($role->permissions as $item) {
            $role->revokePermissionTo($item->id);
        }

        foreach ($request->permissions as $item) {
            $permission = $role->givePermissionTo($item);
        }

        return $role;
    }
}
