@extends('layouts.master')

@section('title')
Home
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<h1>Welcome to FairShare</h1>
		<p>
			FairShare is an easy solution to splitting the cost of shared payments like bills, rent and other group costs. 
			Just enter some payments, how much each person contributed and whether they should be included, and the app works
			out who owes who how much. It'll also work out the simplest way for each person to square up with other.
		</p>
		<h2>How does it work</h2>
		<ul>
			<li>Make a single shared account for your household or group</li>
			<li>Add some payers, one for each person in your group. You can add extra payers further down the line for when more people join.</li>
			<li>When someone makes a payment they're owed for just enter it in stating the amount each payer paid and whether they should be included.</li>
			<li>When you've built up a few payments and decided to pay someone back just add the reimbursement and FairShare will keep track.</li>
		</ul>
		@if (!Auth::user())
		<a href="{{ URL::route('users.create') }}" class="btn btn-lg btn-success">Sign Up Now</a>
		@endif
	</div>
</div>

@stop