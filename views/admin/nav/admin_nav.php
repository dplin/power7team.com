<!--<script src="http://yui.yahooapis.com/3.10.3/build/yui/yui-min.js"></script>-->
<style>
#container{
	margin:0;
	width:100%;
}	
#admin_menu_container a{
	color: #555;
}
#admin_menu .admin_nav_active{
	background-color:#2d2d2d;
	color:#fff;
}
#admin_menu .admin_nav_active > a{	
	color:#fff;
}
#admin_menu ul > li > ul > li > a{
	font-size:90%;
}
#admin_menu_container .sf-menu li:hover,
#admin_menu_container .sf-menu li.sfHover {
	background: #2d2d2d;
	color:#fff;
	-webkit-transition: none;
	transition: none;
}
#admin_menu_container .sf-menu li:hover > a,
#admin_menu_container .sf-menu li.sfHover > a{
	color:#fff;
}
#admin_menu_container .sf-menu a {
	border:0;
	padding: 0.5em 2em;	
	text-decoration: none;
	zoom: 1; /* IE7 */
}
#admin_menu_container .sf-menu ul li {
	background: #fff;
}
#admin_menu_container .sf-menu li ul {
	min-width:6.5em;
} 
.sf-with-ul{	
	color:#555;
}
</style>
<div style="width:100%;float:left;background-color:#fff;height:55px;padding:20px 0 0 50px;border-bottom:1px solid #DFDFDF;">
	<div style="float:left;" id="admin_menu_container">
		<ul class="sf-menu" id="admin_menu">
			<li>
				<a href="#">New</a>
				<ul>
					<li>
						<a href="<?=URL?>admin/listings/new">Listing</a>
					</li>			
					<li>
						<a href="<?=URL?>admin/condos/new">Condo</a>
					</li>								
				</ul>
			</li>		
			<li>
				<a href="<?=URL?>admin/listings">Listings</a>
			</li>
			<li>
				<a href="<?=URL?>admin/condos">Condos</a>
			</li>	
			<li>
				<a href="#"><i class="icon-cog"></i></a>
				<ul>
					<li><a href="<?=URL?>admin/account">Account</a></li>
					<li><a href="<?=URL?>admin/logout">Logout</a></li>
				</ul>
			</li>	
		</ul>
	</div>
</div>
<script>
$(document).ready(function(){	
	var url = window.location.pathname;	
	$('#admin_menu > li > a[href="'+url+'"]').addClass('admin_nav_active');		
	$('#admin_menu > li > ul > li > a[href="'+url+'"]').parent().parent().parent().addClass('admin_nav_active');			
		
    if(window.location.href.indexOf("admin/condos/new") > -1 || window.location.href.indexOf("admin/listings/new") > -1) {
		$('#admin_menu > li:first-child > a').addClass('admin_nav_active');				
    }else if(window.location.href.indexOf("admin/listings") > -1) {
		$('a[href="<?=URL?>admin/listings"]').addClass('admin_nav_active');		
	}else if(window.location.href.indexOf("admin/condos") > -1) {
		$('a[href="<?=URL?>admin/condos"]').addClass('admin_nav_active');				
    }
});	
</script>