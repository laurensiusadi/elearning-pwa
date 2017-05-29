<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classroom;
use App\Quiz;
use App\Question;
use App\User;
use App\Answer;
use Auth;

class QuizQuestionController extends Controller
{
    public function index($id, $quiz_id)
    {
        $classroom = Classroom::find($id);
        $quiz = Quiz::find($quiz_id);
        $questions = $quiz->questions()->orderBy('created_at', 'asc')->get();

        $ismhs = false;
        // $user = User::find(Auth::id());
        if (Auth::user()->hasRole('mhs')) {
            $ismhs = true;
        }

        return view('quizquestion.index', ['questions' => $questions,'classroom' => $classroom, 'quiz' => $quiz, 'ismhs' => $ismhs]);
    }

    public function show($id, $quiz_id, $question_id)
    {
        $quiz = Quiz::find($quiz_id);
        $question = Question::find($question_id);
        if(Auth::user()->hasRole('mhs') AND Answer::where('question_id', $question_id)->where('user_id', Auth::user()->id)->get()->count() == 0 )
        {
            $answer = new Answer;
            $answer->user_id = Auth::user()->id;
            $answer->question_id = $question_id;
            $answer->code_html = $question->template_html;
            $answer->code_css = $question->template_css;
            $answer->code_js = $question->template_js;
            $answer->done = false;
            $answer->save();
        }
        $answer = Answer::where('question_id', $question_id)->where('user_id', Auth::user()->id)->get()->first();

        return view('question.single', compact('quiz', 'question', 'answer'));
    }

    public function update(Request $request, $id)
    {
        $quiz = Question::find($id);
        foreach ($request['questions_id'] as $question_id) {
            if (!empty($request['data::'.$question_id])) {
                $question = Question::find($question_id);
                $question->quizes()->sync([$id]);
            } elseif (empty($request['data::'.$question_id])) {
                $question = Question::find($question_id);
                $question->quizes()->detach([$id]);
            } else {
                return back()->with('error', 'Quiz tidak terupdate');
            }
        }
        return back()->with('success', 'Quiz terupdate');
    }
}
