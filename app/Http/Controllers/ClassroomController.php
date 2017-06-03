<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\QueryException;
use App\Http\Requests;
use App\Classroom;
use App\Period;
use App\Subject;
use DB;

class ClassroomController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::all();
        $periods = Period::all();
        $subjects = Subject::all();

        return view('classroom.index', compact('classrooms','periods','subjects'));
    }

    public function create()
    {
        $periods = Period::all();
        $subjects = Subject::all();

        return view('classroom.create', compact('periods','subjects'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'period_id' => 'required',
            'subject_id' => 'required',
            'nama' => 'required',
            ]);

        // input biasa
        $classroom = new Classroom;
        $classroom->period_id = $request->period_id;
        $classroom->subject_id = $request->subject_id;
        $classroom->nama = $request->nama;
        $classroom->save();

        // if (!file_exists($classroom->id)) {
        //     mkdir('kumpulan_sourcecode/'.$classroom->id);
        // }

        return redirect('classroom')->with('message', 'Kelas baru berhasil ditambahkan');
    }

    public function show($id)
    {
        // $classroom = DB::table('elearningnew.classroom as k')
        // ->join('elearningnew.period as p', 'p.id', '=', 'k.period_id')
        // ->join('elearningnew.matakuliah as m', 'm.id', '=', 'k.subject_id')
        // ->select('k.*', 'p.nama as namaperiode', 'm.nama as namamatakuliah')
        // ->where('k.id', '=', $id)
        // ->get();
        $classroom = Classroom::find($id);

        if (!$classroom) {
            abort('404');
        }

        return view('classroom.single')->with('classroom', $classroom);
    }

    public function edit($id)
    {
        $classroom = Classroom::find($id);
        $periods = Period::all();
        $subjects = Subject::all();

        if (!$classroom) {
            abort('404');
        }

        return view('classroom.edit', ['periods' => $periods, 'subjects' => $subjects, 'classroom' => $classroom]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'period_id' => 'required',
            'subject_id' => 'required',
            'nama' => 'required',
            ]);

        // input biasa
        $classroom = Classroom::find($id);
        $classroom->period_id = $request->period_id;
        $classroom->subject_id = $request->subject_id;
        $classroom->nama = $request->nama;
        $classroom->save();

        return redirect('classroom')->with('message', 'Kelas berhasil diupdate');
    }

    public function destroy($id)
    {
        $classroom = Classroom::find($id);

        try {
            $classroom->delete();
        } catch (QueryException $e) {
            return redirect('classroom')->with('error', 'Kelas gagal dihapus, data masih direferensikan');
        }

        return redirect('classroom')->with('message', 'Kelas '.$classroom->nama.' berhasil dihapus');
    }
}
