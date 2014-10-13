@extends('layouts.master')

@section('title')
Add Reimbursement
@stop

@section('content')
<div class="col-md-12">
   <div class="row">
      <div class="col-md-6">
         <h2 class="form-signup-heading">Add a Reimbursement</h2>
         @if (count($payers))
         {{ Form::open( array('route'=>'payments.storeReimbursement', 'class'=>'form-horizontal')) }}

         @include('components.reimbursement-form')
         <div class="form-group">
            {{ Form::submit('Add Reimbursement', array('class'=>'btn btn-primary'))}}
         </div>

         {{ Form::close() }}
         @else
         <p class="alert alert-info">You need at least one payer to add a reimbursement. {{ HTML::linkRoute('payers.add', 'Add one.') }}</p>
         @endif
      </div>
   </div>
</div>
@stop