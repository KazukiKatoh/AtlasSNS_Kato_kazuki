@extends('layouts.login')

@section('content')
<div id="bottomline">
  <div class="post-input-wrapper">
    <table class="otherprofile">
      <tr>
        <td>
          @if ($user->images === 'dawn.png')
          <img src="{{ asset('images/icon1.png') }}" alt="サンライズ画像">
          @else
          <img src="{{ asset('/storage/' . $user->images) }}" alt="{{ $user->images }}">
          @endif
        </td>
        <td>
          <span>name</span>
          <span>bio</span>
        </td>
        <td>
          <span>{{ $user->username }}</span>
          <span>{{ $user->bio }}</span>
        </td>
        <td>
          @if(auth()->user()->isFollowing($user))
          <form action="/unFollow/{{ $user->id }}" method="POST">
            @csrf
            <button type="submit" name="id" value="{{ $user->id }}" class="btn unfollow">フォロー解除</button>
          </form>
          @else
          <form action="/follow/{{ $user->id }}" method="POST">
            @csrf
            <button type="submit" name="id" value="{{ $user->id }}" class="btn follow">フォローする</button>
          </form>
          @endif
        </td>
      </tr>
    </table>
  </div>
</div>
@forelse ($posts as $post)
<table class="wide-wrapper">
  <tr>
    <td>
      @if ($user->images === 'dawn.png')
      <img src="{{ asset('images/icon1.png') }}" alt="サンライズ画像">
      @else
      <img src="{{ asset('/storage/' . $user->images) }}" alt="{{ $user->images }}">
      @endif
    </td>
    <td>
      <div>{{ $user->username }}</div>
      <div>{{ $post->post }}</div>
    </td>
    <td>
      <div>{{ $post->created_at }}</div>
    </td>
  </tr>
</table>
<hr>
@empty
<div class="empty">表示する投稿がありません</div>
@endforelse

@endsection
