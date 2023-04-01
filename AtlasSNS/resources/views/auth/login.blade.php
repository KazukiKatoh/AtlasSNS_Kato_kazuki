@extends('layouts.logout')

@section('content')

<div class="center-wrapper">
  <p>AtlasSNSへようこそ</p>
  {!! Form::open() !!}

  <div class="form-group">

    {{ Form::label('mail address', null, ['class' => 'form-label']) }}
    {{ Form::text('mail',null,['class' => 'form-control']) }}

    {{ Form::label('password', null, ['class' => 'form-label']) }}
    {{ Form::password('password',['class' => 'form-control']) }}

    {{ Form::submit('LOGIN',['class' => 'btn btn-primary']) }}
  </div>

  <a href="/register">新規ユーザーの方はこちら</a>

  {!! Form::close() !!}
</div>

@endsection
