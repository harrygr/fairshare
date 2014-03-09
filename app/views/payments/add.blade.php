@extends('layouts.master')

@section('content')
<div class="row">
   <div class="col-md-6">
      <h2 class="form-signup-heading">Add a new payment</h2>
      {{ Form::open( array('route'=>'payments.store', 'class'=>'form-signup')) }}

      @include('components.payment-form')
      <div class="form-group">
         {{ Form::submit('Add Payment', array('class'=>'btn btn-primary'))}}
      </div>

      {{ Form::close() }}
   </div>
</div>
@stop