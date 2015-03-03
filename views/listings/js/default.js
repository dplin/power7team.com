$(document).ready(function(){						
	$('.listing_table tbody tr').hover(function() {
		$(this).addClass('tr_hover');
	}, function() {
		$(this).removeClass('tr_hover');
	});
	$('.listing_table').on('click', 'tr', function() {
		window.location = $(this).data('url');		
	});		

	var loc = window.location.pathname;	
	var geocoder;
	var map;
	
	/*********** Load MAP ************/
	initialize();
	codeAddress();

	function initialize() {
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(0, 0);
		var mapOptions = {
			scrollwheel: false,
			zoom: 15,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	}
	function codeAddress() {
		var address = document.getElementById('address').textContent;
		var city = document.getElementById('city').textContent;
		
		geocoder.geocode( { 'address': address+' '+city}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location
				});
			} else {
				//alert('Geocode was not successful for the following reason: ' + status);
			}
		});
	}
	
	$('#carousel').flexslider({
		animation: "slide",
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		itemWidth: 70,    
		itemMargin: 5,    
		prevText: "",
		nextText: "",
		asNavFor: '#slider'
	});

	$('#slider').flexslider({
		animation: "fade",
		controlNav: false,
		animationLoop: false,
		slideshow: true,
		slideshowSpeed: 5000,
		animationSpeed: 600,
		prevText: "",
		nextText: "",	
		sync: "#carousel"
	});
  
	$('.btnGotoMap').on('click', function(){
		$('html, body').animate({
			scrollTop: $('#map').offset().top
		}, 500);  
		return false;
	});

	$('.btnGoBack').on('click', function(){
		window.history.go(-1);
	});
	
	$('.btnEmailListing').on('click', function(){
		var states = {
			state0: {
				title: 'Email Listing',
						html:'<form class="pure-form pure-form-stacked" id="emaillisting_form">'+
								'<div class="pure-control-group"><label>Name</label> <input type="text" class="pure-input-1-2" name="full_name" /></div>'+
								'<div class="pure-control-group"><label>Phone</label> <input type="text" class="pure-input-1-2" name="phone" /></div>'+
								'<div class="pure-control-group"><label>Email</label> <input type="text" class="pure-input-1" name="email" /></div>'+								
								'<div class="pure-control-group"><label>Subject</label> <label style="border-radius:4px;border:1px solid #DFDFDF; padding:5px;font-weight:bold;font-size:0.7em;" class="subject">[Email Listing] '+$('#address').text()+', '+$('#city').text()+'</label></div>'+
								'<div class="pure-control-group"><label>Comment</label> <textarea rows="14" style="width:100%;" name="comment"></textarea> </div>'+
								//'<div class="pure-control-group" style="font-size:0.8em;">What\'s the sum of <span id="math_equation">'+$("#math").data('math')+'</span>? <input type="text" value="" name="answer" style="margin-left:5px;width:35px;padding:2px;font-size:1.1em;display:inline;" /></div>'+
							'</form>',
				buttons: { Cancel: false, Send: true },
				focus: 1,
				submit:function(e,v,m,f){
					if (v){
						// Initialize validation plugin
						var vs = $('#emaillisting_form').validate({ 
							onkeyup: false,
							onfocusout: false,	
							onclick: false,
							focusInvalid : false,	
							rules:{			
								full_name:{
									required: true,				
									minlength: 2
								},			
								email:{				
									required: true,
									email: true
								}/*,
								answer:{
									required: true,
									number: true,
									remote: {
										url: "../captcha",
										type: "post",
										data: {
											answer: function(){
												return $('#emaillisting_form :input[name="answer"]').val();
											}
										}
									}
								}*/
							},
							errorPlacement: function(error,element) {			
								return true;
							},	
							submitHandler: function(form) {
								var img = $('<img src="'+loc.substring(0, loc.indexOf('listings'))+'public/images/loader3.gif" style="float:left;margin-left:10px;" />');
								$('.jqibuttons').prepend(img);
								$.post(loc.substring(0, loc.indexOf('listings'))+'listings/send', $("#emaillisting_form").serialize()+'&subject='+$('#emaillisting_form .subject').text()+'&submit_form=', function(o) {											
									if (o){										
										// Remove loader
										$(img).remove();
										// New Captcha
										//$("#math").data('math',o);
										// Reset
										vs.resetForm();
										$('#emaillisting_form')[0].reset();						
										$('#emaillisting_form input').css('background-color','#fff');
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
				
						$('#emaillisting_form').submit();
						
						return false;
					}	
					$.prompt.close();
				}
			},
			state1: {
				title: "Thank You!",
				html: "We will get back to you shortly!",
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
	$('.btnSchedule').on('click', function(){		
		var states = {
			state0: {
				title: 'Schedule a Showing',
						html:'<form class="pure-form pure-form-stacked" id="schedule_form">'+
								'<div class="pure-control-group"><label>Name</label> <input type="text" class="pure-input-1-2" name="full_name" /></div>'+
								'<div class="pure-control-group"><label>Phone</label> <input type="text" class="pure-input-1-2" name="phone" /></div>'+
								'<div class="pure-control-group"><label>Email</label> <input type="text" class="pure-input-1" name="email" /></div>'+
								'<div class="pure-control-group"><label>Subject</label> <label style="border-radius:4px;border:1px solid #DFDFDF; padding:5px;font-weight:bold;font-size:0.7em;" class="subject">[Schedule] '+$('#address').text()+', '+$('#city').text()+'</label></div>'+
								'<div class="pure-control-group"><label for="prefered_date">Prefered Date</label><input id="prefered_date" class="datepicker" style="background-color:#fff;" name="prefered_date" type="text" placeholder="yyyy-mm-dd"></div>'+
								'<div class="pure-control-group"><label>Comment</label> <textarea rows="14" style="width:100%;" name="comment"></textarea> </div>'+
								//'<div class="pure-control-group" style="font-size:0.8em;">What\'s the sum of <span id="math_equation">'+$("#math").data('math')+'</span>? <input type="text" value="" name="answer" style="margin-left:5px;width:35px;padding:2px;font-size:1.1em;display:inline;" /></div>'+								
							'</form>',
				buttons: { Cancel: false, Send: true },
				focus: 1,
				submit:function(e,v,m,f){
					if (v){
						// Initialize validation plugin
						var vs = $('#schedule_form').validate({ 
							onkeyup: false,
							onfocusout: false,	
							onclick: false,
							focusInvalid : false,	
							rules:{			
								full_name:{
									required: true,				
									minlength: 2
								},			
								email:{				
									required: true,
									email: true
								},
								prefered_date:{
									required: true
								}/*,
								answer:{
									required: true,
									number: true,
									remote: {
										url: "../captcha",
										type: "post",
										data: {
											answer: function(){
												return $('#schedule_form :input[name="answer"]').val();
											}
										}
									}
								}*/
							},
							errorPlacement: function(error,element) {			
								return true;
							},	
							submitHandler: function(form) {
								var img = $('<img src="'+loc.substring(0, loc.indexOf('listings'))+'public/images/loader3.gif" style="float:left;margin-left:10px;" />');
								$('.jqibuttons').prepend(img);
								$.post(loc.substring(0, loc.indexOf('listings'))+'listings/send', $("#schedule_form").serialize()+'&subject='+$('#schedule_form .subject').text()+'&submit_form=schedule', function(o) {											
									if (o){										
										// Remove loader
										$(img).remove();
										// New Captcha
										//$("#math").data('math',o);
										// Reset
										vs.resetForm();
										$('#schedule_form')[0].reset();						
										$('#schedule_form input').css('background-color','#fff');
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
				
						$('#schedule_form').submit();
						
						return false;
					}	
					$.prompt.close();
				}
			},
			state1: {
				title: "Thank You!",
				html: "We will get back to you shortly!",
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
		
		// Initialize DatePicker
		$('input.datepicker').Zebra_DatePicker({
			direction: true
		});
		
		return false;
	});
	$('.btnRequestInfo').on('click', function(){
		var states = {
			state0: {
				title: 'Request More Info',
						html:'<form class="pure-form pure-form-stacked" id="request_info_form">'+
								'<div class="pure-control-group"><label>Name</label> <input type="text" class="pure-input-1-2" name="full_name" /></div>'+
								'<div class="pure-control-group"><label>Phone</label> <input type="text" class="pure-input-1-2" name="phone" /></div>'+
								'<div class="pure-control-group"><label>Email</label> <input type="text" class="pure-input-1" name="email" /></div>'+
								'<div class="pure-control-group"><label>Subject</label> <label style="border-radius:4px;border:1px solid #DFDFDF; padding:5px;font-weight:bold;font-size:0.7em;" class="subject">[Request Info] '+$('#address').text()+', '+$('#city').text()+'</label></div>'+
								'<div class="pure-control-group"><label>Comment</label> <textarea rows="14" style="width:100%;" name="comment"></textarea> </div>'+
								//'<div class="pure-control-group" style="font-size:0.8em;">What\'s the sum of <span id="math_equation">'+$("#math").data('math')+'</span>? <input type="text" value="" name="answer" style="margin-left:5px;width:35px;padding:2px;font-size:1.1em;display:inline;" /></div>'+								
							'</form>',
				buttons: { Cancel: false, Send: true },
				focus: 1,
				submit:function(e,v,m,f){
					if (v){
						// Initialize validation plugin
						var vs = $('#request_info_form').validate({ 
							onkeyup: false,
							onfocusout: false,	
							onclick: false,
							focusInvalid : false,	
							rules:{			
								full_name:{
									required: true,				
									minlength: 2
								},			
								email:{				
									required: true,
									email: true
								}/*,
								answer:{
									required: true,
									number: true,
									remote: {
										url: "../captcha",
										type: "post",
										data: {
											answer: function(){
												return $('#request_info_form :input[name="answer"]').val();
											}
										}
									}
								}*/
							},
							errorPlacement: function(error,element) {			
								return true;
							},	
							submitHandler: function(form) {
								var img = $('<img src="'+loc.substring(0, loc.indexOf('listings'))+'public/images/loader3.gif" style="float:left;margin-left:10px;" />');
								$('.jqibuttons').prepend(img);
								$.post(loc.substring(0, loc.indexOf('listings'))+'listings/send', $("#request_info_form").serialize()+'&subject='+$('#request_info_form .subject').text()+'&submit_form=', function(o) {											
									if (o){										
										// Remove loader
										$(img).remove();
										// New Captcha
										//$("#math").data('math',o);
										// Reset
										vs.resetForm();
										$('#request_info_form')[0].reset();						
										$('#request_info_form input').css('background-color','#fff');
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
				
						$('#request_info_form').submit();
						
						return false;
					}	
					$.prompt.close();
				}
			},
			state1: {
				title: "Thank You!",
				html: "We will get back to you shortly!",
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
	$('.btnViewBrochure').on('click', function(){
		var states = {
			state0: {
				title: 'View Listing Brochure',
						html:'<form class="pure-form pure-form-stacked" id="bro_form">'+
								'<div class="pure-control-group"><label>Name</label> <input type="text" class="pure-input-1-2" name="full_name" /></div>'+
								'<div class="pure-control-group"><label>Phone</label> <input type="text" class="pure-input-1-2" name="phone" /></div>'+
								'<div class="pure-control-group"><label>Email</label> <input type="text" class="pure-input-1" name="email" /></div>'+
								'<div class="pure-control-group"><label>Subject</label> <label style="border-radius:4px;border:1px solid #DFDFDF; padding:5px;font-weight:bold;font-size:0.7em;" class="subject">[Brochure] '+$('#address').text()+', '+$('#city').text()+'</label></div>'+
								'<div class="pure-control-group"><label>Comment</label> <textarea rows="14" style="width:100%;" name="comment"></textarea> </div>'+
								//'<div class="pure-control-group" style="font-size:0.8em;">What\'s the sum of <span id="math_equation">'+$("#math").data('math')+'</span>? <input type="text" value="" name="answer" style="margin-left:5px;width:35px;padding:2px;font-size:1.1em;display:inline;" /></div>'+								
							'</form>',
				buttons: { Cancel: false, Send: true },
				focus: 1,
				submit:function(e,v,m,f){
					if (v){
						// Initialize validation plugin
						var vs = $('#bro_form').validate({ 
							onkeyup: false,
							onfocusout: false,	
							onclick: false,
							focusInvalid : false,	
							rules:{			
								full_name:{
									required: true,				
									minlength: 2
								},			
								email:{				
									required: true,
									email: true
								}/*,
								answer:{
									required: true,
									number: true,
									remote: {
										url: "../captcha",
										type: "post",
										data: {
											answer: function(){
												return $('#bro_form :input[name="answer"]').val();
											}
										}
									}
								}*/
							},
							errorPlacement: function(error,element) {			
								return true;
							},	
							submitHandler: function(form) {
								var img = $('<img src="'+loc.substring(0, loc.indexOf('listings'))+'public/images/loader3.gif" style="float:left;margin-left:10px;" />');
								$('.jqibuttons').prepend(img);
								$.post(loc.substring(0, loc.indexOf('listings'))+'listings/send', $("#bro_form").serialize()+'&subject='+$('#bro_form .subject').text()+'&submit_form=', function(o) {											
									if (o){										
										// Remove loader
										$(img).remove();
										// New Captcha
										//$("#math").data('math',o);
										// Reset
										vs.resetForm();
										$('#bro_form')[0].reset();						
										$('#bro_form input').css('background-color','#fff');
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
				
						$('#bro_form').submit();
						
						return false;
					}	
					$.prompt.close();
				}
			},
			state1: {
				title: "Thank You!",
				html: "We will get back to you shortly!",
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

	$(".btnVirtualTour").fancybox({
		width    : '85%', 
		height   : '85%', 
		autoSize    : false, 
		closeClick  : false, 
		fitToView   : false, 
		openEffect  : 'none', 
		closeEffect : 'none', 
		type : 'iframe',
		helpers : {
			overlay : {
				css : {
					'background' : 'rgba(255, 255, 255, 0.85)'
				}
			}
		}
	});
});