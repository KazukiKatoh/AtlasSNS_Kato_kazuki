@extends('layouts.login')

@section('content')
<table>
  <tr>
    <td>
      @if ($user->images === 'dawn.png')
      <img src="{{ asset('images/icon1.png') }}" alt="サンライズ画像">
      @else
      <img src="{{ asset('/storage/' . $user->images) }}" alt="{{ $user->images }}">
      @endif
    </td>
    <td>
      <div>name　　{{ $user->username }}</div>
      <div>bio　　　{{ $user->bio }}</div>
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
@forelse ($posts as $post)
<table>
  <tr>
    <td>
      @if ($user->images === 'dawn.png')
      <img src="{{ asset('images/icon1.png') }}" alt="サンライズ画像">
      @else
      <img src="{{ asset('/storage/' . $user->images) }}" alt="{{ $user->images }}">
      @endif
    </td>
    <td>
      <div>{{ $post->username }}</div>
      <div>{{ $post->post }}</div>
      <div>{{ $post->updated_at }}</div>
    </td>
  </tr>
</table>
@empty
<p>投稿はありません。</p>
@endforelse

@endsection
