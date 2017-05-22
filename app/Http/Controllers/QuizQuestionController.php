<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classroom;
use App\Quiz;
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

    public function show($id, $quiz_id)
    {
        $quiz = Quiz::find($quiz_id);

        $ismhs = false;
        if (User::find(Auth::id())->where('role_user', 'mhs')) {
            $ismhs = true;
        }

        return view('quiz.single', ['quiz' => $quiz, 'enrollid' => $id, 'ismhs' => $ismhs]);
    }
}
