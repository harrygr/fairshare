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
	{{ HTML::script('js/bootstrap.min.js'); }}
</head>
<body>
	<div id="container" class="container">
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