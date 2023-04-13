@extends('layouts.login')

@section('content')
<div>
  @if ($errors->any())
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
  @endif
</div>
<form action="/profileedit" enctype="multipart/form-data" method="POST">
  @csrf
  <img src="{{ asset('/storage/' . Auth::user()->images) }}" alt="">
  <table class="middle-wrapper">
    <tr>
      <td>user name<input type="text" name="username" value="{{Auth::user()->username}}"></td>
    </tr>
    <tr>
      <td >mail address<input type="text" name="mail" value="{{Auth::user()->mail}}"></td>
    </tr>
    <tr>
      <td>password<input type="password" name="password" autocomplete="new-password"></td>
    </tr>
    <tr>
      <td>password confirm<input type="password" name="password_confirmation"></td>
    </tr>
    <tr>
      <td>bio<input type="text" name="bio" value="{{Auth::user()->bio}}"></td>
    </tr>
    <tr>
      <td>icon image
        <div for="imgpath" class="drop-area">
          <input type="file" name="imgpath" id="imgpath" style="display: none;">
          <span class="drop-message">ファイルを選択</span>
          <img id="preview-image" src="" alt="">
        </div>
      </td>
    </tr>
  </table>
  <button type="submit" class="btn update">更新</button>
  {{ csrf_field() }}
</form>


@endsection
