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
    <button type="submit" class="btn"><img src="images/post.png" style="width: 80px; height: 80px;"></button>
  </div>
</form>

@if ($errors->has('createPost'))
  <div class="alert">{{ $errors->first('createPost') }}</div>
@endif

@foreach ($list as $item)
<table class="wide-wrapper">
    <tr>
      <td>
        @if($item->images === 'dawn.png')
          <img src="images/icon1.png" alt="サンライズ画像">
        @else
          <img src="{{ asset('storage/' . $item->images) }}" alt="プロフィール画像">
        @endif
      </td>
      <td>
        <div>{{ $item->username }}</div>
      </td>
      <td>
        <div>{{ $item->post }}</div>
      </td>
      <td>
        <div>{{ $item->created_at }}</div>
      </td>
      @if (Auth::check() && Auth::user()->id == $item->user_id)
        <td class="content">
          <a class="js-modal-open" href="edit" post="{{ $item->post }}" post_id="{{ $item->id }}">
            <img src="images/edit.png" alt="投稿する" style="margin-right: 10px; width:30px; height:30px;">
          </a>
          <a href="post/{{ $item->id }}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')">
            <img src="images/trash.png" alt="投稿削除" onmouseover="this.src='images/trash-h.png'" onmouseout="this.src='images/trash.png'" style="margin-right: 10px; width:30px; height:30px;">
          </a>
        </td>
        <!-- モーダルの中身 -->
        <div class="modal js-modal">
          <div class="modal-bg js-modal-close"></div>
          <div class="modal-content">
            <form action="/edit/{{ $item->id }}" method="post" class="form">
              @csrf
              <div class="form-group">
                <textarea name="postEdit" class="modal-post" cols="50" rows="10" maxlength="150" id="textarea"></textarea>
                <input type="image" src="images/edit.png" alt="更新する" class="form-submit">
              </div>
              <input type="hidden" class="modal-id" name="id" value="{{ $item->id }}">
              {{ csrf_field() }}
            </form>
          </div>
        </div>
      @endif
    </tr>
  <hr>
  </table>
  @endforeach

@endsection
