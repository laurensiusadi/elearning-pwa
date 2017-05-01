<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\Enrollment;
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
        $enrolls = Enrollment::where('user_id', Auth::user()->id)->get();
        return view('home', compact('posts','enrolls'));
    }
}
