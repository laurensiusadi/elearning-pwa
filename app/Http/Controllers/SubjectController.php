<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Subject;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return view('subject.index', ['subjects' => $subjects]);
    }

    public function create()
    {
        return view('subject.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kode' => 'required|between:8,8',
            'nama' => 'required',
            'sks' => 'required|digits:1',
            'kurikulum' => 'required|integer',
        ]);

        // input biasa
        $subject = new Subject;
        $subject->kode = $request->kode;
        $subject->nama = $request->nama;
        $subject->sks = $request->sks;
        $subject->kurikulum = $request->kurikulum;
        $subject->save();

        return redirect('subject')->with('message', 'Matakuliah baru berhasil ditambahkan');
    }

    public function show($id)
    {
        $subject = Subject::find($id);

        if (!$subject) {
            abort('404');
        }

        return view('subject.single')->with('subject', $subject);
    }

    public function edit($id)
    {
        $subject = Subject::find($id);

        if (!$subject) {
            abort('404');
        }

        return view('subject.edit')->with('subject', $subject);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'kode' => 'required|between:8,8',
            'nama' => 'required',
            'sks' => 'required|digits:1',
            'kurikulum' => 'required|integer',
        ]);

        // input biasa
        $subject = Subject::find($id);
        $subject->kode = $request->kode;
        $subject->nama = $request->nama;
        $subject->sks = $request->sks;
        $subject->kurikulum = $request->kurikulum;
        $subject->save();

        return redirect('subject')->with('message', 'Matakuliah berhasil diupdate');
    }

    public function destroy($id)
    {
        $subject = Subject::find($id);

        try {
            $subject->delete();
        } catch (QueryException $e) {
            return redirect('subject')->with('error', 'Matakuliah gagal dihapus, data masih direferensikan');
        }

        return redirect('subject')->with('message', 'Matakuliah berhasil dihapus');
    }
}
