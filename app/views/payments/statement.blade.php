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
    			<?php $shaded = true; ?>
    			@foreach ($payers as $payer)
				<th class="{{ $shaded ? 'active' : '' }}">Paid</th>
				<th class="{{ $shaded ? 'active' : '' }}">Fair Share</th>
				<th class="{{ $shaded ? 'active' : '' }}">Owes</th>
				<?php $shaded = !$shaded; ?>
    			@endforeach
    		</tr>

    	</thead>
    	<tbody>
    		@foreach ($payments as $payment)
			<tr>
				<td>{{ $payment['payment_date'] }}</td>
				<td>{{ $payment['company'] }}</td>
				<td>{{ $payment['item'] }}</td>
				<?php $shaded = true; ?>
				@foreach ($payers as $payer)
					@if ( isset($payment['payers'][$payer->id]) )
					<td class="{{ $shaded ? 'active' : '' }}">{{ number_format($payment['payers'][$payer->id]['pivot']['amount'], 2) }}</td>
					<td class="{{ $shaded ? 'active' : '' }}">{{ number_format($payment['payers'][$payer->id]['pivot']['fair_share'], 2) }}</td>
					<td class="{{ $shaded ? 'active' : '' }} {{ $payment['payers'][$payer->id]['pivot']['owes'] > 0 ? 'text-danger' : 'text-success' }}">{{ number_format($payment['payers'][$payer->id]['pivot']['owes'], 2) }}</td>
					@else
					<td class="{{ $shaded ? 'active' : '' }}">0.00</td>
					<td class="{{ $shaded ? 'active' : '' }}">0.00</td>
					<td class="{{ $shaded ? 'active' : '' }}">0.00</td>
					@endif
					<?php $shaded = !$shaded; ?>
				@endforeach
			</tr>
    		@endforeach

    	</tbody>
    	<tfoot>
    		<tr>
    			<th colspan="3" >Totals</th>
    			<?php $shaded = true; ?>
    			@foreach ($payers as $payer)
					@if ( isset($payment_totals[$payer->id]) )
					<th class="{{ $shaded ? 'active' : '' }}">{{ number_format($payment_totals[$payer->id]['amount'], 2) }}</th>
					<th class="{{ $shaded ? 'active' : '' }}">{{ number_format($payment_totals[$payer->id]['fair_share'], 2) }}</th>
					<th class="{{ $shaded ? 'active' : '' }} {{ $payment_totals[$payer->id]['owes'] > 0 ? 'text-danger' : 'text-success' }}">{{ number_format($payment_totals[$payer->id]['owes'], 2) }}</th>
					@else
					<th>0.00</th>
					<th>0.00</th>
					<th>0.00</th>
					@endif
					<?php $shaded = !$shaded; ?>
				@endforeach
    		</tr>
    	</tfoot>

    </table>
    @foreach ($payments as $payment)
    	
    @endforeach
@stop

@section('sidebar')
    <h2>Settle Up</h2>
    @if ($settles)
        <ul>
        @foreach ($settles as $s)
        <li>{{ $payers[$s['from']]->name }} pays {{ $payers[$s['to']]->name }} {{ number_format($s['amount'], 2) }}</li>
        @endforeach
        </ul>
    @endif
@stop