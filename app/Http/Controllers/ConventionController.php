<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Convention;
use DB;

class ConventionController extends Controller
{
    public function index()
    {
        $dbconventions = Convention::all();
        return view('convention.index', ['dbconventions' => $dbconventions]);
    }

    public function create()
    {
        $conventions = config('conventionmap');
        return view('convention.create', ['conventions' => $conventions]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'for' => 'required',
            'regex' => 'required',
            'deskripsi' => 'required',
            'min' => 'required',
            'pesanmin' => 'required',
            ]);

        // input biasa
        $convention = new Convention;
        $convention->for = $request->for;
        $convention->regex = $request->regex;
        $convention->deskripsi = $request->deskripsi;
        $convention->min = $request->min;
        $convention->pesanmin = $request->pesanmin;
        $convention->save();

        return redirect('convention')->with('message', 'Konvensi kode baru berhasil ditambahkan');
    }

    public function show($id)
    {
        $convention = Convention::find($id);
        if (!$convention) {
            abort('404');
        }

        return view('convention.single')->with('convention', $convention);
    }

    public function edit($id)
    {
        $conventions = config('conventionmap');

        $convention = Convention::find($id);
        if (!$convention) {
            abort('404');
        }

        return view('convention.edit', ['conventions' => $conventions, 'convention' => $convention]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'for' => 'required',
            'regex' => 'required',
            'deskripsi' => 'required',
            'min' => 'required',
            'pesanmin' => 'required',
            ]);

        // input biasa
        $convention = Convention::find($id);
        $convention->for = $request->for;
        $convention->regex = $request->regex;
        $convention->deskripsi = $request->deskripsi;
        $convention->min = $request->min;
        $convention->pesanmin = $request->pesanmin;
        $convention->save();
        return redirect('convention')->with('message', 'Konvensi kode berhasil diupdate');
    }

    public function destroy($id)
    {
        $convention = Convention::find($id);
        try {
            $convention->delete();
        } catch (QueryException $e) {
            return redirect('convention')->with('error', 'Konvensi kode gagal dihapus, data masih direferensikan');
        }

        return redirect('convention')->with('message', 'Konvensi kode berhasil dihapus');
    }

    public function getConventionRule($for)
    {
        $regex = DB::table('elearningnew.convention')
        ->select('regex')
        ->where('for', '=', $for)
        ->get();

        return $regex;
    }

    public function getConventionMessage($for)
    {
        $message = DB::table('elearningnew.convention')
        ->select('deskripsi')
        ->where('for', '=', $for)
        ->get();

        return $message;
    }

    public function getConventionMinimal($for)
    {
        $min = DB::table('elearningnew.convention')
        ->select('min', 'pesanmin')
        ->where('for', '=', $for)
        ->get();

        return $min;
    }
}
