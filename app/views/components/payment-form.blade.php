      
<ul>
   @foreach($errors->all() as $error)
   <li>{{ $error }}</li>
   @endforeach
</ul>


<div class="form-group">
   {{ Form::input('date', 'payment_date', null, array('class'=>'form-control')) }}
</div>

<div class="form-group">
   {{ Form::text('company', null, array('class'=>'form-control', 'placeholder'=>'Company')) }}
</div>

<div class="form-group">
   {{ Form::text('item', null, array('class'=>'form-control', 'placeholder'=>'Item')) }}
</div>

@foreach ($payers as $payer)
<div class="form-inline">
   <div class="form-group">
      <?php 
      $amount = isset($pps[$payer->id]) ? $pps[$payer->id]['amount'] : number_format(0,2); 
      $pays = isset($pps[$payer->id]) ? $pps[$payer->id]['pays'] : false; 
      ?>
      {{ Form::label($payer->id . '-amount', $payer->name) }} <br>
      {{ Form::input('number', $payer->id . '-amount', $amount, array('class'=>'form-control', 'step' => 'any', 'value' => 0)) }}
      {{ Form::checkbox($payer->id . '-pays', $payer->id . '-pays', $pays) }}
      {{ Form::label($payer->id . '-pays', 'pays') }}

   </div>
</div>
 <br/>
@endforeach

