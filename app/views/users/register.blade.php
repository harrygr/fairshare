@extends('layouts.master')

@section('title')
Register
@stop

@section('content')
<div class="row">
   <div class="col-md-6">
      {{ Form::open(array('route'=>'users.store', 'class'=>'form-signup')) }}
      <h2 class="form-signup-heading">Please Register</h2>

@include('components.validationerrors')


      <div class="form-group">
         {{ Form::label('username') }}
         {{ Form::text('username', null, array('class'=>'form-control', 'placeholder'=>'Name')) }}
      </div>

      <div class="form-group">
         {{ Form::label('email') }}
         {{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Email Address')) }}
      </div>
      <div class="form-group">
         {{ Form::label('password') }}
         {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
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