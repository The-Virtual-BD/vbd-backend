<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function allPermissions()
    {
        $permissions = Permission::all();
        try {
            return response()->json([
                'status' => true,
                'permissions' => $permissions,
                'message' => 'This is all permission we have.'
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createPermission(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|unique:permissions,name'
            ]);

            $permission = Permission::create(['name' => $request->name]);

            return response()->json([
                'status' => true,
                'message' => 'Permission created successfully'
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);

        return response()->json([
            'status' => true,
            'permission' => $permission,
            'message' => 'Role created successfully'
        ], 200);
    }

    public function updatePermission(Request $request, $id)
    {
        try {
            $permission = Permission::find($id);

            $request->validate([
                'name' => 'required',
            ]);

            $permission->update(['name' => $request->name]);

            return response()->json([
                'status' => true,
                'message' => 'Permission updated successfully'
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Request $request, $id)
    {
        $permission = Permission::find($id);
        $permission->delete();

        return response()->json([
            'status' => true,
            'message' => 'Permission deleted successfully'
        ], 200);
    }
}
