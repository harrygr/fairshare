@extends('layouts.master')

@section('content')
<div class="row">
	<div class="col-md-6">
		<h1>Payers Index page</h1>
		<p>Here are the payers</p>

		<ul class="list-group">
			@foreach($payers as $payer)
			<li class="list-group-item">{{ HTML::linkRoute('payers.edit', $payer->name, array($payer->id) ) }} <span class="badge">{{ $payer->email }}</span></li>
			@endforeach
		</ul>
		<p>{{ HTML::decode(HTML::linkRoute('payers.add', '<i class="fa fa-plus"></i> Add a Payer', null, array('class' => 'btn btn-success'))) }}</p>
	</div>
</div>
@stop