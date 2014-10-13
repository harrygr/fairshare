	$(function(){
		$('form.confirm-form').submit(function(){
			var currentForm = this;
			event.preventDefault();
			bootbox.confirm("Are you sure?", function(result){
				if(result) {
					currentForm.submit();
				}
			});
		});

		$("[data-toggle='tooltip']").tooltip({
			selector: '',
			container: 'body'
		});
	});