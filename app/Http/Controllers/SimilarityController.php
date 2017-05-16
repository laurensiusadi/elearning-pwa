<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\Classroom;
use App\Quiz;

class SimilarityController extends Controller
{
    public function check(Request $request)
    {
        chdir('similarity_plugin');
        $inputfile = fopen('Path/pathFolderSourceCode.txt', 'w');
        $input = "input/" . "\r\n" . $request->classroomid . "\r\n" . $request->quizid . "\r\n" . "output/";
        fwrite($inputfile, $input);
        fclose($inputfile);
        shell_exec("java -jar " . trim(env('SIMILARITY'), "' > /dev/null"));
        chdir('..');
        return "true";
    }

    public function index($classroomid, $quizid)
    {
        $classroom = Classroom::find($classroomid);
        $quiz = Quiz::find($quizid);

        $similaritys = DB::table('sc_similarity')
        ->select('*')
        ->where('kelas', '=', $classroomid)
        ->where('kodesoal', '=', $quizid)
        ->get();

        return view('similarity.index', ['classroomid' => $classroomid, 'quizid' => $quizid, 'similaritys' => $similaritys, 'classroom' => $classroom, 'quiz' => $quiz]);
    }
}
