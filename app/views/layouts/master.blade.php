@include('layouts.header')

		<div class="row">
			<div class="col-md-9">
				@yield('content')
			</div>
			<div class="col-md-3">
				@yield('sidebar')
			</div>
		</div>

@include('layouts.footer')	
