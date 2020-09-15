<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        $posts = Post::all();

        return view('post.index', compact('posts'));
    }

    public function create() {
        return view('post.create');
    }

    public function show($id) {
        $post = Post::where('id', $id)->first();

        return view('post.show', compact('post'));
    }

    public function edit($slug) {
        return view('post.edit', compact('slug'));
    }

    public function store(Request $request) {
        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        return redirect()->route('posts.index');
    }

    public function destroy($id) {
        Post::where('id', $id)->delete();
        return redirect()->route('posts.index');
    }
}
