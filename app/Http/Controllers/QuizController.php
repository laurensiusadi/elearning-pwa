<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Requests;
use App\User;
use App\Enrollment;
use App\Classroom;
use App\Quiz;
use App\Question;
use Auth;
use DB;

class QuizController extends Controller
{
    public function index($id)
    {
        $classroom = Classroom::find($id);
        $quizes = $classroom->quizes;

        $ismhs = false;
        // $user = User::find(Auth::id());
        if (Auth::user()->hasRole('mhs')) {
            $ismhs = true;
        }

        return view('quiz.index', ['classroom' => $classroom, 'quizes' => $quizes, 'ismhs' => $ismhs]);
    }

    public function create($id)
    {
        $enroll = Enrollment::find($id);
        $classroom = Classroom::find($enroll->classroom_id);
        $quizes = $classroom->quizes;
        return view('quiz.create', compact('classroom', 'enroll', 'quizes'));
    }

    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
            ]);

        // input biasa
        $quiz = new Quiz;
        $quiz->classroom_id = $id;
        $quiz->nama = $request->nama;
        $quiz->mulai = $request->mulai;
        $quiz->selesai = $request->selesai;
        $quiz->save();

        $classroomid = DB::table('elearningnew.enrollment')
        ->select('elearningnew.enrollment.classroom_id')
        ->where('elearningnew.enrollment.id', '=', $id)
        ->first();

        return redirect('classroom/'.$id.'/quiz/'.$quiz->id)->with('message', 'Quiz baru berhasil ditambahkan');
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

    public function edit($id, $quiz_id)
    {
        $quiz = Quiz::find($quiz_id);
        $classroomId = $id;
        $allQuestions = Question::all();
        return view('quiz.edit', compact('quiz', 'classroomId', 'allQuestions'));
    }

    public function update(Request $request, $id, $quiz_id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
            ]);

        // input biasa
        $quiz = new Quiz;
        $quiz->classroom_id = $id;
        $quiz->nama = $request->nama;
        $quiz->mulai = $request->mulai;
        $quiz->selesai = $request->selesai;
        $quiz->save();

        $classroomid = DB::table('elearningnew.enrollment')
        ->select('elearningnew.enrollment.classroom_id')
        ->where('elearningnew.enrollment.id', '=', $id)
        ->first();

        return redirect('classroom/'.$id.'/quiz/'.$quiz_id)->with('message', 'Quiz berhasil diupdate');
    }

    public function destroy($id)
    {
        $quiz = Quiz::find($id);

        try {
            $quiz->delete();
        } catch (QueryException $e) {
            return redirect('classroom/'.$id.'/quiz')->with('error', 'Quiz gagal dihapus, data masih direferensikan');
        }

        $classroomid = $quiz->classroom->id;

        return back()->with('message', 'Quiz berhasil dihapus');
    }
}
