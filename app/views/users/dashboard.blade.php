@extends('layouts.master')

@section('title')
Dashboard
@stop

@section('content')
<h1>Dashboard for {{ Auth::User()->username }}</h1>

<p>Account Email: {{ Auth::User()->email }}</p>

<h2>Payer Summary</h2>
@if ( count($totals) )
<div class="row">

    @foreach($totals as $summary)
    <div class="col-md-4">
        <div class="well">
            <h3><i class="fa fa-user"></i> {{ $summary->name }} </h3>
            <p><strong>Total Paid:</strong> {{ number_format($summary->total_paid,2) }}</p>
            <p><strong>Fair Share:</strong> {{ number_format($summary->fair_share,2) }}</p>
            <p><strong>Owes:</strong> <span class="{{ $summary->fair_share - $summary->total_paid > 0 ? 'text-danger' : 'text-success' }}">{{ number_format($summary->fair_share - $summary->total_paid,2) }}</span></p>
        </div>
    </div>
    @endforeach
</div>
@else
<p>Nothing to see here yet</p>
@endif
<p>{{ HTML::decode(HTML::linkRoute('payers.add', '<i class="fa fa-plus"></i> Add a Payer', null, array('class' => 'btn btn-success'))) }}</p>
<div class="well">

    @include('components.settle-up')
</div>
@stop