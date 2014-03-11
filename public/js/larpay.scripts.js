	$(function(){
		$('form.confirm-form').submit(function(){
			return confirm('Are you sure?');
		});
	})