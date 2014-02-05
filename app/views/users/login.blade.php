@extends('layouts.master')

@section('content')
<div class="row">
   <div class="col-md-6">
      {{ Form::open(array('route'=>'users.doLogin', 'class'=>'form-signin')) }}
      <h2 class="form-signup-heading">Log In Here</h2>

      <div class="form-group">
         {{ Form::text('username', null, array('class'=>'form-control', 'placeholder'=>'Name')) }}
      </div>

      <div class="form-group">
         {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
      </div>

      {{ Form::submit('Login', array('class'=>'btn btn-primary'))}}
      {{ Form::close() }}
   </div>
</div>
@stop