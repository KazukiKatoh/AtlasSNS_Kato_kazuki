@extends('layouts.login')

@section('content')
<form action="form" method="POST">
  @csrf
  <div class="post-input-wrapper">
    @if (Auth::user()->images === 'dawn.png')
    <img src="{{ asset('images/icon1.png') }}" alt="サンライズ画像">
    @else
    <img src="{{ asset('/storage/' . Auth::user()->images) }}" alt="{{ Auth::user()->images }}">
    @endif
    <input type="text" name="createPost" placeholder="投稿内容を入力してください" class="post-input">
  </div>
  <button type="submit" class="btn"><img src="images/post.png" style="width: 80px; height: 80px;"></button>
</form>
<style>
  form input[type="text"] {
    border: none;
  }
</style>

@if ($errors->has('createPost'))
<div class="alert">{{ $errors->first('createPost') }}</div>
@endif
<table class='table table-hover'>
  @foreach ($list as $list)
  <tr>
    <td>
      @if($list->images === 'dawn.png')
      <img src="images/icon1.png" alt="サンライズ画像">
      @else
      <img src="{{ asset('storage/' . $list->images) }}" alt="プロフィール画像">
      @endif
    </td>
    <td>
      <div>{{ $list->username }}</div>
      <div>{{ $list->post }}</div>
    </td>
    <td>
      <div>{{ $list->created_at }}</div>
    </td>
    @if (Auth::check() && Auth::user()->id == $list->user_id)
    <td class="content">
  <a class="js-modal-open" href="edit" post="{{ $list->post }}" post_id="{{ $list->id }}">
    <img src="images/edit.png" alt="投稿する" style="margin-right: 10px;">
  </a>
  <a href="post/{{ $list->id }}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')"><img src="images/trash.png" alt="投稿削除" onmouseover="this.src='images/trash-h.png'" onmouseout="this.src='images/trash.png'"></a>
</td>

    <!-- モーダルの中身 -->
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    <form action="/edit/{{ $list->id }}" method="post">
      @csrf
      <textarea name="postEdit" class="modal_post" cols="100" rows="10" maxlength="150" id="textarea"></textarea>
      <input type="hidden" class="modal_id" name="id" value="{{ $list->id }}">
      <input type="image" src="images/edit.png" alt="更新する">
      {{ csrf_field() }}
    </form>
  </div>
</div>

    @endif
  </tr>
  <tr>
    <td colspan="5">
      <hr class="separator">
    </td>
  </tr>
  @endforeach
</table>


@endsection
