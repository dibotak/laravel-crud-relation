@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
  <h1>Create Post disini</h1>
  <form action="/posts" method="post">
    @csrf
    <input name="title" type="text" placeholder="Title">
    <textarea name="content" id="" cols="30" rows="10"></textarea>
    <button type="submit">input</button>
  </form>
@endsection