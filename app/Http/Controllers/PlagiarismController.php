<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Classroom;
use App\Quiz;

class PlagiarismController extends Controller
{
    public function check(Request $request) {
        set_time_limit(0);
    	chdir('plagiarism_plugin');
    	$inputfile = fopen('inputPath/input.txt', 'w');
    	$input = "input/".$request->classroomid."/".$request->quizid. "/\r\n" . $request->classroomid . "\r\n" . $request->quizid;
    	fwrite($inputfile, $input);
    	fclose($inputfile);
        shell_exec("ulimit -t 600");
        shell_exec("java -jar " . trim(env('PLAGIARISM'),"'") . " 2> /dev/null & echo $!");
        chdir('..');
        return "true";
    }

    public function index($classroomid, $quizid, $filter) {
        $classroom = Classroom::find($classroomid);
        $quiz = Quiz::find($quizid);
        $enrollid = $quiz->enroll_id;

        try {
            $result = @file_get_contents('plagiarism_plugin/outputCluster/Hasil_Cluster'.$classroomid.'_'.$quizid.'.txt');
        } catch (ErrorException $e) {
            return view('plagiarism.index', ['listcluster' => array(), 'fixedcluster' => array(), 'classroomid' => $classroomid, 'enrollid' => $enrollid, 'quizid' => $quizid, 'selected' => $filter, 'classroom' => $classroom, 'quiz' => $quiz, 'proc' => array(), 'listclusterforchart' => json_encode(array()), 'standardeviasiforchart' => json_encode(array())]);
        }

        if($result == "") {
            return view('plagiarism.index', ['listcluster' => array(), 'fixedcluster' => array(), 'classroomid' => $classroomid, 'enrollid' => $enrollid, 'quizid' => $quizid, 'selected' => $filter, 'classroom' => $classroom, 'quiz' => $quiz, 'proc' => array(), 'listclusterforchart' => json_encode(array()), 'standardeviasiforchart' => json_encode(array())]);
        }

        $clusterdirty = explode('-----------------------------------------------JUMLAH CLUSTER = ', $result);
        $i = 0;
        $listcluster = array();
        $fixedcluster = array();
        $standardeviasi = array();
        foreach ($clusterdirty as $scrumbled) {
            ++$i;
            if($i == 1) {
                continue;
            }
            $numbersplited = explode('-----------------------------------------------', $scrumbled);
            $cluster = $numbersplited[0];
            $listcluster[] = (int)$cluster;
            $fixedcluster[$cluster] = array();
            $proc[$cluster] = array();

            $memberdirty = $numbersplited[1];
            $stdsplited = preg_split('\'\n\n\'', $memberdirty);

            $clustermember = $stdsplited[0];
            $arrmember = preg_split('\'\n\'', $clustermember);
            $j = 0;
            foreach ($arrmember as $memberdirty) {
                ++$j;
                if($j == 1) {
                    continue;
                }

                $mixedmember = explode('%', $memberdirty);
                $memberonly = $mixedmember[0];
                $member = explode(' ', $memberonly);
                $fixedcluster[$cluster][] = $member;
                if(!empty($mixedmember[1])) {
                    $prosentase = $mixedmember[1];
                    $proc[$cluster][] = $prosentase;
                }
            }

            $stdwithvar = $stdsplited[1];
            $stdwithspace = trim($stdwithvar, "STD =");
            $std = preg_split('\'\n\'', $stdwithspace);

            $fixedcluster[$cluster][] = $std[0];
            $standardeviasi[] = (double)$std[0];
        }
        if($filter == 0) {
            $filter = $listcluster[0];
        }

        return view('plagiarism.index', ['listcluster' => $listcluster, 'fixedcluster' => $fixedcluster[$filter], 'classroomid' => $classroomid, 'enrollid' => $enrollid, 'quizid' => $quizid, 'selected' => $filter, 'classroom' => $classroom, 'quiz' => $quiz, 'listclusterforchart' => json_encode(array_reverse($listcluster)), 'standardeviasiforchart' => json_encode(array_reverse($standardeviasi)), 'proc' => $proc[$filter]]);
    }

    public function show($classroomid, $quizid, $filter, $nrp) {
        $classroom = Classroom::find($classroomid);
        $quiz = Quiz::find($quizid);

        $filepath = '/'.$classroomid.' '.$quizid.' '.$nrp.'--.+?\.cpp/';

        $answer = '';
        chdir('plagiarism_plugin/input/'.$classroomid.'/'.$quizid);
        foreach (glob($classroomid." ".$quizid." ".$nrp."--*.cpp") as $filename) {
            if(preg_match($filepath, $filename)) {
                $answer = @file_get_contents($filename);
            }
        }
        chdir("../../../..");
        return view('plagiarism.single', ['classroom' => $classroom, 'quiz' => $quiz, 'filter' => $filter, 'answer' => $answer, 'nrp' => $nrp]);
    }
}
