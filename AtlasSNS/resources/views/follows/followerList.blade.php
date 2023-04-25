@extends('layouts.login')

@section('content')
<table class="userlist">
  <tr>
    <h2>Follower List</h2>
    @if ($followerUsers->isEmpty())
    <p>現在あなたをフォローしているユーザーはいません</p>
    @endif
    @foreach ($followerUsers as $user)
    <td>
      <a href="/otherprofile/{{ $user->id }}">
        @if ($user->images === 'dawn.png')
        <img src="{{ asset('images/icon1.png') }}" alt="サンライズ画像">
        @else
        <img src="{{ asset('/storage/' . $user->images) }}" alt="{{ $user->images }}">
        @endif
      </a>
    </td>
    @endforeach
  </tr>
</table>

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
      <div>{{ $post->post }}</div>
    </td>
    <td>
      <div>{{ $post->created_at }}</div>
    </td>
  </tr>
</table>
<hr>
@endforeach
@if(count($list) === 0)
<p>表示する投稿がありません</p>
@endif
@endsection
