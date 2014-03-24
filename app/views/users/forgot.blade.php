@extends('layouts.master')

@section('title')
{{{ Lang::get('confide::confide.forgot.title') }}}
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<h2>{{{ Lang::get('confide::confide.forgot.title') }}}</h2>
		{{ Confide::makeForgotPasswordForm() }}
	</div>
</div>
@stop