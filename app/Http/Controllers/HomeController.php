<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\User;
use App\Question;
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
        $posts = Post::latest()->paginate(3);
        $questionsCount = Question::all()->count();
        return view('home', compact('posts','questionsCount'));
    }
}
