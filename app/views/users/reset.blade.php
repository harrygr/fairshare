@extends('layouts.master')

@section('title')
Reset Password
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<h2>Reset Password</h2>
		{{ Confide::makeResetPasswordForm($token)->render() }}
	</div>
</div>
@stop