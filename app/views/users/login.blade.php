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
          <small>
            {{ HTML::linkRoute('users.forgot_password', Lang::get('confide::confide.login.forgot_password')) }}
            </small>
      </div>
      <div class="form-group">
         <label for="remember" class="checkbox">{{{ Lang::get('confide::confide.login.remember') }}}
           <input type="hidden" name="remember" value="0">
           <input tabindex="4" type="checkbox" name="remember" id="remember" value="1">
        </label>
     </div>

     {{ Form::submit('Login', array('class'=>'btn btn-primary'))}}
     
     {{ Form::close() }}
  </div>
</div>
@stop