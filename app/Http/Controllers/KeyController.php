<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Key;
use App\Question;

class KeyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $question_id)
    {
        $key = new Key;
        $key->question_id = $question_id;
        $key->checklist = $request->checklist;
        $key->message = $request->message;
        $key->save();

        return back()->with('message','Challenges berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $question_id, $key_id)
    {
        $key = Key::find($key_id);
        $key->checklist = $request->checklist;
        $key->message = $request->message;
        $key->save();

        return back()->with('message','Challenges berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($question_id, $key_id)
    {
        $key = Key::find($key_id);
        try {
            $key->delete();
        } catch (QueryException $e) {
            return back()->with('error', 'Challenge gagal dihapus');
        }
        return back()->with('message','Challenges berhasil dihapus');
    }
}
