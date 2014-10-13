@extends('layouts.master')

@section('title')
Login
@stop

@section('content')

<div class="col-md-6">
  @include('forms.login')    
</div>

@stop