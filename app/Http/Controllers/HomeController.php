<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use DB;
use Input;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = DB::table('elearning.posting')
        ->leftJoin('users', 'users.id', '=', 'elearning.posting.user_id')
        ->select('elearning.posting.*', 'users.name')
        ->orderBy('elearning.posting.created_at', 'desc')
        ->paginate(3);

        return view('home', ['posts' => $posts]);
    }

    // public function compile(Request $request) {
    //     if($request->ajax()){
    //         $file = fopen("test.cpp", 'w');
    //         fwrite($file, $request->source);
    //         fclose($file);
    //
    //         exec(trim(env('COMPILER'),"'") . ' 2>&1 test.cpp -O3 -o test.exe', $res, $ret);
    //
    //         return $res;
    //     }
    // }
}
