@extends('layouts.master')

@section('title')
@parent
Users
@stop
 
@section('content')
    <h1>Users Index Page</h1>
    @foreach($users as $user)
        <p>{{ $user->username }}</p>
    @endforeach

    
@stop

@section('sidebar')
	<ul>
		<li>sidebar</li>
	</ul>
@stop