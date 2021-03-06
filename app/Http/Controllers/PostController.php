<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

use App\Http\Requests;
use App\Post;
use App\Classroom;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(3);
        if (Auth::user()->hasRole('dosen')) {
            $classrooms = Classroom::all();
        } else {
            $classrooms = Classroom::all();
        }

        return view('post.index', compact('posts', 'classrooms'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required',
            ]);

        // input biasa
        $post = new Post;
        $post->user_id = Auth::id();
        $post->classroom_id = $request->classroom;
        $post->content = $request->content;
        $post->save();

        return back()->with('message', 'Pengumuman baru berhasil ditambahkan');
    }

    public function show($id)
    {
        $post = DB::table('elearningnew.posting')
        ->select('elearningnew.posting.*')
        ->where('elearningnew.posting.id', '=', $id)
        ->get();

        if (!$post) {
            abort('404');
        }

        return view('post.single')->with('post', $post);
    }

    public function edit($id)
    {
        $post = Post::find($id);

        if (!$post) {
            abort('404');
        }

        return view('post.edit')->with('post', $post);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'judul' => 'required',
            'text' => 'required',
            ]);

        // input biasa
        $post = Post::find($id);
        $post->user_id = Auth::id();
        $post->judul = $request->judul;
        $post->text = $request->text;
        $post->save();

        return redirect('post')->with('message', 'Pengumuman berhasil diupdate');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        try {
            $post->delete();
        } catch (QueryException $e) {
            return redirect('post')->with('error', 'Pengumuman gagal dihapus, data masih direferensikan');
        }

        return back()->with('message', 'Pengumuman berhasil dihapus');
    }
}
