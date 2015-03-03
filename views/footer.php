<style>
.go-top {
	position: fixed;
	bottom: 0;	
	right: 2em;
	text-decoration: none;
	color: white;
	background-color: #222222;
	font-size: 1.2em !important;
	padding: 0.6em 0.8em;
	display: none;
}
.go-top:hover {
	background-color: rgba(0, 0, 0, 0.7);
}
</style>
			</div>			
			<header class="header_footer">
				<div id="footer">
					<div style="float:left;height:73px;width:585px;margin-top:25px;">
							<table id="footer_table" style="border-collapse:separate;">
							  <tr>
								<td><a href="<?=URL?>">Home</a></td>
								<td><a href="<?=URL?>tips">Tips on Home Staging</a></td>
							  </tr>
							  <tr>
								<td><a href="<?=URL?>listings">Our Listings</a></td>
								<td><a href="<?=URL?>meetourteam">Meet Our Team</a></td>
							  </tr>
							  <tr>
								<td><a href="<?=URL?>condos">New Condos</a></td>
								<td><a href="<?=URL?>testimonials">Testimonials</a></td>
							  </tr>
							  <tr>
								<td><a class="calculator" data-fancybox-type="iframe" href="http://tools.td.com/HMCIA/">Calculator</a></td>
								<td><a href="<?=URL?>aboutremax">About RE/MAX</a></td>
							  </tr>
							  <tr>
								<td><a href="<?=URL?>login">Sign In</a></td>
								<td><a href="<?=URL?>aboutontario">About Ontario</a></td>
							  </tr>
							  <tr>
								<td></td>
								<td><a class="clientdinner2012" data-fancybox-type="iframe" href="http://www.power7event.com">Client Dinner 2012</a></td>
							  </tr>						  
							</table>
					</div>			
					<div style="float:left;text-align:right;height:150px;width:375px;margin-top:25px;" class="noSelection">
						<div style="font-size:0.85em;line-height:20px;">
							<span style="color:#333;display:block;">&copy;2010-<?=date("Y")?> Re/Max Realtron Reality Inc., Brokerage</span>
						</div>
					</div>	
					<a href="#" class="go-top" title="Go Top" style="color:#fff;"><i class="icon-long-arrow-up"></i></a>
				</div>		
			</header>
		</div>								
	</div>

<script>
	$(document).ready(function() {
		// Show or hide the sticky footer button
		$(window).scroll(function() {
			if ($(this).scrollTop() > 200) {
				$('.go-top').fadeIn(200);
			} else {
				$('.go-top').fadeOut(200);
			}
		});
		
		// Animate the scroll to top
		$('.go-top').click(function(event) {
			event.preventDefault();
			
			$('html, body').animate({scrollTop: 0}, 300);
		})
	});
</script>	
</body>
</html>
