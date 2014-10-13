@extends('layouts.master')

@section('title')
Add Payment
@stop

@section('content')
<div class="col-md-12">

      <h2>Add a new payment</h2>
      @if (count($payers))
      {{ Form::open( array('route'=>'payments.store', 'class'=>'form-horizontal')) }}

      @include('components.payment-form')
      <div class="col-md-12">
         {{ Form::submit('Add Payment', array('class'=>'btn btn-primary'))}}
      </div>

      {{ Form::close() }}
      @else
      <p class="alert alert-info">You need at least one payer to add a payment. {{ HTML::linkRoute('payers.add', 'Add one.') }}</p>
      @endif

</div>
@stop