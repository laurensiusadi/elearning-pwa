<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Requests;
use App\User;
use Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.index', ['users' => $users]);
    }

    public function create()
    {
        return view('user.create');
    }

    protected function validator(array $data)
    {
        $unique = true;
        if (isset($data['update']) && $data['update'] == true) {
            $user = User::find($data['userid']);
            if ($user->email == $data['email']) {
                $unique = false;
            }
        }

        if ($unique == false) {
            $validation = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed',
            'nomorinduk' => 'required',
            ];
        } else {
            $validation = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'nomorinduk' => 'required',
            ];
        }
        return Validator::make($data, $validation);
    }

    public function store(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
                );
        }

        // input biasa
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->nomorinduk = $request->nomorinduk;
        $user->save();

        return redirect('user')->with('message', 'Pengguna baru berhasil ditambahkan');
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            abort('404');
        }

        return view('user.single')->with('user', $user);
    }

    public function edit($id)
    {
        $user = User::find($id);

        if (!$user) {
            abort('404');
        }

        return view('user.edit')->with('user', $user);
    }

    public function update(Request $request, $id)
    {
        $request['update'] = true;
        $request['userid'] = $id;
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
                );
        }

        // input biasa
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->nomorinduk = $request->nomorinduk;
        $user->save();
        return redirect('user')->with('message', 'Pengguna berhasil diupdate');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        try {
            $user->delete();
        } catch (QueryException $e) {
            return redirect('user')->with('error', 'Pengguna gagal dihapus, data masih direferensikan');
        }

        return redirect('user')->with('message', 'Pengguna berhasil dihapus');
    }
}
