@extends('layouts.app')

@section('title', 'Posts')

@section('content')
  <h1>Posts</h1>

  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Judul</th>
      <th scope="col">Tags</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach($posts as $post)
    <tr>
      <th scope="row">{{ $loop->iteration }}</th>
      <td>{{ $post->title }}</td>
      <td>
        @foreach($post->tags as $tag)
          <a href="/tags/{{ $tag->name }}">{{ $tag->name }}</a>
        @endforeach
      </td>
      <td>
        <a href="/posts/{{ $post->id }}" class="btn btn-sm btn-primary">detail</a>
        <a href="/posts/{{ $post->id }}/edit" class="btn btn-sm btn-success">edit</a>
        <a href="/posts/{{ $post->id }}/delete" class="btn btn-sm btn-danger">delete</a>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
