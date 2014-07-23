@extends('layouts.full-width')

@section('title')
Home
@stop

@section('content')
<div class="welcome-panel">
<div class="col-md-6">
	<div class="jumbotron">
		<h1>Welcome to FairShare</h1>
		<p>FairShare is a simple app for squaring up shared payments between a group of people.</p>
		<p>
			<a href="{{ URL::route('about') }}" class="btn btn-primary btn-lg" role="button">Learn more</a>
			<a href="{{ URL::route('users.create') }}" class="btn btn-success btn-lg" role="button">Sign Up</a>
		</p>
	</div>
</div>
<div class="col-md-6 home-login">
	@include('forms.login')
</div>
</div>

@stop

