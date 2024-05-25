<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $permissions = Permission::get();
        return response()->json($permissions);
    }

}
