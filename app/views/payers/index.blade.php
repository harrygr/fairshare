@extends('layouts.master')

@section('title')
Payers
@stop

@section('content')

	<div class="col-md-6">
		<h1>Payers</h1>
		<ul class="list-group">
			@foreach($payers as $payer)
			<li class="list-group-item">{{ HTML::linkRoute('payers.edit', $payer->name, array($payer->id) ) }} <span class="badge">{{ $payer->email }}</span></li>
			@endforeach
		</ul>
		<p>{{ HTML::decode(HTML::linkRoute('payers.add', '<i class="fa fa-plus"></i> Add a Payer', null, array('class' => 'btn btn-success'))) }}</p>
	</div>

@stop