@extends('layouts.master')

@section('content')
<div class="row">
   <div class="col-md-6">
      <h2 class="form-signup-heading">Add a new payment</h2>
      @if (count($payers))
      {{ Form::open( array('route'=>'payments.store', 'class'=>'form-signup')) }}

      @include('components.payment-form')
      <div class="form-group">
         {{ Form::submit('Add Payment', array('class'=>'btn btn-primary'))}}
      </div>

      {{ Form::close() }}
      @else
      <p class="alert alert-info">You need at least one payer to add a payment. {{ HTML::linkRoute('payers.add', 'Add one.') }}</p>
      @endif
   </div>
</div>
@stop