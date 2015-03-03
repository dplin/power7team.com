$(document).ready(function(){						
	$(".new_condos_container").mCustomScrollbar({		
		theme:"dark",
		mouseWheelPixels: 250,
		autoDraggerLength: false
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

	// Hide registration form
	$('#registration_form').css('top', '-349px');	
	
	// Open registration form
	$('.btnRegisterNow').on('click', function(){		
		// Make form visible
		$('#registration_form').css('visibility', 'visible');		
		// Put Overlay above some elements.
		$("div.overlay").css("z-index", "6888");		
		// Overlay animation
		$("div.overlay").fadeToggle("fast");
		// Slide down animation
		$('#registration_form').animate({
			top: '121',
			opacity: 1
		}, 800);
		return false;
	});
	// Close registration form
	$('.btnClose').on('click', function(){
		// Overlay animation
		$("div.overlay").fadeToggle("fast");		
		// Slide up animation
		$('#registration_form').animate({
			top: '-349',
			opacity: 0
		}, 400, function(){
			// Reset Overlay
			$("div.overlay").css("z-index", "auto");			
			// Clear Form
			$('#reg_form')[0].reset();
			v.resetForm();
			$('#reg_form input').css('background-color','#fff');
		});
		return false;
	});
	
	// Initialize validation plugin
    var v = $('#reg_form').validate({ 
		onkeyup: false,
		onfocusout: false,	
		onclick: false,
		focusInvalid : false,	
		rules:{			
			first_name:{
				required: true,				
				minlength: 2
			},			
			email:{				
				required: true,
				email: true
			},
			answer:{
				required: true,
				number: true,
				remote: {
					url: "../captcha",
					type: "post",
					data: {
						answer: function(){
							return $('#reg_form :input[name="answer"]').val();
						}
					}
				}
			}
		},
		errorPlacement: function(error,element) {			
			return true;
		},	
		submitHandler: function(form) {
			var loaderContainer = $('.btnRegister').parent();			
			$(loaderContainer).html('<img src="'+loc.substring(0, loc.indexOf('condos'))+'public/images/loader3.gif" style="margin-top:8px;" />');
			$.post(loc.substring(0, loc.indexOf('condos'))+'condos/send', $("#reg_form").serialize(), function(o) {											
				if (o){							
					// Remove Loader
					$(loaderContainer).html('<button class="btn btnRegister">Register Now</button>');

					// Overlay animation
					$("div.overlay").fadeToggle("fast");		

					// Slide up animation
					$('#registration_form').animate({
						top: '-346',
						opacity: 0
					}, 400, function(){
						// New Captcha
						//$('#math_equation').html(o);
						// Reset top navigation back to normal			
						$("#header_container").css("z-index", "auto");
						$('header#registration_form').css("z-index", "auto");	
						$("div.overlay").css("z-index", "auto");	
						// Clear Form
						v.resetForm();
						form.reset();
						$('#reg_form')[0].reset();						
						$('#reg_form input').css('background-color','#fff');
					});					
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
	
	// Button Clicks		
	$('#registration_form').on('click', '.btnRegister', function(){		
		$('#reg_form').submit();		
		return false;
	});	
});