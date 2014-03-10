@extends('layouts.master')

@section('content')
<h1>Dashboard for {{ Auth::User()->username }}</h1>

<p>Account Email: {{ Auth::User()->email }}</p>

<h3>Payers</h3>
    @if ( count(Auth::User()->payer) > 0 )
	<ul class="list-group">
    @foreach(Auth::User()->payer as $payer)
        <li class="list-group-item">{{ HTML::linkRoute('payers.edit', $payer->name, array($payer->id) ) }} <span class="badge">{{ $payer->email }}</span></li>
    @endforeach
    </ul>
    @else
   <p>No payers yet.</p>
    @endif
    <p>{{ HTML::linkRoute('payers.add', 'Add a Payer') }}</p>
@stop