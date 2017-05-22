<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\RoleUser;
use App\User;
use Kodeine\Acl\Models\Eloquent\Role;
use DB;

class RoleUserController extends Controller
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
        $user = User::find($id);

        $roles = DB::table('roles')
        ->leftJoin('role_user', function ($join) use ($id) {
            $join->on('role_user.role_id', '=', 'roles.id');
            $join->on('role_user.user_id', '=', DB::raw($id));
        })
        ->select('roles.*', 'role_user.user_id')
        ->get();

        return view('roleuser.single', ['roles' => $roles, 'userid' => $id, 'username' => $user->name, 'nomorinduk' => $user->nomorinduk]);
    }

    public function edit($id)
    {
        $user = User::find($id);

        $roles = DB::table('roles')
        ->leftJoin('role_user', function ($join) use ($id) {
            $join->on('role_user.role_id', '=', 'roles.id');
            $join->on('role_user.user_id', '=', DB::raw($id));
        })
        ->select('roles.*', 'role_user.user_id')
        ->get();

        return view('roleuser.edit', ['roles' => $roles, 'userid' => $id, 'username' => $user->name]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        foreach ($request['roles_id'] as $role_id) {
            if (!empty($request['data::'.$role_id])) {
                $user->assignRole($role_id);
            } elseif (empty($request['data::'.$role_id])) {
                $user->revokeRole($role_id);
            } else {
                return redirect('roleuser/'.$id)->with('error', 'Role tidak terupdate');
            }
        }
        return redirect('roleuser/'.$id)->with('message', 'Role berhasil diupdate');
    }

    public function destroy($id)
    {
        //
    }
}
