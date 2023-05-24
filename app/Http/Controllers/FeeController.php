<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $admin_role = Role::create(['guard_name' => $request->guard, 'name' => $request->role]);
        $permission = Permission::create(['guard_name' => $request->guard, 'name' =>$request->permission]);
        $admin_role->givePermissionTo($request->permission);
    }

}
