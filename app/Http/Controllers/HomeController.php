<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use DB;
use Input;
use Auth;

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

        $enrolls = DB::table('elearning.enrollment')
        ->leftJoin('elearning.kursus', 'elearning.kursus.id', '=', 'elearning.enrollment.kursus_id')
        ->select('elearning.kursus.*', 'elearning.enrollment.id as enrole_id')
        ->where('elearning.enrollment.user_id', '=', Auth::id())
        ->get();

        return view('home', ['posts' => $posts, 'enrolls' => $enrolls]);
    }
}
