$(document).ready(function(){
	var loc = window.location.pathname;	
	
	// Initialize validation plugin
    var v = $('#account_form').validate({ 
		onkeyup: false,
		onfocusout: false,	
		onclick: false,
		focusInvalid : false,
		rules:{
			password:{
				required: true,				
				minlength: 4,
				remote: {
					url: "checkPassword",
					type: "post",
					data: {}
				}
			},
			new_password:{
				required: true,				
				minlength: 4				
			},
			confirm_new_password:{
				equalTo: '#new_password'			
			}			
		},
		messages:{
			password: {
				required: 'Required',
				minlength: 'Minimum 4 characters',
				remote: $.format('Wrong password')
			},
			new_password: {
				required: 'Required',				
				minlength: 'Minimum 4 characters',				
			},
			confirm_new_password: {
				equalTo: 'Password is different'
			}						
		},
		errorPlacement: function(error,element) {			
			error.insertAfter(element);			
		},
		submitHandler: function(form) {				
			var loaderContainer = $('#btnChangePwd').parent();
			$(loaderContainer).html('<img src="'+loc.substring(0, loc.indexOf('admin'))+'public/images/loader3.gif" style="margin-right:45px;" />');
			$.post(loc.substring(0, loc.indexOf('admin'))+'admin/changePassword', $('#account_form').serialize(), function(o) {
				if (o){
					// Reset All
					v.resetForm();
					form.reset();				
					
					// Remove Loader
					$(loaderContainer).html('<button type="submit" class="pure-button pure-button-small pure-button-primary" id="btnChangePwd">Submit</button>');											
				}
			});	
		},		
		highlight: function(element, errorClass) {							
			$(element).animate({
				backgroundColor: "#FAEEEE"
			}, 250);			
		},
		unhighlight: function(element, errorClass) {
			$(element).animate({
				backgroundColor: "#fff !important"
			}, 250);
		}						
    });
	
	// Button Clicks		
	$('#account_form').on('click', '#btnChangePwd', function(){		
		$('#account_form').submit();		
		return false;
	});
	
});