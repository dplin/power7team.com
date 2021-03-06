$(document).ready(function(){

	var loc = window.location.pathname;	
		
	// Initialize DatePicker
	$('input.datepicker').Zebra_DatePicker();
	
	
	/*********************************************************************** Add New *********************************************************************/
	
	// Override Default Error Message
	$.extend(jQuery.validator.messages, {
		required: "Required"
	});	
	// Custom Validation Method
	$.validator.addMethod("cdnPostal", function(postal, element) {
		return this.optional(element) || 
		postal.match(/[a-zA-Z][0-9][a-zA-Z](-| |)[0-9][a-zA-Z][0-9]/);
	}, "Please specify a valid postal code.");
	$.validator.addMethod("complete_url", function(val, elem) {
		// if no url, don't do anything
		if (val.length == 0) { return true; }

		// if user has not entered http:// https:// or ftp:// assume they mean http://
		if(!/^(https?|ftp):\/\//i.test(val)) {
			val = 'http://'+val; // set both the value
			$(elem).val(val); // also update the form element
		}
		// now check if valid url
		// http://docs.jquery.com/Plugins/Validation/Methods/url
		// contributed by Scott Gonzalez: http://projects.scottsplayground.com/iri/
		return /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(val);
	}, "Please enter a valid URL.");
	
	// Initialize validation plugin
    var v = $('#listing_form').validate({ 
		onkeyup: false,
		onfocusout: false,	
		onclick: false,
		focusInvalid : false,
		groups: {
			amountGroup: "amount amount_for_year",
			dimensionGroup: "dimensions_w dimensions_l"
		},	
		rules:{
			/*********** Address & Location ***********/
			address:{
				required: true,				
				minlength: 2
			},
			neighborhood:{
				required: true,				
				minlength: 2
			},
			city:{
				required: true,								
			},			
			postal_zip:{				
				cdnPostal: true
			},	
			/*********** General Information ***********/
			listed_date:{
				required: true
			},			
			price:{
				number: true
			},
			rent_lease:{
				number: true
			},
			mls_number:{
				required: true
			},			
			/****************** Details *****************/
			year_built:{
				number: true
			},
			d_size:{
				number: true
			},
			virtual_tour_url:{
				complete_url: true
			},
			/******************** Lot *******************/
			lot_size:{
				number: true
			},
			dimensions_w:{
				number: true
			},
			dimensions_l:{
				number: true
			},
			/***************** Taxes and fees ****************/
			amount:{
				number: true
			},			
			amount_for_year:{
				number: true
			},				
			condo_fee:{
				number: true
			}		
		},
		errorPlacement: function(error,element) {			
			// Append error message to the very end.
			$(element).parent().append(error);
		},	
		invalidHandler: function(form, validator) {
			// Scroll to error
			if (!validator.numberOfInvalids())
				return;
			$('html, body').animate({
				scrollTop: $(validator.errorList[0].element).offset().top - 300
			}, 500);
		},		
		submitHandler: function(form) {
			var attr = $('#listing_container').attr('data-lid');
			if (typeof attr !== 'undefined' && attr !== false) {			/******************* SAVE EXISTING ******************/					
				var loaderContainer = $('#btnSave').parent();
				
				$(loaderContainer).html('<img src="'+loc.substring(0, loc.indexOf('admin'))+'public/images/loader3.gif" style="margin-top:8px;" />');			

				if ($('#development_level').prop('disabled') == true){				
					$('#development_level').prop('disabled', false);
					$('#development_level').attr('readOnly', true);					
				}
				$.post(loc.substring(0, loc.indexOf('admin'))+'admin/saveListing', $("#listing_form :input[value!='']").serialize()+'&lid='+$('#listing_container').data('lid'), function(o) {																		
					if ($('#development_level').attr('readOnly') == 'readonly'){
						$('#development_level').prop('disabled', true);
						$('#development_level').attr('readOnly', false);					
					}					
					// Remove Loader
					$(loaderContainer).html('<button type="submit" class="pure-button pure-button-small pure-button-primary" id="btnSave">Save</button>&nbsp;<button type="submit" class="pure-button pure-button-small pure-button-primary" id="btnDelete">Delete</button>');
					
					// Pop Success Message
					popMessage();
					
					// Scroll to top after add
					$('html, body').animate({scrollTop: 0}, 500);				
				});			
			}else{															/******************* ADD NEW ******************/
				var loaderContainer = $('#btnAdd').parent();
				
				$(loaderContainer).html('<img src="'+loc.substring(0, loc.indexOf('admin'))+'public/images/loader3.gif" style="margin-top:8px;" />');			
							
				$('#development_level').attr({'disabled': false, 'readonly': true});			
				$.post(loc.substring(0, loc.indexOf('admin'))+'admin/addListing', $("#listing_form :input[value!='']").serialize(), function(o) {				
					// Reset All
					v.resetForm();
					$('#development_level').attr({'disabled': true, 'readonly': false});
					$('#listing_form').get(0).reset();
					$("#rent_lease").attr('disabled', true);
					$("#rent_lease_length").attr('disabled', true);
					$("#price").attr('disabled', false);
									
					// Remove Loader
					$(loaderContainer).html('<button type="submit" class="pure-button pure-button-small pure-button-primary" id="btnAdd">Add</button>&nbsp;<button type="submit" class="pure-button pure-button-small pure-button-primary" id="btnClear">Clear</button>');

					// Pop Success Message
					popMessage();
									
					// Scroll to top after add
					$('html, body').animate({scrollTop: 0}, 500);				
				});
			}
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
    $('#new_construction').change(function() {
        if($(this).is(":checked")) {
			$("#development_level").prop('disabled', false);
        }else{
			$("#development_level").prop('disabled', true);
		}        
    });	
	$('#status').change(function(){
		if ($(this).find("option:selected").val() == 'For Rent/Lease' || $(this).find("option:selected").val() == 'Rented/Leased'){
			$("#rent_lease").prop('disabled', false);
			$("#rent_lease_length").prop('disabled', false);
			$("#price").prop('disabled', true);			
		}else{
			$("#rent_lease").prop('disabled', true);
			$("#rent_lease_length").prop('disabled', true);
			$("#price").prop('disabled', false);					
		}
	});	
	$('#development_level').change(function(){
		if ($(this).find("option:selected").val() == 'Built'){
			$("#development_level").prop('disabled', true);
			$('#new_construction').prop('checked', false);
		}else{
			$("#development_level").prop('disabled', false);
			$('#new_construction').prop('checked', true);
		}
	});		
	$('#listing_form').on('click', '#btnAdd', function(){		
		$('#listing_form').submit();		
		return false;
	});
	$('#listing_form').on('click', '#btnClear', function(){		
		v.resetForm();
		$('#listing_form').get(0).reset();
		$("#rent_lease").prop('disabled', true);
		$("#rent_lease_length").prop('disabled', true);
		$("#price").prop('disabled', false);					
		return false;
	});
	
	// Helper Functions
	function popMessage(){
		var data=$('<div style="border-radius: 6px;padding:15px 25px;color:#fff;background: rgb(0, 0, 0) transparent; background: rgba(0, 0, 0, 0.7);"><p>Success!</p> </div>');    
		var popup= $('<div>');
		popup.append(data);
		$('body').append(popup);
		popup.css("position","fixed");
		popup.css("top","40%");
		popup.css("left","46%");
		setTimeout(function(){popup.fadeOut(300);},1500)
	}

	
	/*********************************************************************** Edit Existing *********************************************************************/
		
	// Initialize Tab Navigation
	$('#tab-container').easytabs({
		animationSpeed: 200,	  	  
		tabActiveClass: "selected-tab"
	});
	// Initialize Chosen Plugin	
	$("#current_listings").chosen({disable_search: true}).change(function(event) {
		var lid = $(event.target).val();
		if ($('#listing_container').data('lid') != lid){		
			window.location.replace(loc.substring(0, loc.indexOf('admin'))+'admin/listings/'+lid);
		}
		return false;			
	});		
	// Pre-select Dropdown List
	if ($("#listing_container").data('lid') != ''){
		$("#current_listings").val($("#listing_container").data('lid'));		
		$("#current_listings").trigger("chosen:updated");
	}	
		
	var deleteList = {};
	var deleteYoutube = false;
	var photos = 0;	
	var photoBlob = [];	
	var max_files = 5;
	var xhr = new XMLHttpRequest();
		
	// Button Clicks
	$('#listing_form').on('click', '#btnSave', function(){		
		$('#listing_form').submit();		
		return false;
	});
	
	$('#listing_form').on('click', '#btnDelete', function(){		
		
		return false;
	});	
	
	$('#upload_form').on('change', '#upload', function () {		
		if (photos < max_files){
			// Get number of images
			var num = 0;
			$.each(this.files, function(index, file) {
				if (!!file.type.match(/image.*/)) {
					num++;
				}		
			});
			
			// Generate Preview
			$.each(this.files, function(index, file) {			
				if (!!file.type.match(/image.*/)) {
					if (window.FileReader) {				// Generate Preview
						var reader = new FileReader();						
						reader.onload = function(event) {  
							var img = new Image;					
							var canvas = document.createElement('canvas');														
							var canvas2 = document.createElement('canvas');
							canvas.width = 75;
							canvas.height = 50;
							var ctx = canvas.getContext("2d");					
							var ctx2 = canvas2.getContext("2d");															
							
							img.onload = function(){  // Set the onload handler...	
								// Resize Image for Preview
								dimensions.set_max(75,50).read_dimensions(img).scale_to_fit();
								ctx.drawImage(img, 0, 0, dimensions.width, dimensions.height);

								// Resize Image for Upload
								dimensions.set_max(1024,768).read_dimensions(img).scale_to_fit();
								canvas2.width = dimensions.width;
								canvas2.height = dimensions.height;								
								ctx2.drawImage(img, 0, 0, dimensions.width, dimensions.height);									
								
								// Store Resized Image in Array
								if (canvas2.toBlob) {
									canvas2.toBlob(
										function (blob) {								
											if (photoBlob.length < 5){										
												photoBlob.push({filename:file.name, file:blob});
											}									
										},
										'image/jpeg'
									);										
								}									
							};	
												
							img.src = event.target.result;																								
							
							// Append Preview to Row
							var rows = $('<tr></tr>').append($('<td></td>').append(canvas));
							rows.append($('<td>'+file.name+'</td><td>'+formatSizeUnits(file.size)+'<div class="progress"><div class="bar"></div ><div class="percent">0%</div ></div></td>'));							
							rows.hide();						
							
							// Animation
							$('#files_table').parent().animate({					  
								  height: ($('#files_table').parent().height()+(num*64))+"px"
							},300,function(){
								$('#files_table').append(rows);			
								rows.fadeIn("slow");								
							});																			
						}; 				
					
						// Read file and Photo Counter
						if (photos < 5){
							reader.readAsDataURL(file);							
							photos++;							
						}
					}
				}		
			});		

			// XHR Progress Bar
			//xhr.file = file; // not necessary if you create scopes like this
			xhr.addEventListener('progress', function(e) {
				var done = e.position || e.loaded, total = e.totalSize || e.total;
				
				// 100%
				$('.percent').text((Math.floor(done/total*1000)/10) + '%');			
				$('.bar').animate({					  
					  width: (Math.floor(done/total*1000)/10)+"%"
				},1200);			
					
				//console.log('xhr progress: ' + (Math.floor(done/total*1000)/10) + '%');
			}, false);
			if ( xhr.upload ) {
				xhr.upload.onprogress = function(e) {
					var done = e.position || e.loaded, total = e.totalSize || e.total;				
					//console.log('xhr.upload progress: ' + done + ' / ' + total + ' = ' + (Math.floor(done/total*1000)/10) + '%');
					
					$('.percent').text((Math.floor(done/total*1000)/10)+'%');				
					$('.bar').animate({					  
						  width: (Math.floor(done/total*1000)/10)+"%"
					},1200);
					
				};
			}
			// Callback on success upload
			xhr.onreadystatechange = function(e) {
				if (4 == this.readyState) {				
					// Clear photos array
					photos = 0;
					photoBlob = [];
					// Clear table
					$('#files_table').html('');
					// Close the gap
					$('#files_table').parent().animate({					  
						  height: "0px"
					},300);					
					
					// Add file information to database and image(s) to Gallery.
					$.each($.parseJSON(this.responseText).files, function (index, file) {					
						if (!file.error){
							$.post(loc.substring(0, loc.indexOf('admin'))+'admin/addImage', {lid: $("#listing_container").data('lid'), filename:file.name, size:file.size}, function(o) {				
								if (o){					
									// Update Photo Count
									$('#photo_count').text('('+($('#gallery_container > div').length+1)+')');
									
									// Add New Image(s) to gallery. With fadeIn effect.
									var html = $('<div class="pure-u-1-5" id="'+o+'"><img src="'+file.thumbnailUrl+'" /><input id="description'+o+'" name="description'+o+'" type="text" class="pure-input-1" placeholder="Description" style="width:94.5%;"><button type="button" class="pure-button pure-button-xsmall pure-button-delete btnDeleteImg">x</button><input id="album_cover'+o+'" type="radio" name="album_cover" value="'+o+'" class="album_cover_rb"></div>');
									html.hide();
									$('#gallery_container').append(html);
									html.fadeIn("slow");
								}
							});
						}
					});
				}
			};
		}
		return false;
	});	
	
    $('#upload_form').on('click', '#upload', function (e) {
		if (photos >= max_files){	
			$.prompt("You are only allowed a maximum of "+max_files+" files.", {
				title: "Warning",
				classes: {
					box: '',
					fade: '',
					prompt: '',
					close: '',
					title: '',
					message: '',
					buttons: '',
					button: 'pure-button pure-button-xsmall',
					defaultButton: 'pure-button-primary'
				},				
				buttons: { Ok: false }
			});			
			e.preventDefault();
		}        
    });
	// Button Clicks	
	$('#upload_form').on('click', '.btnStartUpload', function () {
		if (photos > 0){
			var formdata = new FormData();
			for  (var key in photoBlob) {
				formdata.append("files[]", photoBlob[key]['file'], photoBlob[key]['filename']);				
			}
			xhr.open('post', '../server', true);
			xhr.send(formdata);
		}
		return false;
	});
	$('#upload_form').on('click', '.btnClearQueue', function () {
		// Clear photos array
		photos = 0;
		photoBlob = [];
		// Fade Out
		$('#files_table').fadeOut(300, function(){
			// Clear table
			$('#files_table').html('').show();;
			
			// Close the gap
			$('#files_table').parent().animate({					  
				  height: "0px"
			},300);				
		});		
		return false;
	});		
	$('#gallery_form').on('click', '#btnSaveGallery', function () {			
		// Make sure there is something to update.
		if ($('#gallery_container > div').length > 0){
			var data = JSON.stringify($("#gallery_form :input[value!='']").serializeArray());			
			var newArr = [], item;
			// Re-arranging object array
			for (item in deleteList) {
				newArr.push(deleteList[item]);
			}				
			var unwanted = JSON.stringify(newArr);
			var loaderContainer = $('#btnSaveGallery').parent();
			$(loaderContainer).html('<img src="'+loc.substring(0, loc.indexOf('admin'))+'public/images/loader3.gif" style="margin-top:8px;" />');		
			$.post(loc.substring(0, loc.indexOf('admin'))+'admin/saveGallery', {gallery:data, deleteList:unwanted, lid:$("#listing_container").data('lid')}, function(o){				
				if (o){										
					var totalImages = $('#gallery_container > div').length - newArr.length;
					
					// Refresh Gallery.  Remove deleted item(s)
					for (var i = 0; i < newArr.length; i++){
						$('#'+newArr[i]['gid'], $('#gallery_form')).fadeOut("normal", function(e){
							$(this).remove();
						});
					}
					// Clean-up deleteList
					deleteList = {};
					// Update Photo Count					
					$('#photo_count').text('('+totalImages+')');
					// Remove Loader
					$(loaderContainer).html('<button type="submit" class="pure-button pure-button-small pure-button-primary" id="btnSaveGallery">Save</button>');
				}
			});
		}		
		return false;
	});				
	$('#gallery_form').on('click', '.btnDeleteImg', function () {
		var overlay = $('<div class="img_overlay" style="position:absolute;top:0;left:0;height:97.5%;width:94.5%;background-color:rgba(0,0,0,0.6);"></div>');
		overlay.hide();
		if ($(".img_overlay", $(this).parent())[0]){
			delete deleteList[$(this).parent().attr('id')];
			$(".img_overlay", $(this).parent()).fadeOut("fast", function(){
				$(".img_overlay", $(this).parent()).remove();
			});			
		}else{
			var url = $('img', $(this).parent()).attr('src');
			var filename = url.substr(url.lastIndexOf("/")+1)
			deleteList[$(this).parent().attr('id')] = {"gid": $(this).parent().attr('id'), "filename": filename};
			$(this).parent().append(overlay);
			overlay.fadeIn(200);
		}	
		return false;
	});			
	$('#youtube_form').on('click', '#btnSaveYoutube', function () {						
		if ($.trim($('#youtube_url').val()) != ''){			
			var loaderContainer = $('#btnSaveYoutube').parent();
			$(loaderContainer).html('<img src="'+loc.substring(0, loc.indexOf('admin'))+'public/images/loader3.gif" style="margin-top:8px;" />');				
			$.post(loc.substring(0, loc.indexOf('admin'))+'admin/saveYoutube', {youtube:$('#youtube_url').val(), lid:$("#listing_container").data('lid'), deleteYoutube:deleteYoutube}, function(o){
				if (o == 0){														
					// Bad Youtube URL
				}else{					
					if (deleteYoutube == true){
						// Remove Youtube from Preview container
						$('#youtube_url').val('');						
						var children = $('.youtube_container').children();						
						$(children).fadeOut(500, function(){
							$('.youtube_container').animate({					  
								height: "0px"
							},300,function(){
								children.remove();
							});						
						});						
						deleteYoutube = false;
					}else{
						// Insert Youtube to Preview container
						var youtube_content = $('<label for="youtube" style="margin-bottom:20px;">Preview</label><iframe width="709" height="399" src="//www.youtube.com/embed/'+o+'?wmode=opaque" frameborder="0" allowfullscreen></iframe><button type="button" class="pure-button pure-button-xsmall pure-button-delete btnDeleteYoutube" style="right:0;top:36px;padding:5px 13px;font-size:1.3em;font-weight:bold;background: rgba(66, 184, 221, 0.8);z-index:1;">x</button>');
						youtube_content.hide();
						
						$('.youtube_container').animate({
							height: "439px"
						},300,function(){
							$('.youtube_container').html(youtube_content);
							console.log($('.youtube_container'));
							youtube_content.fadeIn("slow");		
						});				
					}					
				}
				// Remove Loader
				$(loaderContainer).html('<button type="submit" class="pure-button pure-button-small pure-button-primary" id="btnSaveYoutube">Save</button>');				
			});
		}
		return false;
	});				
	$('#youtube_form').on('click', '.btnDeleteYoutube', function () {	
		var overlay = $('<div class="img_overlay" style="position:absolute;top:36px;left:0;height:91%;width:100%;background-color:rgba(0,0,0,0.6);"></div>');
		overlay.hide();
		if ($(".img_overlay", $(this).parent())[0]){			
			$(".img_overlay", $(this).parent()).fadeOut("fast", function(){
				$(".img_overlay", $(this).parent()).remove();
				deleteYoutube = false;
			});			
		}else{
			$(this).parent().append(overlay);
			overlay.fadeIn(200);
			deleteYoutube = true;
		}		
		return false;
	});
	
	// Helper Functions
	function formatSizeUnits(bytes){
		if (bytes >= 1073741824)
		{
			bytes = parseFloat(bytes / 1073741824).toFixed(2) + ' GB';			
		}
		else if (bytes >= 1048576)
		{
			bytes = parseFloat(bytes / 1048576).toFixed(2) + ' MB';			
		}
		else if (bytes >= 1024)
		{		
			bytes = parseFloat(bytes / 1024).toFixed(2) + ' KB';			
		}
		else if (bytes > 1)
		{
			bytes = bytes + ' bytes';
		}
		else if (bytes == 1)
		{
			bytes = bytes + ' byte';
		}
		else
		{
			bytes = '0 bytes';
		}

		return bytes;
	}
    dimensions = {
		ratio : 0,
		max_width  : 800,
        max_height : 600,        
        width  : 800, // this will change
        height : 600, // this will change
        largest_property : function () {
            return this.height > this.width ? "height" : "width";
        },
		set_max : function (w, h){
			this.max_width = w;
			this.max_height = h;
			return this;
		},
        read_dimensions : function (img) {
            this.width = img.width;
            this.height = img.height;
			
			var x_factor = this.scaling_factor(this.width,  this.max_width),
                y_factor = this.scaling_factor(this.height, this.max_height),

                largest_factor = Math.min(x_factor, y_factor);
				
			this.ratio = largest_factor;
			
            return this;
        },
        scaling_factor : function (original, computed) {
            return computed / original;
        },		
        scale_to_fit : function () {
            var x_factor = this.scaling_factor(this.width,  this.max_width),
                y_factor = this.scaling_factor(this.height, this.max_height),

                largest_factor = Math.min(x_factor, y_factor);

            this.width  = Math.floor(this.width * largest_factor);
            this.height = Math.floor(this.height * largest_factor);
        }
    };	
	/************************************************** NOTE ****************************************************/
	// In console you will see a warning.  This is due to Youtube embed.  However it works non-the-less.
	// Ref: http://stackoverflow.com/questions/13625239/embedding-youtube-video-using-iframe-gives-unsafe-javascript-attempt
});