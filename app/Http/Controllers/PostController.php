<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Post_Tag;
use App\Models\Tag;
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
        $post = Post::with('comments')->where('id', $id)->first();

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

        $existing_tags = Tag::all();
        
        if (!is_array($existing_tags)) {
            $existing_tags = [];
        }

        $tags = explode(",", $request->tags);
        
        for ($i = 0; $i < count($tags); $i++) {
            $add_tag = new Post_Tag;
            $add_tag->post_id = $post->id;

            if (in_array($tags[$i], array_column($existing_tags, 'name'))) {
                $get_tag = Tag::where('name', $tags[$i])->first();

                $add_tag->tag_id = $get_tag->id;
            } else {
                $tag = new Tag;
                $tag->name = $tags[$i];
                $tag->save();

                $add_tag->tag_id = $tag->id;
            }
            
            $add_tag->save();
        }

        return redirect()->route('posts.index');
    }

    public function destroy($id) {
        Post::where('id', $id)->delete();
        return redirect()->route('posts.index');
    }
}
