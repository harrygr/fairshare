@extends('layouts.master')

@section('title')
Login
@stop

@section('content')
<div class="row">
   <div class="col-md-6">
      {{ Form::open(array('route'=>'users.do_login', 'class'=>'form-signin')) }}
      <h2 class="form-signup-heading">Log In Here</h2>

      <div class="form-group">
         {{ Form::label('username') }}
         {{ Form::text('username', null, array('class'=>'form-control', 'placeholder'=>'Name')) }}
      </div>

      <div class="form-group">
         {{ Form::label('password') }}
         {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
      </div>

      {{ Form::submit('Login', array('class'=>'btn btn-primary'))}}
      {{ HTML::linkRoute('users.forgot_password', 'Forgot Password') }}
      {{ Form::close() }}
   </div>
</div>
@stop