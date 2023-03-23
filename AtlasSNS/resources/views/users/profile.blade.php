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
  <tr>
    <td class="myprofile">user name<input type="text" name="username" value="{{Auth::user()->username}}"></td><br>
    <td class="myprofile">mail address<input type="text" name="mail" value="{{Auth::user()->mail}}"></td><br>
    <td class="myprofile">password<input type="password" name="password" autocomplete="new-password"></td><br>
    <td class="myprofile">password confirm<input type="password" name="password_confirmation"></td><br>
    <td class="myprofile">bio<input type="text" name="bio" value="{{Auth::user()->bio}}"></td><br>
    <td class="myprofile">icon image<input type="file" name="imgpath"></td>
  </tr>
  <button type="submit" class="btn update">更新する</button>
  {{ csrf_field() }}
</form>

@endsection
