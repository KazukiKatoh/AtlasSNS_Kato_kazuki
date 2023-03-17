@extends('layouts.login')

@section('content')
<form action="form" method="POST">
  @csrf
  <div>
    <input type="text" name="createPost" placeholder="投稿内容を入力してください">
    <button type="submit" class="btn"><img src="images/post.png"></button>
  </div>
</form>
<table class='table table-hover'>
  @foreach ($list as $list)
  <tr>
    <td></td>
    <td>{{ $list->post }}</td>
    <td>{{ $list->updated_at }}</td>
    <td class="content">
        <!-- 投稿の編集ボタン -->
        <a class="js-modal-open" href="edit" post="{{ $list->post }}" post_id="{{ $list->id }}"><img src="images/edit.png" alt="投稿する"></a>
    </td>
    <td><a class="btn btn-danger" href="/post/{{ $list->id }}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')"><img src="images/trash-h.png" alt="投稿削除"></a></td>
  </tr>

  @endforeach
</table>
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
@endsection
