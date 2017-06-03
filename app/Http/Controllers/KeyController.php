<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Key;
use App\Question;

class KeyController extends Controller
{
    public function store(Request $request, $question_id)
    {
        $key = new Key;
        $key->question_id = $question_id;
        $key->checklist = $request->checklist;
        $key->message = $request->message;
        $key->save();

        return back()->with('message','Challenges berhasil ditambahkan');
    }

    public function update(Request $request, $question_id, $key_id)
    {
        $key = Key::find($key_id);
        $key->checklist = $request->checklist;
        $key->message = $request->message;
        $key->save();

        return back()->with('message','Challenges berhasil diupdate');
    }

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
