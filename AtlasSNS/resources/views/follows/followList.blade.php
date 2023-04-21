@extends('layouts.login')

@section('content')
<h2>Follow List</h2>
@if ($followedUsers->isEmpty())
<p>現在あなたがフォローしているユーザーはいません</p>
@else

@foreach ($followedUsers as $user)
<ul class="userlist">
  <li>
    <a href="/otherprofile/{{ $user->id }}">
      @if ($user->images === 'dawn.png')
      <img src="{{ asset('images/icon1.png') }}" alt="サンライズ画像">
      @else
      <img src="{{ asset('/storage/' . $user->images) }}" alt="{{ $user->images }}">
      @endif
    </a>
  </li>
</ul>
@endforeach

@foreach ($list as $post)
<table class="wide-wrapper">
  <tr>
    <td>
      <a href="/otherprofile/{{ $post->user_id }}">
        @if (basename($post->images) === 'dawn.png')
        <img src="{{ asset('images/icon1.png') }}" alt="サンライズ画像">
        @else
        <img src="{{ $post->images }}" alt="プロフィール画像">
        @endif
      </a>
    </td>
    <td>
      <div>{{ $post->username }}</div>
    </td>
    <td>
      <div>{{ $post->post }}</div>
    </td>
    <td>
      <div>{{ $post->created_at }}</div>
    </td>
  </tr>
</table>
<hr>
@endforeach
@endif
@endsection
