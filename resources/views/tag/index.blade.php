@extends('layouts.app')

@section('title', 'Tags')

@section('content')
  <h1>Tags</h1>

  <ul class="list-group">
    @foreach($tags as $tag)
      <li class="list-group-item">
        <a href="/tags/{{ $tag->name }}" class="stretched-link">{{ $tag->name }}</a>
      </li>
    @endforeach
  </ul>
@endsection
