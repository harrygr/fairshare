      
<ul>
   @foreach($errors->all() as $error)
   <li>{{ $error }}</li>
   @endforeach
</ul>


<div class="form-group">
    {{ Form::label('from', 'From', array('class'=>"col-sm-2 control-label")) }}
    <div class="col-sm-10">
    {{ Form::select('from', $payers, null, array('class'=>'form-control')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('to', 'To', array('class'=>"col-sm-2 control-label")) }}
    <div class="col-sm-10">
    {{ Form::select('to', $payers, null, array('class'=>'form-control')) }} 
    </div>
</div>

<div class="form-group">
    {{ Form::label('amount', 'Amount', array('class'=>"col-sm-2 control-label")) }}
    <div class="col-sm-10">
    {{ Form::input('number', 'amount', 0, array('class'=>'form-control', 'step' => 'any', 'value' => 0)) }} 
    </div>
</div>

<div class="form-group">
    {{ Form::label('payment_date', 'Reimbursement Date', array('class'=>"col-sm-2 control-label")) }}
    <div class="col-sm-10">
    {{ Form::input('date', 'payment_date', date('Y-m-d'), array('class'=>'form-control')) }}
    </div>
</div>