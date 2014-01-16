<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>
		@section('title')
		Larpay - 
		@show
	</title>

	{{ HTML::style('css/bootstrap.css'); }}
	{{ HTML::style('css/main.css'); }}
	{{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js') }}
	{{ HTML::script('js/bootstrap.min.js'); }}
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">

		<ul class="nav navbar-nav">  
			@if(!Auth::check())
			<li>{{ HTML::link('users/register', 'Register') }}</li>   
			<li>{{ HTML::link('users/login', 'Login') }}</li>   
			@else
			<li>{{ HTML::link('users/logout', 'Logout') }}</li>
			@endif 
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Payers <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li>{{ HTML::link('payers', 'All Payers') }}</li>
					<li>{{ HTML::link('payers/add', 'Add Payer') }}</li>

				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Payments <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li>{{ HTML::link('payments/add', 'Add Payment') }}</li>

				</ul>
			</li>
		</ul>  

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
</body>
</html>