<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Requests;
use Kodeine\Acl\Models\Eloquent\Role;
use Kodeine\Acl\Models\Eloquent\Permission;
use App\PermissionRole;
use DB;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('role.index', ['roles' => $roles]);
    }

    public function create()
    {
        return view('role.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            ]);

        // input biasa
        $role = new Role;
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->description = $request->description;
        $role->save();

        $permissions = DB::table('permissions')
        ->whereNull('inherit_id')
        ->get();

        foreach ($permissions as $permission) {
            $newperm = new Permission();
            $newperm->create([
                'inherit_id'  => $permission->id,
                'name'        => $permission->name.'.'.$role->slug,
                'slug'        => [          // pass an array of permissions.
                'create'     => false,
                'view'       => false,
                'update'     => false,
                'delete'     => false
                ],
                'description' => $permission->description.' for '.$role->slug
                ]);
            $lastperm = DB::table('permissions')
            ->where('id', DB::raw("(select max(id) from permissions)"))
            ->select('id')
            ->first();

            $permrole = new PermissionRole;
            $permrole->permission_id = $lastperm->id;
            $permrole->role_id = $role->id;
            $permrole->save();
        }

        return redirect('role')->with('message', 'Role baru berhasil ditambahkan');
    }

    public function show($id)
    {
        $role = Role::find($id);

        if(!$role) {
            abort('404');
        }

        return view('role.single')->with('role', $role);
    }

    public function edit($id)
    {
        $role = Role::find($id);

        if(!$role) {
            abort('404');
        }

        return view('role.edit')->with('role', $role);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            ]);

        // input biasa
        $role = Role::find($id);
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->description = $request->description;
        $role->save();

        return redirect('role')->with('message', 'Role berhasil diupdate');
    }

    public function destroy($id)
    {
        $role = Role::find($id);

        try {
            $role->delete();
        } catch (QueryException $e) {
            return redirect('role')->with('error', 'Role gagal dihapus, data masih direferensikan');
        }

        DB::table('permissions')->where('name', 'like', '%'.$role->slug)->delete();

        return redirect('role')->with('message', 'Role berhasil dihapus');
    }
}
