<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\PermissionUser;
use App\User;
use Kodeine\Acl\Models\Eloquent\Permission;
use DB;

class PermissionUserController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $permissions = DB::table('permissions')
                        ->leftJoin('permission_role', function ($join) use ($id) {
                            $join->on('permission_role.permission_id', '=', 'permissions.id');
                            $join->on('permission_role.role_id', '=', DB::raw($id));
                        })
                        ->select('permissions.*', 'permission_role.role_id')
                        ->get();

        return view('permissionuser.edit', ['permissions' => Permission::hydrate($permissions), 'roleid' => $id]);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
