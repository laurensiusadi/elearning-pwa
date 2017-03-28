<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\QueryException;
use Auth;
use App\Http\Requests;
use App\Enrollment;
use App\Course;
use DB;

class EnrollController extends Controller
{
    public function index()
    {
        $enrolls = DB::table('elearning.enrollment')
        ->leftJoin('elearning.kursus', 'elearning.kursus.id', '=', 'elearning.enrollment.kursus_id')
        ->select('elearning.kursus.*', 'elearning.enrollment.id as enrole_id')
        ->where('elearning.enrollment.user_id', '=', Auth::id())
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
        $enroll->kursus_id = $request['kursus_id'];
        $enroll->user_id = $request['user_id'];
        $enroll->save();
    }

    public function show($id)
    {
        $course = Course::find($id);

        $enrolls = DB::table('users')
        ->leftJoin('elearning.enrollment', function ($join) use ($id) {
            $join->on('elearning.enrollment.user_id', '=', 'users.id');
            $join->on('elearning.enrollment.kursus_id', '=', DB::raw($id));
        })
        ->leftJoin('elearning.kursus', 'elearning.kursus.id', '=', 'elearning.enrollment.kursus_id')
        ->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
        ->leftJoin('roles', 'roles.id', '=', 'role_user.role_id')
        ->select('users.nomorinduk as nomorinduk', 'users.name as namauser', 'users.email', 'roles.name as namarole', 'elearning.enrollment.id', 'users.id as userid')
        ->get();

        return view('enroll.single', ['enrolls' => Enrollment::hydrate($enrolls), 'course' => $course]);
    }

    public function edit($id)
    {
        $course = Course::find($id);

        $enrolls = DB::table('users')
        ->leftJoin('elearning.enrollment', function ($join) use ($id) {
            $join->on('elearning.enrollment.user_id', '=', 'users.id');
            $join->on('elearning.enrollment.kursus_id', '=', DB::raw($id));
        })
        ->leftJoin('elearning.kursus', 'elearning.kursus.id', '=', 'elearning.enrollment.kursus_id')
        ->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
        ->leftJoin('roles', 'roles.id', '=', 'role_user.role_id')
        ->select('users.nomorinduk as nomorinduk', 'users.name as namauser', 'users.email', 'roles.name as namarole', 'elearning.enrollment.id', 'users.id as userid')
        ->get();

        return view('enroll.edit', ['enrolls' => Enrollment::hydrate($enrolls), 'course' => $course]);
    }

    public function update(Request $request, $id)
    {
        foreach ($request['user_id'] as $user_id) {
            $isexist = DB::table('elearning.enrollment')
            ->select('enrollment.id')
            ->where('user_id', '=', $user_id)
            ->where('kursus_id', '=', $id)
            ->first();

            $record = array();
            $record['kursus_id'] = $id;
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
