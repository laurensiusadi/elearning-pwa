<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Kodeine\Acl\Models\Eloquent\Permission;
use DB;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::whereNull('inherit_id')->get();

        return view('permission.index', ['permissions' => $permissions]);
    }

    public function create()
    {
        return view('permission.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            ]);

        // input biasa
        $permission = new Permission();
        $permission->create([
            'name'        => $request->name,
            'slug'        => [          // pass an array of permissions.
            'create'     => !empty($request->create) ? true : false,
            'view'       => !empty($request->view) ? true : false,
            'update'     => !empty($request->update) ? true : false,
            'delete'     => !empty($request->delete) ? true : false
            ],
            'description' => $request->description
            ]);

        return redirect('permission')->with('message', 'Permission baru berhasil ditambahkan');
    }

    public function show($id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            abort('503');
        }

        return view('permission.single')->with('permission', $permission);
    }

    public function edit($id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            abort('503');
        }

        return view('permission.edit')->with('permission', $permission);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            ]);

        // input biasa
        $permission = Permission::find($id);
        $permission->update([
            'name'        => $request->name,
            'slug'        => [          // pass an array of permissions.
            'create'     => !empty($request->create) ? true : false,
            'view'       => !empty($request->view) ? true : false,
            'update'     => !empty($request->update) ? true : false,
            'delete'     => !empty($request->delete) ? true : false
            ],
            'description' => $request->description
            ]);

        return redirect('permission')->with('message', 'Permission berhasil diupdate');
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);
        try {
            $permission->delete();
        } catch (QueryException $e) {
            return redirect('permission')->with('error', 'Permission gagal dihapus, data masih direferensikan');
        }

        return redirect('permission')->with('message', 'Permission berhasil dihapus');
    }
}
