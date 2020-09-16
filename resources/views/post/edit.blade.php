@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
  <h1>Edit</h1>

  <form action="/posts/{{ $post->id }}/update" method="post">
    @csrf
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title" name="title"
        value="{{ $post->title }}">
    </div>
    <div class="form-group">
      <label for="content">Content</label>
      <textarea class="form-control" id="content" rows="3" name="content">{{ $post->content }}</textarea>
    </div>
    <div class="form-group">
      <label for="tags">Tags</label>
      <input type="text" class="form-control" id="tags" name="tags"
        value="{{ $tags }}">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
@endsection