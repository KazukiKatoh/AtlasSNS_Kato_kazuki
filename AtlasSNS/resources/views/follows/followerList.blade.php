@extends('layouts.login')

@section('content')
<h1>Follower List</h1>
@foreach ($list as $list)
  <ul>
    <li>{{ $list->username }}</li>
    <li>{{ $list->post }}</li>
    <li>{{ $list->updated_at }}</li>

  </ul>

  @endforeach
@endsection
