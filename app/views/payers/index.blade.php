@extends('layouts.master')

@section('content')
<h1>Payers Index page</h1>
<p>Here are the payers</p>

	<ul class="list-group">
    @foreach($payers as $payer)
        <li class="list-group-item">{{ HTML::linkRoute('payers.edit', $payer->name, array($payer->id) ) }} <span class="badge">{{ $payer->email }}</span></li>
    @endforeach
    </ul>

@stop