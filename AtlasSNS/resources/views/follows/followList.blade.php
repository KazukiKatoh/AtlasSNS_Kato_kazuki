@extends('layouts.login')

@section('content')
<h1>Follow List</h1>
@foreach($list as $post)
  <ul>
    <li>{{ $post->username }}</li>
    <li>{{ $post->post }}</li>
    <li>{{ $post->updated_at }}</li>
  </ul>
  @endforeach

@endsection
