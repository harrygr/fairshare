      
<ul>
   @foreach($errors->all() as $error)
   <li>{{ $error }}</li>
   @endforeach
</ul>
<?php $label_attributes = array('class'=>'col-sm-2 control-label') ?>
<div class="col-md-6">
<div class="form-group">
    {{ Form::label('payment_date', 'Payment Date', $label_attributes) }}
    <div class="col-sm-10">
   {{ Form::input('date', 'payment_date', date('Y-m-d'), array('class'=>'form-control')) }}
   </div>
</div>

<div class="form-group">
    {{ Form::label('company', 'Company', $label_attributes) }}
    <div class="col-sm-10">
   {{ Form::text('company', null, array('class'=>'form-control', 'placeholder'=>'Company')) }}
   </div>
</div>

<div class="form-group">
    {{ Form::label('item', 'Item', $label_attributes) }}
    <div class="col-sm-10">
   {{ Form::text('item', null, array('class'=>'form-control', 'placeholder'=>'Item')) }}
   </div>
</div>
</div>
<div class="col-md-6">
<legend>Payer Details</legend>
@foreach ($payers as $payer)

   <div class="form-group">
      <?php 
      $amount = isset($pps[$payer->id]) ? $pps[$payer->id]['amount'] : number_format(0,2); 
      $pays = isset($pps[$payer->id]) ? $pps[$payer->id]['pays'] : false; 
      ?>
      {{ Form::label($payer->id . '-amount', $payer->name, $label_attributes) }} 
       <div class="col-sm-6">
      {{ Form::input('number', $payer->id . '-amount', $amount, array('class'=>'form-control', 'step' => 'any', 'value' => 0)) }}
      </div>
       <div class="col-sm-4 control-label">

        <label>{{ Form::checkbox($payer->id . '-pays', $payer->id . '-pays', $pays) }} Pays</label>

      </div>
   </div>


 <br/>
@endforeach
</div>

