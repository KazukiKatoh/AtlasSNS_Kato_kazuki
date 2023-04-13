@extends('layouts.logout')

@section('content')
<div class="center-wrapper">

<div class="text-center">
<h2>新規ユーザー登録</h2>
</div>
@if ($errors->any())
    <div class="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>・{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{!! Form::open() !!}
<div class="form-group">
{{ Form::label('username', 'user name',['class' => 'form-label']) }}
{{ Form::text('username',null,['class' => 'form-control']) }}

{{ Form::label('mail', 'mail address',['class' => 'form-label']) }}
{{ Form::text('mail',null,['class' => 'form-control']) }}

{{ Form::label('password', 'password',['class' => 'form-label']) }}
{{ Form::text('password',null,['class' => 'form-control']) }}

{{ Form::label('password_confirmation', 'password confirm',['class' => 'form-label']) }}
{{ Form::text('password_confirmation',null,['class' => 'form-control']) }}

{{ Form::submit('REGISTER',['class' => 'btn btn-primary']) }}
</div>
<a href="/login"  class="text-center">ログイン画面へ戻る</a>

{!! Form::close() !!}
</div>
@endsection
