@extends('layouts.master')

@section('title')
Edit Payment
@stop

@section('content')

<div class="col-md-12">

		<h2>Edit payment</h2>
		{{ Form::model($payment, array('route'=>array('payments.update', $payment->id), 'class'=>'form-horizontal', 'method' => 'put')) }}

		@include('components.payment-form')

		<div class="col-md-12">
			{{ Form::submit('Edit Payment', array('class'=>'btn btn-primary'))}}
		</div>

		{{ Form::close() }}
</div>
@stop