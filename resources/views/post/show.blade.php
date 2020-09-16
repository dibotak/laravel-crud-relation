@extends('layouts.app')

@section('title', $post->title)

@section('content')
  <h1>{{ $post->title }}</h1>
  <p>{{ $post->content }}</p>

  <hr>
  
  <h4>Tags</h4>

  <hr>

  <h4>Comments</h4>
  <ul class="list-group">
    @foreach($post->comments as $comment)
      <li class="list-group-item">{{ $comment->content }}</li>
    @endforeach
  </ul>

  <form action="/comments" method="post">
    @csrf
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <div class="form-group">
      <label for="comment">Comment</label>
      <input type="text" name="content" id="comment" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Comment</button>
  </form>
@endsection