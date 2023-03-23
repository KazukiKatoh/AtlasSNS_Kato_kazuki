@extends('layouts.login')

@section('content')
<h1>Follow List</h1>
@foreach ($followedUsers as $user)
<ul class="userlist">
  <li>
    <a href="/profile/{{ $user->id }}">
      @if ($user->images === 'dawn.png')
      <img src="{{ asset('images/icon1.png') }}" alt="サンライズ画像">
      @else
      <img src="{{ asset('/storage/' . $user->images) }}" alt="{{ $user->images }}">
      @endif
    </a>
  </li>
</ul>
@endforeach
@foreach($list as $post)
<table class='table table-hover'>
  <ul>
    <li>
      <a href="/profile/{{ $post->user_id }}">
        @if (basename($post->images) === 'dawn.png')
        <img src="{{ asset('images/icon1.png') }}" alt="サンライズ画像">
        @else
        <img src="{{ $post->images }}" alt="プロフィール画像">
        @endif
      </a>
    </li>
    <li>{{ $post->username }}</li>
    <li>{{ $post->post }}</li>
    <li>{{ $post->updated_at }}</li>
  </ul>
</table>
@endforeach

@endsection
