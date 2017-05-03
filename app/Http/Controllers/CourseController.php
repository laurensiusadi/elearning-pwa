<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\QueryException;
use App\Http\Requests;
use App\Course;
use App\Period;
use App\Subject;
use DB;

class CourseController extends Controller
{
    public function index()
    {
        // $courses = DB::table('elearning.kursus as k')
        // ->join('elearning.periode as p', 'p.id', '=', 'k.periode_id')
        // ->join('elearning.matakuliah as m', 'm.id', '=', 'k.mk_id')
        // ->select('k.*', 'p.nama as namaperiode', 'm.nama as namamatakuliah')
        // ->get();

        $courses = Course::all();

        return view('course.index', ['courses' => $courses]);
    }

    public function create()
    {
        $periods = Period::all();
        $subjects = Subject::all();

        return view('course.create', ['periods' => $periods, 'subjects' => $subjects]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'periode_id' => 'required',
            'mk_id' => 'required',
            'nama' => 'required',
            ]);

        // input biasa
        $course = new Course;
        $course->periode_id = $request->periode_id;
        $course->mk_id = $request->mk_id;
        $course->nama = $request->nama;
        $course->type = $request->type;
        $course->save();

        if (!file_exists($course->id)) {
            mkdir('kumpulan_sourcecode/'.$course->id);
        }

        return redirect('course')->with('message', 'Kursus baru berhasil ditambahkan');
    }

    public function show($id)
    {
        $course = DB::table('elearning.kursus as k')
        ->join('elearning.periode as p', 'p.id', '=', 'k.periode_id')
        ->join('elearning.matakuliah as m', 'm.id', '=', 'k.mk_id')
        ->select('k.*', 'p.nama as namaperiode', 'm.nama as namamatakuliah')
        ->where('k.id', '=', $id)
        ->get();

        if (!$course) {
            abort('404');
        }

        return view('course.single')->with('course', $course);
    }

    public function edit($id)
    {
        $course = Course::find($id);
        $periods = Period::all();
        $subjects = Subject::all();

        if (!$course) {
            abort('404');
        }

        return view('course.edit', ['periods' => $periods, 'subjects' => $subjects, 'course' => $course]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'periode_id' => 'required',
            'mk_id' => 'required',
            'nama' => 'required',
            ]);

        // input biasa
        $course = Course::find($id);
        $course->periode_id = $request->periode_id;
        $course->mk_id = $request->mk_id;
        $course->nama = $request->nama;
        $course->save();

        return redirect('course')->with('message', 'Kursus berhasil diupdate');
    }

    public function destroy($id)
    {
        $course = Course::find($id);

        try {
            $course->delete();
        } catch (QueryException $e) {
            return redirect('course')->with('error', 'Kursus gagal dihapus, data masih direferensikan');
        }

        if (file_exists($id)) {
            $status = rmdir($id);
        }

        return redirect('course')->with('message', 'Kursus berhasil dihapus');
    }
}
