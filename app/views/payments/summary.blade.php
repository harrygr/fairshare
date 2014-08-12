@extends('layouts.master')

@section('title')
Add Payment
@stop

@section('content')
<h1 class="col-md-12">Payment Summary</h1>
<div class="col-md-12">
      <ul class="list-group">
            @if ($payments)
            @foreach ($payments as $payment)
            <?php $total = 0; ?>
            <li class="list-group-item">
                  <span class="pull-right">
                      @if ($payment['comment'])
                      <a href="#" class="btn btn-link" data-toggle="popover" data-placement="left" data-content="{{{ $payment['comment'] }}}"><i class="fa fa-info-circle fa-fw"></i></a>
                      @endif
                      {{ HTML::decode(HTML::linkRoute('payments.edit', '<i class="fa fa-edit fa-fw"></i>', $payment['id'], array('class' => '') ) ) }}
                      {{ Helper::deleteResource(array('payments.delete', $payment['id']), '<i class="fa fa-trash-o fa-fw"></i>', ['class' => 'form-inline'], ['class' => 'btn btn-link baseline']) }}
                </span>
                <h4>{{{ $payment->company }}} for {{{ $payment->item }}}</h4>
                <p class="text-muted">on <time datetime="{{{ $payment->payment_date }}}">{{{ $payment->payment_date }}}</time></p>
                <p> Shared between:
                  @foreach ($payment->payers as $payer)
                  @if ($payer->pivot->pays)
                  <span class="badge">{{{ $payer->name }}}</span>
                  @endif
                  <?php $total += $payer->pivot->amount; ?>
                  @endforeach
            </p>
            <b>Total: {{{ number_format($total,2) }}}</b>
      </li>
      @endforeach
      @endif
</ul>
</div>
@stop