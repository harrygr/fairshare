<div id="container" class="container">
	{{-- Show the alerts --}}
	<div class="row">
		@if(Session::has('message'))
		<div class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
		@endif
	</div>
</div>