<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Traits\Error;
use App\Traits\Helpers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    use Error, Helpers;
    public function index(Request $request)
    {
        if($this->can('role-all')) {
            return response()->json(['message'=>"Permission denied!"],403);
        }
        $roles = Role::with('permissions')->whereNot('name','super-admin')->get();
        return response()->json($roles);
    }

    public function store(Request $request)
    {
        if($this->can('role-create')) {
            return response()->json(['message'=>"Permission denied!"],403);
        }
        try {
            $validated = $request->validate([
                'name' => ['required', 'unique:roles,name'],
            ]);

            $role = new Role();
            $role->name = $request->name;
            $role->save();

            if (isset($request->permissions) && is_array($request->permissions)) {
                $role->permissions()->sync($request->permissions);
            }
            return response()->json($role);
        } catch (\Exception $error) {
            return $this->errorResponse($error);
        }
    }

    public function update(Request $request, Role $role)
    {
        if($this->can('role-edit')) {
            return response()->json(['message'=>"Permission denied!"],403);
        }
        try {
            $validated = $request->validate([
                'name' => [
                    'required',
                    Rule::unique('roles')->ignore($request->id),
                ],
            ]);
            if (!$role) {
                throw new \Exception('Error|Role not found--404', 13333);
            }
            if ($role->name === 'super-admin') {
                throw new \Exception(
                    'Error|Super admin role can\'t be updated--404',
                    13333
                );
            }

            foreach ($validated as $key => $val) {
                $role->{$key} = $val;
            }
            $role->save();

            if (isset($request->permissions) && is_array($request->permissions)) {
                $role->permissions()->sync($request->permissions);
            }
            return response()->json($role);
        } catch (\Exception $error) {
            return $this->errorResponse($error);
        }
    }

    public function destroy(Role $role)
    {
        if($this->can('role-delete')) {
            return response()->json(['message'=>"Permission denied!"],403);
        }
        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }
        $role->delete();
        return response()->json(['message' => 'Role deleted successfully'], 200);
    }
}
