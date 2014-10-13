      
@include('components.validationerrors')
<?php 
$label_class = array('class'=>"col-sm-4 control-label");
$input_class = "col-sm-8";
 ?>

<div class="form-group">
    {{ Form::label('from', 'From', $label_class) }}
    <div class="{{ $input_class }}">
    {{ Form::select('from', $payers, null, array('class'=>'form-control')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('to', 'To', $label_class) }}
    <div class="{{ $input_class }}">
    {{ Form::select('to', $payers, null, array('class'=>'form-control')) }} 
    </div>
</div>

<div class="form-group">
    {{ Form::label('amount', 'Amount', $label_class) }}
    <div class="{{ $input_class }}">
    {{ Form::input('number', 'amount', null, array('class'=>'form-control', 'step' => 'any', 'value' => 0, 'placeholder' => '0.00')) }} 
    </div>
</div>

<div class="form-group">
    {{ Form::label('payment_date', 'Reimbursement Date', $label_class) }}
    <div class="{{ $input_class }}">
    {{ Form::input('date', 'payment_date', date('Y-m-d'), array('class'=>'form-control')) }}
    </div>
</div>

{{ Form::hidden('item', 'Reimbursement') }}
{{ Form::hidden('company', 'Reimbursement') }}
{{ Form::hidden('is_reimbursement', true) }}