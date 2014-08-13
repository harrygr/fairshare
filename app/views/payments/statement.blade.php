@extends('layouts.master')

@section('title')
Statement
@stop

@section('content')

<h1 class="col-md-12">Statement</h1>

@if (count($payers))

<div class="col-md-12 overflow-scroll">
  <div class="table-responsive">
    <table id="statement" class='table table-condensed table-striped' style='font-size:85%;'>
      <thead>
        <tr>
          <th colspan='4'></th>
          @foreach ($payers as $payer_id => $payer)
          <th colspan='3' id="payer-{{ $payer_id }}">{{ $payer }}</th>
          @endforeach
        </tr>
        <tr>
          <th class="statement-actions">Action</th>
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
        @foreach ($payment_data as $payment)
        <tr>
          <td class="statement-actions">
            <div class="action-cell">
              {{ HTML::decode(HTML::linkRoute('payments.edit', '<i class="fa fa-edit"></i>', $payment['id'], array('class' => 'btn btn-link') ) ) }}
              {{ Helper::deleteResource(array('payments.delete', $payment['id']), '<i class="fa fa-trash-o"></i>') }}
              @if ($payment['comment'])
              <a href="#" class="btn btn-link" data-toggle="popover" data-placement="right" data-content="{{{ $payment['comment'] }}}"><i class="fa fa-info-circle"></i></a>
              @endif
            </div>
          </td>
          <td class="date-cell"><time datetime="{{{ $payment['payment_date'] }}}">{{ $payment['payment_date'] }}</time></td>
          <td>{{{ $payment['company'] }}}</td>
          <td>{{{ $payment['item'] }}}</td>
          <?php $shaded = true; ?>
          @foreach ($payers as $payer_id => $payer)
          @if ( isset($payment['payers'][$payer_id]) )
          <td class="{{ $shaded ? 'active' : '' }}">{{ number_format($payment['payers'][$payer_id]['pivot']['amount'], 2) }}</td>
          <td class="{{ $shaded ? 'active' : '' }}">{{ number_format($payment['payers'][$payer_id]['pivot']['fair_share'], 2) }}</td>
          <td class="{{ $shaded ? 'active' : '' }} {{ $payment['payers'][$payer_id]['pivot']['owes'] > 0 ? 'text-danger' : 'text-success' }}">{{ number_format($payment['payers'][$payer_id]['pivot']['owes'], 2) }}</td>
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
         @foreach ($payers as $payer_id => $payer)
         @if ( isset($totals[$payer_id]) )
         <th class="{{ $shaded ? 'active' : '' }}">{{ number_format($totals[$payer_id]->total_paid, 2) }}</th>
         <th class="{{ $shaded ? 'active' : '' }}">{{ number_format($totals[$payer_id]->fair_share, 2) }}</th>
         <?php $owes = $totals[$payer_id]->fair_share - $totals[$payer_id]->total_paid; ?>
         <th class="{{ $shaded ? 'active' : '' }} {{ $owes > 0 ? 'text-danger' : 'text-success' }}">{{ number_format($owes, 2) }}</th>
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
 </div>
</div>


<div class="col-md-12 top-buffer">
  {{ Form::open(array('route'=>'payments.statement', 'class'=>'form-statementdate form-inline', 'method' => 'get')) }}
  <div class="form-group">
   {{ Form::label('from') }}
   {{ Form::input('date', 'from', Input::has('from') ? Input::get('from') : null, array('class'=>'form-control', 'placeholder' => 'From')) }}
 </div>
 <div class="form-group">
   {{ Form::label('to') }}
   {{ Form::input('date', 'to', Input::has('to') ? Input::get('to') : null, array('class'=>'form-control', 'placeholder' => 'To')) }}
 </div>
 {{ Form::submit('Filter', array('class'=>'btn btn-primary'))}}
 {{ Form::close() }}<br>
</div>



@else
<p>No payers yet. {{ HTML::linkRoute('payers.add', 'Add a Payer') }}</p>
@endif

<div class="col-md-12 top-buffer">
  <div class="well">
    @include('components.settle-up')
  </div>
</div>

@stop

