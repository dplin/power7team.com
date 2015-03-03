$(document).ready(function(){						
	//ACCORDION BUTTON ACTION (ON CLICK DO THE FOLLOWING)
	$('.accordionButton').click(function() {
		var k = $(this);
		//REMOVE THE ON CLASS FROM ALL BUTTONS
		$('.accordionButton').removeClass('on');
		  
		//NO MATTER WHAT WE CLOSE ALL OPEN SLIDES
		$('.accordionContent:visible').slideUp('normal');			
		
		// Closed!!!
		$('#tagged').removeClass('icon-minus-sign').addClass('icon-plus-sign').removeProp('id');		
		
		//IF THE NEXT SLIDE WASN'T OPEN THEN OPEN IT
		if($('div', this).is(':hidden') == true) {
			
			//ADD THE ON CLASS TO THE BUTTON
			$(this).addClass('on');		
						
			//Expand!!!
			$(this).children(':first').removeClass('icon-plus-sign').addClass('icon-minus-sign').prop('id', 'tagged');				
			  
			//OPEN THE SLIDE
			$('div', this).slideDown('normal');
		 } 		  	
	 });
	  
	
	/*** REMOVE IF MOUSEOVER IS NOT REQUIRED ***/
	/*
	//ADDS THE .OVER CLASS FROM THE STYLESHEET ON MOUSEOVER 
	$('.accordionButton').mouseover(function() {
		$(this).addClass('over');
		
	//ON MOUSEOUT REMOVE THE OVER CLASS
	}).mouseout(function() {
		$(this).removeClass('over');										
	});
	*/
	/*** END REMOVE IF MOUSEOVER IS NOT REQUIRED ***/
	
	
	/********************************************************************************************************************
	CLOSES ALL S ON PAGE LOAD
	********************************************************************************************************************/	
	$('.accordionContent').hide();
	
	// Add a + button
	$('.accordionButton > span').before('<i class="icon-plus-sign"></i>');	
});