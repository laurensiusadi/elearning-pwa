<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classroom;
use App\Quiz;
use App\Question;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();
        return view('question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = new Question;
        $question->topik = $request->topik;
        $question->deskripsi = $request->deskripsi;
        $question->template_html = $request->html;
        $question->template_css = $request->css;
        $question->template_js = $request->js;
        $question->save();

        return redirect('question/'.$question->id.'/edit')->with('message', 'Soal berhasil dibuat');
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
        $question = Question::find($id);
        return view('question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question = Question::find($id);
        $question->topik = $request->topik;
        $question->deskripsi = $request->deskripsi;
        $question->template_html = $request->html;
        $question->template_css = $request->css;
        $question->template_js = $request->js;
        $question->save();

        return back()->with('message', 'Soal berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::find($id);
        try {
            $question->delete();
        } catch (QueryException $e) {
            return back()->with('error', 'Soal gagal dihapus');
        }

        return back()->with('message', 'Soal berhasil dihapus');
    }
}
