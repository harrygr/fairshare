<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>FairShare | 
		@section('title')

		@show
	</title>

	{{ HTML::style('//netdna.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css') }}
	
	{{ HTML::style('//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css') }}
	{{ HTML::style('css/main.css'); }}
	{{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js') }}
	{{ HTML::script('js/bootstrap.min.js'); }}
</head>
<body>
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

		<header>
			<nav class="navbar navbar-default navbar-fixed-top">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						{{ HTML::linkRoute('home', 'FairShare', array(), array('class' => 'navbar-brand')) }}
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						@if (Auth::check())
						<ul class="nav navbar-nav">  
<li>{{ HTML::decode(HTML::linkRoute('users.dashboard', '<i class="fa fa-fw fa-dashboard"></i> Dashboard')) }}</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-users"></i> Payers <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li>{{ HTML::link('payers', 'All Payers') }}</li>
									<li>{{ HTML::linkRoute('payers.add', 'Add Payer') }}</li>
								</ul>
							</li>

							<li>{{ HTML::decode(HTML::linkRoute('payments.add', '<i class="fa fa-fw fa-gbp"></i> Add Payment')) }}</li>
							<li>{{ HTML::linkRoute('payments.reimburse', 'Add Reimbursement') }}</li>
							<li>{{ HTML::decode(HTML::link('/statement', '<i class="fa fa-fw fa-list"></i> Statement')) }}</li>
						</ul> 
						@endif

						<ul class="nav navbar-nav navbar-right">

							<li class="dropdown">

								@if (!Auth::check())
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon"></span> Sign In/Register <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li>{{ HTML::linkRoute('users.login', 'Sign In') }}</li>
									<li>{{ HTML::linkRoute('users.create', 'Register') }}</li>
								</ul>
								@else
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-fw fa-user"></span> {{ Auth::user()->username }} <b class="caret"></b></a>
								<ul class="dropdown-menu">
									
									<li>{{ HTML::decode(HTML::linkRoute('users.edit', '<i class="fa fa-fw fa-gear"></i> Edit Profile')) }}</li>
									<li class="divider"></li>
									<li>{{ HTML::decode(HTML::linkRoute('users.logout', '<i class="fa fa-fw fa-sign-out"></i> Sign Out')) }}</li>
								</ul>
								@endif

							</li>

						</ul> 
					</div>
				</div>
			</nav> 
		</header>
		
		@include('components.alerts')

