@extends('layouts.master')

@section('title')
Update Profile
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<h2 class="form-signup-heading">Update Profile</h2>
		{{ Form::open(array('route'=> array('users.update', $user->id), 'class'=>'form-signup', 'method' => 'put')) }}

		@include('components.validationerrors')

		<div class="form-group">
			{{ Form::label('username') }}
			{{ Form::text('username', $user->username, array('class'=>'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('email') }}
			{{ Form::text('email', $user->email, array('class'=>'form-control')) }}
		</div>
		<legend>Password <small>(Leave blank to leave unchanged)</small></legend>
		<div class="form-group">
			{{ Form::label('password') }}
			{{ Form::password('password', array('class'=>'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('password_confirmation') }}
			{{ Form::password('password_confirmation', array('class'=>'form-control')) }}
		</div>
		
		{{ Form::submit('Save Profile', array('class'=>'btn btn-primary'))}}
		{{ Form::close() }}
	</div>
</div>
@stop