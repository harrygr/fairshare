@extends('layouts.master')

@section('content')
<h1>Dashboard for {{ Auth::User()->username }}</h1>

<p>Account Email: {{ Auth::User()->email }}</p>

<h3>Payers</h3>
	<ul class="list-group">
    @foreach(Auth::User()->payer as $payer)
        <li class="list-group-item">{{ HTML::linkRoute('payers.edit', $payer->name, array($payer->id) ) }} <span class="badge">{{ $payer->email }}</span></li>
    @endforeach
    </ul>

@stop