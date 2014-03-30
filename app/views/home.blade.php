@extends('layouts.full-width')

@section('title')
Home
@stop

@section('content')

<div class="jumbotron">
  <h1>Welcome to FairShare</h1>
  <p>FairShare is a simple app for squaring up shared payments between a group of people.</p>
  <p><a href="{{ URL::route('about') }}" class="btn btn-primary btn-lg" role="button">Learn more</a></p>
</div>

@stop

