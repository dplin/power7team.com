$(document).ready(function(){
	var slider = $('.bxslider').bxSlider({mode: 'fade', pager: false, controls: false});

	$('.btnGoLeft').on('click', function(){
		slider.goToPrevSlide();
		return false;
	});
  
	$('.btnGoRight').on('click', function(){	
		slider.goToNextSlide();
		return false;
	}); 
	$('.btnViewListing, .btnViewMore, .btnViewAllListings').on('click', function(){	
		window.location.href = $(this).data('url');
	}); 
});