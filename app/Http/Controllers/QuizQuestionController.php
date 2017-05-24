<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classroom;
use App\Quiz;
use App\Question;
use App\User;
use Auth;

class QuizQuestionController extends Controller
{
    public function index($id, $quiz_id)
    {
        $classroom = Classroom::find($id);
        $quiz = Quiz::find($quiz_id);

        $ismhs = false;
        // $user = User::find(Auth::id());
        if (Auth::user()->hasRole('mhs')) {
            $ismhs = true;
        }

        return view('quizquestion.index', ['classroom' => $classroom, 'quiz' => $quiz, 'ismhs' => $ismhs]);
    }

    public function show($id, $quiz_id, $question_id)
    {
        $quiz = Quiz::find($quiz_id);
        $question = Question::find($question_id);
        $ismhs = false;
        if (User::find(Auth::id())->where('role_user', 'mhs')) {
            $ismhs = true;
        }

        return view('question.single', compact('quiz', 'question', 'ismhs'));
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
