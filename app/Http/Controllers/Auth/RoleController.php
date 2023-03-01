<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function allRoles()
    {
        try {
            $roles = Role::orderBy('id','DESC')->get();
            return response()->json([
                'roles' => $roles
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $permissions = Permission::get();

        return response()->json([
            'status' => true,
            'role' => $role,
            'rolePermissions' => $rolePermissions,
            'permissions' => $permissions,
            'message' => 'Role created successfully'
        ], 200);
    }

    public function createRole(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|unique:roles,name',
                'permissions' => 'required',
            ]);

            $role = Role::create(['name' => $request->name]);
            $role->syncPermissions($request->permissions);

            return response()->json([
                'status' => true,
                'message' => 'Role created successfully'
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateRole(Request $request, $id)
    {
        try {
            $role = Role::find($id);

            $request->validate([
                'name' => 'required',
                'permissions' => 'required',
            ]);

            $role->update(['name' => $request->name]);
            $role->syncPermissions($request->permissions);

            return response()->json([
                'status' => true,
                'message' => 'Role updated successfully'
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $role = Role::find($id);
            $role->delete();

            return response()->json([
                'status' => true,
                'message' => 'Role deleted successfully'
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
