@extends('layouts.master')

@section('title')
Register
@stop

@section('content')
<div class="row">
 <div class="col-md-6">
  <h2 class="form-signup-heading">Register</h2>
  {{ Form::open(array('route'=>'users.store', 'class'=>'form-signup')) }}

  @include('components.validationerrors')

  <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
    {{ Form::label('username') }}
    {{ Form::text('username', null, array('class'=>'form-control', 'placeholder'=>'Username')) }}
    {{ $errors->first('username', '<span class="help-block">:message</span>') }}
  </div>
  <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    {{ Form::label('email') }}
    {{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Email Address')) }}
    {{ $errors->first('email', '<span class="help-block">:message</span>') }}
  </div>
  <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
    {{ Form::label('password') }}
    {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
    {{ $errors->first('password', '<span class="help-block">:message</span>') }}
  </div>
  <div class="form-group">
    {{ Form::label('password_confirmation') }}
    {{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Confirm Password')) }}
  </div>
  {{ Form::submit('Register', array('class'=>'btn btn-primary'))}}
  {{ Form::close() }}
</div>
</div>
@stop