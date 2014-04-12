@include('layouts.header')
<div class="container">
		<section class="row">
			<div class="col-md-12">
				@yield('content')
			</div>
<!-- 		<aside class="col-md-3">
				@yield('sidebar')
			</aside> -->
		</section>
	</div>

@include('layouts.footer')	
