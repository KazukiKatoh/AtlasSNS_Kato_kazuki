@extends('layouts.login')

@section('content')
<div>
  <form action="search_result" method="POST">
    @csrf
    <input type="text" name="keyword" placeholder="ユーザー名">
    <button type="submit">
      <span class="fa-stack fa-2x">
        <i class="fa-solid fa-square fa-stack-2x" style="color: #186AC9;"></i>
        <i class="fa-solid fa-magnifying-glass fa-stack-1x fa-inverse" style="color: #fff;"></i>
      </span>
    </button>
  </form>
</div>
@if (isset($keyword))
<p class="searchbox">検索ワード:{{ $keyword }}</p>
@endif
<table class="middle-wrapper search">
  @foreach ($users as $user)
  <tr>
    <td>
      @if ($user->images === 'dawn.png')
      <img src="{{ asset('images/icon1.png') }}" alt="サンライズ画像">
      @else
      <img src="{{ asset('/storage/' . $user->images) }}" alt="{{ $user->images }}">
      @endif
    </td>
    <td>{{ $user->username }}</td>
    @if(auth()->user()->isFollowing($user))
    <form action="/unFollow/{{ $user->id }}" method="POST">
      @csrf
      <td><button type="submit" name="id" value="{{ $user->id }}" class="btn unfollow">フォロー解除</button></td>
    </form>
    @else
    <form action="/follow/{{ $user->id }}" method="POST">
      @csrf
      <td><button type="submit" name="id" value="{{ $user->id }}" class="btn follow">フォローする</button></td>
    </form>
    @endif
  </tr>
  @endforeach
</table>
@endsection
