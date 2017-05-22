<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\QueryException;
use Auth;
use App\Http\Requests;
use App\Enrollment;
use App\Classroom;
use App\User;
use DB;

class EnrollController extends Controller
{
    public function index()
    {
        $enrolls = DB::table('elearningnew.enrollment')
        ->leftJoin('elearningnew.classroom', 'elearningnew.classroom.id', '=', 'elearningnew.enrollment.classroom_id')
        ->select('elearningnew.classroom.*', 'elearningnew.enrollment.id as enroll_id')
        ->where('elearningnew.enrollment.user_id', '=', Auth::id())
        ->get();

        return view('enroll.index', ['enrolls' => $enrolls]);
    }

    public function create()
    {
        //
    }

    public function store($request)
    {
        // input biasa
        $enroll = new Enrollment;
        $enroll->classroom_id = $request['classroom_id'];
        $enroll->user_id = $request['user_id'];
        $enroll->save();
    }

    public function show($id)
    {
        $classroom = Classroom::find($id);
        $enrolls = $classroom->enrolls;
        $users = User::latest()->get();

        return view('enroll.single', compact('classroom','enrolls','users'));
    }

    public function edit($id)
    {
        $classroom = Classroom::find($id);

        $enrolls = DB::table('users')
        ->leftJoin('elearningnew.enrollment', function ($join) use ($id) {
            $join->on('elearningnew.enrollment.user_id', '=', 'users.id');
            $join->on('elearningnew.enrollment.classroom_id', '=', DB::raw($id));
        })
        ->leftJoin('elearningnew.classroom', 'elearningnew.classroom.id', '=', 'elearningnew.enrollment.classroom_id')
        ->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
        ->leftJoin('roles', 'roles.id', '=', 'role_user.role_id')
        ->select('users.nomorinduk as nomorinduk', 'users.name as namauser', 'users.email', 'roles.name as namarole', 'elearningnew.enrollment.id', 'users.id as userid')
        ->get();

        return view('enroll.edit', ['enrolls' => Enrollment::hydrate($enrolls), 'classroom' => $classroom]);
    }

    public function update(Request $request, $id)
    {
        foreach ($request['user_id'] as $user_id) {
            $isexist = DB::table('elearningnew.enrollment')
            ->select('id')
            ->where('user_id', '=', $user_id)
            ->where('classroom_id', '=', $id)
            ->first();

            $record = array();
            $record['classroom_id'] = $id;
            $record['user_id'] = $user_id;

            if (!empty($request['data::'.$user_id]) && empty($isexist)) {
                self::store($record);
            } elseif (empty($request['data::'.$user_id]) && !empty($isexist)) {
                $err = self::destroy($isexist->id);
                if ($err) {
                    return redirect('enroll/'.$id)->with('error', 'Enrollment gagal dihapus, data masih direferensikan');
                }
            }
        }

        return redirect('enroll/'.$id)->with('message', 'Enrollment berhasil diupdate');
    }

    public function destroy($id)
    {
        $enroll = Enrollment::find($id);

        try {
            $enroll->delete();
        } catch (QueryException $e) {
            return true;
        }

        return false;
    }
}
