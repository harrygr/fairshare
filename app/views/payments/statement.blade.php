@extends('layouts.master')

@section('title')
@parent
Payments
@stop
 
@section('content')
    <h1>Statement</h1>
    
    @if (count($payers))
    <table class='table table-condensed'>
    	<thead>
    		<tr>
    			<th colspan='4'></th>
    			@foreach ($payers as $payer)
				<th colspan='3' id="payer-{{ $payer->id }}">{{ $payer->name }}</th>
    			@endforeach
    		</tr>
    		<tr>
                <th>Action</th>
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
                <td>
                    <div class="action-cell">
                    {{ HTML::decode(HTML::linkRoute('payments.edit', '<i class="glyphicon glyphicon-pencil"></i>', $payment['id'], array('class' => 'btn btn-link') ) ) }}
                    {{ Helper::deleteResource('payments/'.$payment['id'], '<i class="glyphicon glyphicon-remove"></i>') }}
                    </div>
                </td>
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
    			<th colspan="4" >Totals</th>
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
    @else
    <p>No payers yet. {{ HTML::linkRoute('payers.add', 'Add a Payer') }}</p>
    @endif
@stop

@section('sidebar')
    
    <h2>Settle Up</h2>
    @if ( $settles && count($payers) )
        <ul>
        @foreach ($settles as $s)
        <li>{{ $payers[$s['from']]->name }} pays {{ $payers[$s['to']]->name }} {{ number_format($s['amount'], 2) }}</li>
        @endforeach
        </ul>
    @else
    <p>All square!</p>
    @endif
@stop