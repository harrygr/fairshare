@extends('layouts.master')

@section('title')
Edit Payment
@stop

@section('content')


<div class="row">
	<div class="col-md-6">
		<h2 class="form-signup-heading">Edit payment</h2>
		{{ Form::model($payment, array('route'=>array('payments.update', $payment->id), 'class'=>'form-signup', 'method' => 'put')) }}

		@include('components.payment-form')

		<div class="form-group">
			{{ Form::submit('Edit Payment', array('class'=>'btn btn-primary'))}}
		</div>

		{{ Form::close() }}
	</div>

</div>
@stop