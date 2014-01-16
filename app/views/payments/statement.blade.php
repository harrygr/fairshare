@extends('layouts.master')

@section('title')
@parent
Payments
@stop
 
@section('content')
    <h1>Statement</h1>
    <table class='table'>
    	<thead>
    		<tr>
    			<th colspan='3'></th>
    			@foreach ($payers as $payer)
				<th colspan='3' id="payer-{{ $payer->id }}">{{ $payer->name }}</th>
    			@endforeach
    		</tr>
    		<tr>
    			<th>Date</th>
    			<th>Company</th>
    			<th>Item</th>
    			@foreach ($payers as $payer)
				<th>Paid</th>
				<th>Fair Share</th>
				<th>Owes</th>
    			@endforeach
    		</tr>

    	</thead>
    	<tbody>
    		@foreach ($payments as $payment)
			<tr>
				<td>{{ $payment['payment_date'] }}</td>
				<td>{{ $payment['company'] }}</td>
				<td>{{ $payment['item'] }}</td>
				@foreach ($payers as $payer)
					@if ( isset($payment['payers'][$payer->id]) )
					<td>{{ $payment['payers'][$payer->id]['pivot']['amount'] }}</td>
					<td>{{ $payment['payers'][$payer->id]['pivot']['fair_share'] }}</td>
					<td>{{ $payment['payers'][$payer->id]['pivot']['owes'] }}</td>
					@else
					<td>0</td>
					<td>0</td>
					<td>0</td>
					@endif
				@endforeach
			</tr>
    		@endforeach

    	</tbody>
    	<tfoot>
    		<tr>
    			<td colspan="3" >Totals</td>
    			@foreach ($payers as $payer)
					@if ( isset($payment_totals[$payer->id]) )
					<td>{{ $payment_totals[$payer->id]['amount'] }}</td>
					<td>{{ $payment_totals[$payer->id]['fair_share'] }}</td>
					<td>{{ $payment_totals[$payer->id]['owes'] }}</td>
					@else
					<td>0</td>
					<td>0</td>
					<td>0</td>
					@endif
				@endforeach
    		</tr>
    	</tfoot>

    </table>
    @foreach ($payments as $payment)
    	
    @endforeach
@stop

@section('sidebar')
	<ul>
		<li>sidebar</li>
	</ul>
@stop