@extends('layouts.master')

@section('content')
<div class="row">
   <div class="col-md-6">
      {{ Form::open(array('url'=>'payers/store', 'class'=>'form-signup')) }}
      <h2 class="form-signup-heading">Add a new payer</h2>

      <ul>
         @foreach($errors->all() as $error)
         <li>{{ $error }}</li>
         @endforeach
      </ul>


      <div class="form-group">
         {{ Form::text('name', null, array('class'=>'form-control', 'placeholder'=>'Name')) }}
      </div>

      <div class="form-group">
         {{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Email Address')) }}
      </div>


      {{ Form::submit('Add Payer', array('class'=>'btn btn-primary'))}}
      {{ Form::close() }}
   </div>
</div>
@stop