@extends('layouts.login')

@section('content')
<div id="bottomline">
  <table class="userlist">
    <tr>
      <td>
        <h2>Follower List</h2>
      </td>
      <td>
        @if ($followerUsers->isEmpty())
        <p>現在あなたをフォローしているユーザーはいません</p>
        @endif
        @foreach ($followerUsers as $user)
        <a href="/otherprofile/{{ $user->id }}">
          @if ($user->images === 'dawn.png')
          <img src="{{ asset('images/icon1.png') }}" alt="サンライズ画像">
          @else
          <img src="{{ asset('/storage/' . $user->images) }}" alt="{{ $user->images }}">
          @endif
        </a>
        @endforeach
      </td>
    </tr>
  </table>
</div>
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
<div class="empty">表示する投稿がありません</div>
@endif
@endsection
