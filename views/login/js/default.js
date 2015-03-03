$(document).ready(function(){
	var loc = window.location.pathname;	
	
	// Custom Validation Method
	$.validator.addMethod("alpha", function(value, element) {
		return this.optional(element) || value == value.match(/^[a-zA-Z]+$/);
	}, "Only Characters Allowed");	
	$.validator.addMethod("alphanumeric", function(value, element) {
		return this.optional(element) || value == value.match(/^[a-z0-9A-Z#]+$/);
	},"Only Characters, Numbers & Hash Allowed");	
	
	/*************************************************** Login Form Validation ***************************************************/

	// Initialize validation plugin
    var v2 = $('#login_form').validate({ 
		onkeyup: false,
		onfocusout: false,	
		onclick: false,
		focusInvalid : false,
		rules:{
			email:{
				required: true,
				email: true,
				remote: {
					url: "login/checkEmail",
					type: "post",
					data: {}
				}
			},
			password:{
				required: true,				
				minlength: 4,
				remote: {
					url: "login/checkPassword",
					type: "post",
					data: {
						email: function(){
							return $('#login_form :input[name="email"]').val();
						}
					}
				}				
			}			
		},
		messages:{
			email: {
				required: 'Required',
				email: 'Not a valid email',
				remote: $.format('"{0}" doesn\'t exist')
			},
			password: {
				required: 'Required',				
				minlength: 'Minimum 4 characters',
				remote: $.format('Wrong password')
			}			
		},
		errorPlacement: function(error,element) {			
			//error.insertAfter(element);			
			return true;
		},
		submitHandler: function(form) {				
			var loaderContainer = $('.btnLogin').parent();
			$(loaderContainer).html('<img src="'+loc.substring(0, loc.indexOf('login'))+'public/images/loader3.gif" style="margin-right:45px;" />');			
			$.post(loc.substring(0, loc.indexOf('login'))+'login/login', $('#login_form').serialize(), function(o) {
				// Server process complete. Redirect to new url.				
				if (o != 1 && o != 2){
					window.location.replace(o);
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
	
	/********************************************* Password Recovery Form Validation *********************************************/

	// Initialize validation plugin
	$('#btnShowPwdRecoveryDialog').on('click', function(){
		var states = {
			state0: {
				title: 'Password Recovery',
						html:'<form class="pure-form pure-form-stacked" id="pwdRecoveryForm">'+
								'<div class="pure-control-group"><label>Email of the account holder</label> <input type="email" placeholder="Email" value="" id="inputPwdRecovery" name="email"></div>'+
								'<div class="pure-control-group" style="font-size:0.8em;">What\'s the sum of <span id="math_equation">'+$("#math").data('math')+'</span>? <input type="text" value="" name="answer" style="margin-left:5px;width:35px;padding:2px;font-size:1.1em;display:inline;" /></div>'+								
							'</form>',
				buttons: { Cancel: false, Send: true },
				focus: 1,
				submit:function(e,v,m,f){
					if (v){
						// Initialize validation plugin
						var vs = $('#pwdRecoveryForm').validate({ 
							onkeyup: false,
							onfocusout: false,	
							onclick: false,
							focusInvalid : false,	
							rules:{			
								email:{
									required: true,
									email: true,
									remote: {
										url: "login/checkEmail",
										type: "post",
										data: {}
									}
								},
								answer:{
									required: true,
									number: true,
									remote: {
										url: "login/captcha",
										type: "post",
										data: {
											answer: function(){
												return $('#pwdRecoveryForm :input[name="answer"]').val();
											}
										}
									}
								}
							},
							errorPlacement: function(error,element) {			
								return true;
							},	
							submitHandler: function(form) {
								var img = $('<img src="'+loc.substring(0, loc.indexOf('listings'))+'public/images/loader3.gif" style="float:left;margin-left:10px;" />');
								$('.jqibuttons').prepend(img);
								$.post(loc.substring(0, loc.indexOf('login'))+'login/pwdrecovery', $('#pwdRecoveryForm').serialize(), function(o) {	
									if (o){
										// Remove loader
										$(img).remove();
										// New Captcha
										$("#math").data('math',o);
										// Reset
										vs.resetForm();
										$('#pwdRecoveryForm')[0].reset();						
										$('#pwdRecoveryForm input').css('background-color','#fff');
										// Show success message
										$.prompt.goToState('state1', true);
									}
								});								
								return false;
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
				
						$('#pwdRecoveryForm').submit();
						
						return false;
					}	
					$.prompt.close();
				}
			},
			state1: {
				title: "Thank You!",
				html: "Please check your email inbox for new password.",
				buttons: { Close: 0 },
				focus: 0
			}

		};
		$.prompt(states, {
			opacity:0.85,
			show: 'fadeIn',
			overlayspeed: 150,
			zIndex: 7001,
			statechanging: function(e,v,m){
				if (m == "state1"){					
					$('#jqistate_state0, .jqiclose').animate({
						opacity: 0
					}, 100,function(){

					}); 			
						$('.jqi, #jqistate_state0').animate({
							backgroundColor: 'transparent',
							border: 0
						}, 200);  										
				}
			},
			classes: {
				box: '',
				fade: '',
				prompt: '',
				close: '',
				title: '',
				message: '',
				buttons: '',
				button: 'btn5',
				defaultButton: 'btn5-primary'
			}
		});
		return false;
	});	
		
	// Submit Buttons 	
	$('#login_form').on('click', '.btnLogin', function(){				
		$('#login_form').submit();		
		return false;
	});		
});