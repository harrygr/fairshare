@extends('layouts.master')

@section('title')
Add Payer
@stop

@section('content')

   <div class="col-md-6">
      {{ Form::open(array('route'=>'payers.store', 'class'=>'form-signup')) }}
      <h2 class="form-signup-heading">Add a new payer</h2>

      <ul>
         @foreach($errors->all() as $error)
         <li>{{ $error }}</li>
         @endforeach
      </ul>


      <div class="form-group">
         {{ Form::label('name') }}
         {{ Form::text('name', null, array('class'=>'form-control', 'placeholder'=>'Name')) }}
      </div>

      <div class="form-group">
         {{ Form::label('email') }}
         {{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'email@email.com')) }}
      </div>


      {{ Form::submit('Add Payer', array('class'=>'btn btn-primary'))}}
      {{ Form::close() }}
   </div>

@stop