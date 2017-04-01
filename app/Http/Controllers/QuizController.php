<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Requests;
use App\User;
use App\Enrollment;
use App\Course;
use App\Quiz;
use Auth;
use DB;

class QuizController extends Controller
{
    public function index($id)
    {
        $enroll = Enrollment::find($id);
        $course = Course::find($enroll->kursus_id);

        $quizes = DB::table('elearning.tugas')
        ->leftJoin('elearning.enrollment', 'elearning.enrollment.id', '=', 'elearning.tugas.enroll_id')
        ->leftJoin('elearning.kursus', 'elearning.kursus.id', '=', 'elearning.enrollment.kursus_id')
        ->select('elearning.tugas.*')
        ->where('elearning.kursus.id', '=', $course->id)
        ->get();

        $ismhs = false;
        // $user = User::find(Auth::id());
        if (User::find(Auth::id())->where('role_user', 'mhs')) { 
            $ismhs = true;
        }

        return view('quiz.index', ['course' => $course, 'quizes' => $quizes, 'enrollid' => $id, 'ismhs' => $ismhs]);
    }

    public function create($id)
    {
        return view('quiz.create', ['enrollid' => $id]);
    }

    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'waktupengerjaan' => 'required',
            'des' => 'required',
            ]);

        // input biasa
        $quiz = new Quiz;
        $quiz->enroll_id = $id;
        $quiz->nama = $request->nama;
        $quiz->wmulai = explode(' - ', $request->waktupengerjaan)[0];
        $quiz->wselesai = explode(' - ', $request->waktupengerjaan)[1];
        $quiz->des = $request->des;
        $quiz->jwb = $request->jwb;
        $quiz->save();

        $courseid = DB::table('elearning.enrollment')
        ->select('elearning.enrollment.kursus_id')
        ->where('elearning.enrollment.id', '=', $id)
        ->first();

        if (!file_exists('kumpulan_sourcecode/'.$courseid->kursus_id . "/" . $quiz->id)) {
            mkdir('kumpulan_sourcecode/'.$courseid->kursus_id."/".$quiz->id, 0777, true);
        }

        $file = fopen('kumpulan_sourcecode/'.$courseid->kursus_id.'/'.$quiz->id.'/dosen'.$id.'.cpp', 'w');
        fwrite($file, $quiz->jwb);
        fclose($file);

        if (!file_exists('similarity_plugin/input/'.$courseid->kursus_id . "/" . $quiz->id)) {
            mkdir('similarity_plugin/input/'.$courseid->kursus_id."/".$quiz->id, 0777, true);
        }

        $filesimilarity = fopen('similarity_plugin/input/'.$courseid->kursus_id.'/'.$quiz->id.'/0_'.$quiz->id.'_dosen_'.$quiz->nama.'.cpp', 'w');
        fwrite($filesimilarity, $quiz->jwb);
        fclose($filesimilarity);

        return redirect('enroll/'.$id.'/quiz/'.$quiz->id)->with('message', 'Penugasan baru berhasil ditambahkan');
    }

    public function show($id, $quiz_id)
    {
        $quiz = Quiz::find($quiz_id);

        $ismhs = false;
        $user = User::find(Auth::id());
        if ($user->is('mhs')) {
            $ismhs = true;
        }

        return view('quiz.single', ['quiz' => $quiz, 'enrollid' => $id, 'ismhs' => $ismhs]);
    }

    public function edit($id, $quiz_id)
    {
        $quiz = Quiz::find($quiz_id);
        return view('quiz.edit', ['enrollid' => $id, 'quizid' => $quiz_id, 'quiz' => $quiz]);
    }

    public function update(Request $request, $id, $quiz_id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'waktupengerjaan' => 'required',
            'des' => 'required',
            ]);

        // input biasa
        $quiz = Quiz::find($quiz_id);
        $quiz->nama = $request->nama;
        $quiz->wmulai = explode(' - ', $request->waktupengerjaan)[0];
        $quiz->wselesai = explode(' - ', $request->waktupengerjaan)[1];
        $quiz->des = $request->des;
        $quiz->jwb = $request->jwb;
        $quiz->save();

        $courseid = DB::table('elearning.enrollment')
        ->select('elearning.enrollment.kursus_id')
        ->where('elearning.enrollment.id', '=', $id)
        ->first();

        if (!file_exists('kumpulan_sourcecode/'.$courseid->kursus_id . "/" . $quiz->id)) {
            mkdir('kumpulan_sourcecode/'.$courseid->kursus_id."/".$quiz->id, 0777, true);
        }

        $file = fopen('kumpulan_sourcecode/'.$courseid->kursus_id.'/'.$quiz_id.'/dosen'.$id.'.cpp', 'w');
        fwrite($file, $quiz->jwb);
        fclose($file);

        if (!file_exists('similarity_plugin/input/'.$courseid->kursus_id . "/" . $quiz->id)) {
            mkdir('similarity_plugin/input/'.$courseid->kursus_id."/".$quiz->id, 0777, true);
        }

        $filesimilarity = fopen('similarity_plugin/input/'.$courseid->kursus_id.'/'.$quiz->id.'/0_'.$quiz->id.'_dosen_'.$quiz->nama.'.cpp', 'w');
        fwrite($filesimilarity, $quiz->jwb);
        fclose($filesimilarity);

        return redirect('enroll/'.$id.'/quiz/'.$quiz_id)->with('message', 'Penugasan berhasil diupdate');
    }

    public function destroy($id, $quiz_id)
    {
        $quiz = Quiz::find($quiz_id);

        try {
            $quiz->delete();
        } catch (QueryException $e) {
            return redirect('enroll/'.$id.'/quiz')->with('error', 'Penugasan gagal dihapus, data masih direferensikan');
        }

        $courseid = DB::table('elearning.enrollment')
        ->select('elearning.enrollment.kursus_id')
        ->where('elearning.enrollment.id', '=', $id)
        ->first();

        if (file_exists($courseid->kursus_id . "/" . $quiz_id)) {
            $status = rmdir($courseid->kursus_id . "/" . $quiz_id);
        }

        return redirect('enroll/'.$id.'/quiz')->with('message', 'Penugasan berhasil dihapus');
    }
}
