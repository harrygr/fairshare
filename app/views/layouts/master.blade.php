<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>
		@section('title')
		Larpay - 
		@show
	</title>

	{{ HTML::style('//netdna.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css'); }}
	{{ HTML::style('css/main.css'); }}
	{{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js') }}
	{{ HTML::script('js/bootstrap.min.js'); }}
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				{{ HTML::linkRoute('home', 'LaraPay', array(), array('class' => 'navbar-brand')) }}
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">  

					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Payers <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li>{{ HTML::link('payers', 'All Payers') }}</li>
							<li>{{ HTML::linkRoute('payers.add', 'Add Payer') }}</li>

						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Payments <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li>{{ HTML::linkRoute('payments.add', 'Add Payment') }}</li>

						</ul>
					</li>
					<li>{{ HTML::link('/statement', 'Statement') }}</li>
				</ul> 

				<ul class="nav navbar-nav navbar-right">

					<li class="dropdown">

						@if (!Auth::check())
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon"></span> Sign In/Register <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li>{{ HTML::linkRoute('users.showLogin', 'Sign In') }}</li>
							<li>{{ HTML::linkRoute('users.showRegister', 'Register') }}</li>
						</ul>
						@else
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> {{ Auth::user()->username }} <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li>{{ HTML::linkRoute('users.dashboard', 'Dashboard') }}</li>
							<li>{{ HTML::linkRoute('users.dashboard', 'Edit Profile') }}</li>
							<li class="divider"></li>
							<li>{{ HTML::linkRoute('users.logout', 'Sign Out') }}</li>
						</ul>
						@endif

					</li>

				</ul> 
			</div>
		</div>
	</nav> 
	<div id="container" class="container">
		<div class="row">
			@if(Session::has('message'))
			<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
			@endif
		</div>
		<div class="row">
			<div class="col-md-9">
				@yield('content')
			</div>
			<div class="col-md-3">
				<h2>Sidebar</h2>
				@yield('sidebar')
			</div>
		</div>
		
	</div>
	<script>
	$(function(){
		$('form.confirm-form').submit(function(){
			return confirm('Are you sure?');
		});
	})
	</script>
</body>
</html>