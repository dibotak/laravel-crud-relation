<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index() {
        $tags = Tag::all();

        return view('tag.index', compact('tags'));
    }

    public function show($tagParam) {
        $tag = Tag::with('posts')->where('name', $tagParam)->first();

        return view('tag.show', compact('tag'));
    }
}
