<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Kodeine\Acl\Models\Eloquent\Role;
use App\Http\Requests;
use App\User;
use App\Enrollment;
use App\Classroom;
use App\Quiz;
use App\Answer;
use App\Detail;
use Auth;
use DB;

class AnswerController extends Controller
{
    public function index($id, $quiz_id)
    {
        $quiz = Quiz::find($quiz_id);

        $ismhs = false;
        $user = Auth::user();
        if (Auth::user()->hasRole('mhs')) {
            $ismhs = true;
        }

        $enroll = Enrollment::find($id);
        $classroom = Classroom::find($enroll->classroom_id);

        if ($ismhs == true) {
            $participants = DB::table('elearningnew.enrollment')
            ->leftJoin('users', 'users.id', '=', 'elearningnew.enrollment.user_id')
            ->leftJoin('elearningnew.pengumpulan', function ($join) use ($quiz_id) {
                $join->on('elearningnew.pengumpulan.enroll_id', '=', 'elearningnew.enrollment.id');
                $join->on('elearningnew.pengumpulan.tugas_id', '=', DB::raw($quiz_id));
            })
            ->select('users.nomorinduk as nomorinduk', 'users.name as username', 'elearningnew.pengumpulan.id as answerid')
            ->where('elearningnew.enrollment.classroom_id', '=', $classroom->id)
            ->where('elearningnew.enrollment.user_id', '=', Auth::id())
            ->get();
        } else {
            $participants = DB::table('elearningnew.enrollment')
            ->leftJoin('users', 'users.id', '=', 'elearningnew.enrollment.user_id')
            ->leftJoin('elearningnew.pengumpulan', function ($join) use ($quiz_id) {
                $join->on('elearningnew.pengumpulan.enroll_id', '=', 'elearningnew.enrollment.id');
                $join->on('elearningnew.pengumpulan.tugas_id', '=', DB::raw($quiz_id));
            })
            ->select('users.nomorinduk as nomorinduk', 'users.name as username', 'elearningnew.pengumpulan.id as answerid')
            ->where('elearningnew.enrollment.classroom_id', '=', $classroom->id)
            ->where('elearningnew.enrollment.user_id', '!=', Auth::id())
            ->get();
        }

        return view('answer.index', ['participants' => User::hydrate($participants->toArray()), 'classroom' => $classroom, 'quiz' => $quiz, 'classroomid' => $classroom->id, 'enrollid' => $id, 'quizid' => $quiz_id, 'ismhs' => $ismhs]);
    }

    public function create($id, $quiz_id)
    {
        $quiz = Quiz::find($quiz_id);
        return view('answer.create', ['enrollid' => $id, 'quizid' => $quiz_id, 'quiz' => $quiz]);
    }

    public function store(Request $request, $id, $quiz_id)
    {
        $enroll = Enrollment::find($id);
        $user = User::find($enroll->user_id);
        $quiz = Quiz::find($quiz_id);

        $answer = new Answer;
        $answer->enroll_id = $id;
        $answer->tugas_id = $quiz_id;
        $answer->save();

        // input biasa
        $detail = new Detail;
        $detail->kumpul_id = $answer->id;
        $time = explode(":", $request->durasi);
        $durasi = $time[0] * 60;
        $durasi = $durasi + ($time[1] * 1);
        $detail->durasi = $durasi;
        $detail->errsyntax = $request->errsyntax;
        $detail->errconvention = $request->errconvention;
        $detail->kode = $request->kode;
        $detail->save();

        $classroomid = DB::table('elearningnew.enrollment')
        ->select('elearningnew.enrollment.classroom_id')
        ->where('elearningnew.enrollment.id', '=', $id)
        ->first();

        if (!file_exists('kumpulan_sourcecode/'.$classroomid->classroom_id . "/" . $quiz->id)) {
            mkdir('kumpulan_sourcecode/'.$classroomid->classroom_id."/".$quiz->id, 0777, true);
        }

        $file = fopen('kumpulan_sourcecode/'.$classroomid->classroom_id.'/'.$quiz_id.'/'.$id.'.cpp', 'w');
        fwrite($file, $detail->kode);
        fclose($file);

        if (!file_exists('similarity_plugin/input/'.$classroomid->classroom_id . "/" . $quiz->id)) {
            mkdir('similarity_plugin/input/'.$classroomid->classroom_id."/".$quiz->id, 0777, true);
        }

        $filesimilarity = fopen('similarity_plugin/input/'.$enroll->classroom_id.'/'.$quiz_id.'/'.$enroll->classroom_id.' '.$quiz_id.' '.$user->nomorinduk.'--'.$quiz->nama.'.cpp', 'w');
        fwrite($filesimilarity, $detail->kode);
        fclose($filesimilarity);

        if (!file_exists('plagiarism_plugin/input/'.$classroomid->classroom_id . "/" . $quiz->id)) {
            mkdir('plagiarism_plugin/input/'.$classroomid->classroom_id."/".$quiz->id, 0777, true);
        }

        $fileclustering = fopen('plagiarism_plugin/input/'.$enroll->classroom_id.'/'.$quiz_id.'/'.$enroll->classroom_id.' '.$quiz_id.' '.$user->nomorinduk.'--'.$quiz->nama.'.cpp', 'w');
        fwrite($fileclustering, $detail->kode);
        fclose($fileclustering);

        return redirect('classroom/'.$id.'/quiz/'.$quiz_id.'/answer/'.$answer->id)->with('message', 'Jawaban baru berhasil ditambahkan');
    }

    public function show($id, $quiz_id, $answer_id)
    {
        $enroll = Enrollment::find($id);
        $classroom = Classroom::find($enroll->classroom_id);
        $user = User::find($enroll->user_id);
        $detail = DB::table('elearningnew.detail')
        ->select('elearningnew.detail.*')
        ->where('kumpul_id', '=', $answer_id)
        ->get();

        $detailpercobaan = array();
        $detaildurasi = array();
        $detailconventionerr = array();
        $detailsyntaxerr = array();
        $jumlahpercobaan = 0;
        foreach ($detail as $key => $value) {
            ++$jumlahpercobaan;
            $detailpercobaan[] = $key + 1;
            $detaildurasi[] = $value->durasi;
            $detailconventionerr[] = $value->errconvention;
            $detailsyntaxerr[] = $value->errsyntax;
        }

        $quiz = Quiz::find($quiz_id);
        $answer = Answer::find($answer_id);
        return view('answer.single', ['enrollid' => $id, 'quizid' => $quiz_id, 'answerid' => $answer_id, 'classroom' => $classroom, 'quiz' => $quiz, 'answer' => $answer, 'user' => $user, 'detailpercobaan' => json_encode($detailpercobaan), 'detaildurasi' => json_encode($detaildurasi), 'detailconventionerr' => json_encode($detailconventionerr), 'detailsyntaxerr' => json_encode($detailsyntaxerr), 'jumlahpercobaan' => $jumlahpercobaan]);
    }

    public function edit($id, $quiz_id, $answer_id)
    {
        $quiz = Quiz::find($quiz_id);
        $answer = Answer::find($answer_id);
        return view('answer.edit', ['enrollid' => $id, 'quizid' => $quiz_id, 'answerid' => $answer_id, 'quiz' => $quiz, 'answer' => $answer]);
    }

    public function update(Request $request, $id, $quiz_id, $answer_id)
    {
        $enroll = Enrollment::find($id);
        $user = User::find($enroll->user_id);
        $quiz = Quiz::find($quiz_id);

        // $this->validate($request, [
        //     'kode' => 'required',
        //     'durasi' => 'required',
        //     'errsyntax' => 'required',
        //     'errconvention' => 'required',
        // ]);

        // input biasa
        $detail = new Detail;
        $detail->kumpul_id = $answer_id;
        $time = explode(":", $request->durasi);
        $durasi = $time[0] * 60;
        $durasi = $durasi + ($time[1] * 1);
        $detail->durasi = $durasi;
        $detail->errsyntax = $request->errsyntax;
        $detail->errconvention = $request->errconvention;
        $detail->kode = $request->kode;
        $detail->save();

        $classroomid = DB::table('elearningnew.enrollment')
        ->select('elearningnew.enrollment.classroom_id')
        ->where('elearningnew.enrollment.id', '=', $id)
        ->first();

        if (!file_exists('kumpulan_sourcecode/'.$classroomid->classroom_id . "/" . $quiz->id)) {
            mkdir('kumpulan_sourcecode/'.$classroomid->classroom_id."/".$quiz->id, 0777, true);
        }

        $file = fopen('kumpulan_sourcecode/'.$classroomid->classroom_id.'/'.$quiz_id.'/'.$id.'.cpp', 'w');
        fwrite($file, $detail->kode);
        fclose($file);

        if (!file_exists('similarity_plugin/input/'.$classroomid->classroom_id . "/" . $quiz->id)) {
            mkdir('similarity_plugin/input/'.$classroomid->classroom_id."/".$quiz->id, 0777, true);
        }

        $filesimilarity = fopen('similarity_plugin/input/'.$enroll->classroom_id.'/'.$quiz_id.'/'.$enroll->classroom_id.' '.$quiz_id.' '.$user->nomorinduk.'--'.$quiz->nama.'.cpp', 'w');
        fwrite($filesimilarity, $detail->kode);
        fclose($filesimilarity);

        if (!file_exists('plagiarism_plugin/input/'.$classroomid->classroom_id . "/" . $quiz->id)) {
            mkdir('plagiarism_plugin/input/'.$classroomid->classroom_id."/".$quiz->id, 0777, true);
        }

        $fileclustering = fopen('plagiarism_plugin/input/'.$enroll->classroom_id.'/'.$quiz_id.'/'.$enroll->classroom_id.' '.$quiz_id.' '.$user->nomorinduk.'--'.$quiz->nama.'.cpp', 'w');
        fwrite($fileclustering, $detail->kode);
        fclose($fileclustering);

        return redirect('classroom/'.$id.'/quiz/'.$quiz_id.'/answer/'.$answer_id)->with('message', 'Jawaban berhasil diupdate');
    }

    public function destroy($id)
    {
        //
    }
}
