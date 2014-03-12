@include('layouts.header')

		<section class="row">
			<div class="col-md-9">
				@yield('content')
			</div>
			<aside class="col-md-3">
				@yield('sidebar')
			</aside>
		</section>

@include('layouts.footer')	
