@extends('layouts.master')

@section('content')
<h1>Payers Index page</h1>
<p>Here are the payers</p>

    @foreach($payers as $payer)
        <p>{{ $payer->name }}</p>
    @endforeach

@stop