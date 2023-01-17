@extends('layouts.login')

@section('content')
<div>
  <form action="searchbox" method="POST">
    @csrf
    <input type="text" name="keyword" placeholder="ユーザー名">
    <button type="submit">
      <span class="fa-stack fa-2x">
        <i class="fa-solid fa-square fa-stack-2x" style="color: #186AC9;"></i>
        <i class="fa-solid fa-magnifying-glass fa-stack-1x fa-inverse" style="color: #fff;"></i>
      </span>
    </button>
  </form>
  <p><? if (isset($keyword)) { echo ('検索ワード：.$keyword.'); } ?></p>
</div>
    <table>
      @foreach ($list as $list)
      <tr>
        <td>{{ $list->username }}</td>
        <td class="content"></td>
      </tr>

  @endforeach
    </table>
@endsection
