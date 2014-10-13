@if(Session::has('message'))
<div class="col-md-12">
	{{-- Show the alerts --}}
	<div class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
</div>
@endif