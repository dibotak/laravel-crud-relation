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

    public function edit($id) {
        $post = Post::with('tags')->where('id', $id)->first();
        $tags = array();

        foreach ($post->tags as $tag) {
            array_push($tags, $tag->name);
        }

        $tags = implode(',', $tags);

        return view('post.edit', compact('post'), compact('tags'));
    }

    public function store(Request $request) {
        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        $existing_tags = Tag::all();
        $existing_tags_array = array();
        
        foreach ($existing_tags as $exist_tag) {
            array_push($existing_tags_array, $exist_tag->name);
        }

        $tags = explode(",", $request->tags);
        
        for ($i = 0; $i < count($tags); $i++) {
            $add_tag = new Post_Tag;
            $add_tag->post_id = $post->id;

            if (in_array($tags[$i], $existing_tags_array)) {
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
    
    public function update(Request $request, $id) {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->update();
        
        Post_Tag::where('post_id', $post->id)->delete();

        $existing_tags = Tag::all();
        $existing_tags_array = array();
        
        foreach ($existing_tags as $exist_tag) {
            array_push($existing_tags_array, $exist_tag->name);
        }

        $tags = explode(",", $request->tags);
        
        for ($i = 0; $i < count($tags); $i++) {
            $add_tag = new Post_Tag;
            $add_tag->post_id = $post->id;

            if (in_array($tags[$i], $existing_tags_array)) {
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
        Post_Tag::where('post_id', $id)->delete();
        Comment::where('post_id', $id)->delete();
        Post::where('id', $id)->delete();
        return redirect()->route('posts.index');
    }
}
