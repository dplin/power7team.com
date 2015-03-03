$(document).ready(function(){	
	// Menu - Highlight Active
	var url = window.location;	
	$('#p7t_menu a[href="'+url+'"]').addClass('nav1_active');					
	$('.nav2 a[href="'+url+'"]').parent().addClass('nav2_active');	

		
	// Navigation Menu
	var menu = $('#admin_menu').superfish({cssArrows : true, speed : 300});

	$(".calculator, .clientdinner2012").fancybox({
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