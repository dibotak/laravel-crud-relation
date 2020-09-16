@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
  <h1>Create Post disini</h1>

  <form action="/posts" method="post">
    @csrf
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="form-group">
      <label for="content">Content</label>
      <textarea class="form-control" id="content" rows="3" name="content"></textarea>
    </div>
    <div class="form-group">
      <label for="tags">Tags</label>
      <input type="text" class="form-control" id="tags" name="tags">
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
  </form>
@endsection