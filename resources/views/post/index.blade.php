@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
  @parent

  <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
  <h1>halaman index post</h1>
  
  @foreach($posts as $post)
  <div>
    <h3>{{ $post->title }}</h3>
    <a href="/posts/{{ $post->id }}">detail</a>
    <a href="/posts/{{ $post->id }}/edit">edit</a>
    <a href="/posts/delete/{{ $post->id }}">delete</a>
  </div>
  @endforeach
@endsection
