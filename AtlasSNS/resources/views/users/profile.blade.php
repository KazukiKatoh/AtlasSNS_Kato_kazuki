@extends('layouts.login')

@section('content')
<form action="update" method="POST" enctype="multipart/form-data">
  @csrf
  <tr>
    <td class="myprofile">user name<input type="text" value="{{Auth::user()->username}}"></td><br>
    <td class="myprofile">mail address<input type="text" value="{{Auth::user()->mail}}"></td><br>
    <td class="myprofile">password<input type="password"></td><br>
    <td class="myprofile">password confirm<input type="password" value=""></td><br>
    <td class="myprofile">bio<input type="text" value="{{Auth::user()->bio}}"></td><br>
    <td class="myprofile">icon image<input type="file" name="image"></td>
  </tr>
  <input type="button" value="更新する" >
</form>

@endsection
