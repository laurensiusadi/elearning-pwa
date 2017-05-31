<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Question;
use App\User;
use Auth;

class AnswerController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id, $quiz_id, $question_id)
    {
        $answerId = Answer::where('question_id', $question_id)->where('user_id', Auth::user()->id)->get()->first()->id;
        $answer = Answer::find($answerId);
        $answer->code_html = $request->html;
        $answer->code_css = $request->css;
        $answer->code_js = $request->js;
        $answer->save();

        return back()->with('message', 'Answer saved');
    }

    public function done(Request $request, $id, $quiz_id, $question_id)
    {
        $answerId = Answer::where('question_id', $question_id)->where('user_id', Auth::user()->id)->get()->first()->id;
        $answer = Answer::find($answerId);
        $answer->done = true;
        $answer->save();

        return redirect('/classroom/'.$id.'/quiz/'.$quiz_id.'/question/')->with('message', 'Question done');
    }

    public function destroy($id)
    {
        //
    }
}
