@extends('layouts.master')

@section('title')
Edit Payer
@stop

@section('content')
<div class="col-md-12">
	<h2>Edit Payer</h2>

	{{ Form::model($payer, array('route'=> array('payers.update', $payer->id), 'class'=>'form-signup', 'method' => 'put')) }}

	<ul>
		@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>


	<div class="form-group">
		{{ Form::label('name') }}
		{{ Form::text('name', Input::old('name'), array('class'=>'form-control' )) }}
	</div>

	<div class="form-group">
		{{ Form::label('email') }}
		{{ Form::text('email', Input::old('email'), array('class'=>'form-control')) }}
	</div>

	{{ Form::submit('Save Payer', array('class'=>'btn btn-primary')) }}

	{{ Form::close() }}
</div>

@stop