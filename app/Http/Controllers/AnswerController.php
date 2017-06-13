<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Question;
use App\User;
use Auth;

class AnswerController extends Controller
{
    public function update(Request $request, $id, $quiz_id, $question_id)
    {
        if(request()->ajax())
        {
            $answerId = Answer::where('question_id', $request->qid)->where('user_id', Auth::id())->get()->first()->id;
            $answer = Answer::find($answerId);
            $answer->code_html = $request->html;
            $answer->code_css = $request->css;
            $answer->code_js = $request->js;
            $answer->save();
        }
    }

    public function done($id, $quiz_id, $question_id)
    {
        $answerId = Answer::where('question_id', $question_id)->where('user_id', Auth::user()->id)->get()->first()->id;
        $answer = Answer::find($answerId);
        $answer->done = true;
        $answer->save();

        return redirect('/classroom/'.$id.'/quiz/'.$quiz_id.'/question/')->with('message', 'Question done');
    }

}
