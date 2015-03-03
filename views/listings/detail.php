<?php
	/****** Start Math Captcha ******/
	/*Session::init();

	$digit1 = mt_rand(1,15);
	$digit2 = mt_rand(1,15);
	if( mt_rand(0,1) === 1 ) {
			$math = "$digit1 + $digit2";
			$_SESSION['answer'] = $digit1 + $digit2;
	} else {
			$math = "$digit1 - $digit2";
			$_SESSION['answer'] = $digit1 - $digit2;
	}*/
	/****** End Math Captcha ******/
?>
<header class="title_header">
	<div class="title_container">
		<span class="title_1">Our Listings</span>	
	</div>
</header>
<div>
	<div style="padding:20px 0;">
		<button class="btn4 btnGoBack"><i class="icon-long-arrow-left"></i>Back</button>
	</div>
	<div class="side_divs">
		<div class="slideshow" style="overflow:hidden;">
			<?php if (count($this->gallery)) { ?>
			<div id="slider" class="flexslider">
			  <ul class="slides">
					<?php for ($i = 0; $i < count($this->gallery); $i++){ ?>
					<li><img src="<?=URL?>photo/<?=$this->gallery[$i]['filename']?>" /></li>
					<?php } ?>
			  </ul>
			</div>	
			<div id="carousel" class="flexslider">
			  <ul class="slides">
					<?php for ($i = 0; $i < count($this->gallery); $i++){ ?>
					<li><img src="<?=URL?>thumb/<?=$this->gallery[$i]['filename']?>" /></li>
					<?php } ?>
			  </ul>
			</div>			
			<?php }else{ ?>
				<div style="position:relative;top:36%;left:42%;font-size:6em;color:#C9C9C9;line-height:0;">
					<i class="icon-warning-sign"></i><br />
					<span style="font-size:0.245em;">0 Images</span>
				</div>
			<?php } ?>
		</div>		
		<div style="vertical-align:top;padding-left:30px;">			
			<ul id="listing_detail">
				<li><span class="neighborhood"><?=$this->listing['neighborhood']?>,</span><span id="city"><?=$this->listing['city']?></span></li>
				<li style="font-size:1.2em;margin-bottom:10px;font-style:italic;">MLS&reg; <?=isset($this->listing['price']) ? '$'.rtrim(rtrim(number_format($this->listing['price'], 2),'0'), '.'):''?></li>
				<li><span>Address:</span><span id="address"><?=$this->listing['address']?></span></li>
				<li><span>Type:</span><?=$this->listing['development_type']?></li>
				<li><span>Bedrooms:</span><?=$this->listing['bedrooms']?></li>
				<li><span>Garage:</span><?=$this->listing['garage']?></li>
				<li><span>Size:</span><?=isset($this->listing['size']) ? $this->listing['size'].' '.$this->listing['size_unit']:''?></li>
				<li><span>Lot Size:</span><?=isset($this->listing['dimensions_w']) && isset($this->listing['dimensions_l']) ? rtrim(rtrim($this->listing['dimensions_w'],'0'),'.').' x '.rtrim(rtrim($this->listing['dimensions_l'],'0'),'.').' '.$this->listing['lot_size_unit']:''?></li>
				<li><span>Style:</span><?=$this->listing['style']?></li>
				<li><span>Bathrooms:</span><?=$this->listing['bathrooms']?></li>
				<li><span>Basement:</span><?=$this->listing['basement']?></li>				
				<li><span>Lot Type:</span><?=$this->listing['lot_type']?></li>
				<li><span>Taxes:</span><?=isset($this->listing['amount']) ? '$'.rtrim(rtrim(number_format($this->listing['amount'], 2),'0'), '.').' ('.$this->listing['amount_for_year'].')':''?></li>
			</ul>
			<button class="btn btnGotoMap">View MAP<i style="margin-left:5px;" class="icon-long-arrow-down"></i></button>
		</div>
	</div>

	<hr>
	<div class="side_divs">
		<div style="width:221px;" id="math">
			<span style="font-weight:bold;font-size:0.95em;margin-bottom:10px;display:block;">Quick Links</span>
			<ul id="quick_links">
				<li><a class="calculator" data-fancybox-type="iframe" href="http://tools.td.com/HMCIA/"><i class="icon-keyboard"></i>Mortgage Calculator</a></li>
				<li><a class="btnEmailListing" href="#"><i class="icon-envelope-alt"></i>Email Listing</a></li>
				<li><a class="btnSchedule" href="#"><i class="icon-calendar"></i>Schedule a Showing</a></li>
				<li><a class="btnRequestInfo" href="#"><i class="icon-info"></i>Request More Info</a></li>
				<?php if (isset($this->listing['virtual_tour_url'])){?>
				<li><a class="btnVirtualTour" data-fancybox-type="iframe" href="<?=$this->listing['virtual_tour_url']?>"><i class="icon-play"></i>Virtual Tour</a></li>
				<?php } ?>
			</ul>
			<div>
				<span style="font-weight:bold;font-size:0.95em;margin-bottom:10px;display:block;">Attachments</span>
				<button class="btn btnViewBrochure" style="font-size:0.96em;padding:8px 37px;">View Listing Brochure</button>
			</div>
		</div>		
		<div style="padding-left:30px;">
			<span class="title_1" style="font-size:2em;margin-bottom:20px;">Description</span>
			<div style="margin-bottom:20px;">
				<p style="font-size:0.8em;">
					<?=$this->listing['description']?>
				</p>
			</div>
			<?php 
				function parse_yturl($url) 
				{
					$pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
					preg_match($pattern, $url, $matches);
					return (isset($matches[1])) ? $matches[1] : false;
				}				
				
				if (isset($this->listing['youtube'])){										
			?>
			<iframe width="709" height="399" src="//www.youtube.com/embed/<?=parse_yturl($this->listing['youtube'])?>?wmode=opaque" frameborder="0" allowfullscreen></iframe>			
			<?php 
				}
			?>
		</div>
	</div>
	<hr>
	<span id="map" class="title_1" style="font-size:2em;">Map</span>
	<div style="height:450px;border:10px solid #DFDFDF;margin-bottom:40px;margin-top:10px;">
		<div id="map-canvas"></div>
	</div>
</div>

<?php include('views/contact_info.php'); ?>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>