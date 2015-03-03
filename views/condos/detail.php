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
		<span class="title_1">New Condos</span>	
	</div>
</header>
<header class="register_header">
	<div style="padding:20px 0;text-align:center;font-style:italic;">
		<span class="title_3" style="color:#333;display:inline;margin-right:15px;">Register as a VIP customer now and we will contact you shortly.</span><button class="btn btnRegisterNow">Register Now</button>
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
			<ul id="condo_detail">
				<li><span class="condo_name"><?=$this->condo['condo_name']?></span></li>
				<li style="font-size:1.2em;margin-bottom:10px;font-style:italic;"><?=$this->condo['price']?></li>
				<li><span>Builder:</span><?=$this->condo['builder']?><?=isset($this->condo['website']) ? ' <a style="color:#B51313;font-weight:normal;" href="'.$this->condo['website'].'" target="_blank">(website)</a>':'' ?></li>
				<li><span>Address:</span><span id="address"><?=$this->condo['address']?>, </span><span id="city"><?=$this->condo['city']?></span></li>
				<li><span>Pre-construction:</span><?=$this->condo['pre_construction']?></li>
				<li><span>Closing Date:</span><?=$this->condo['closing_date']?></li>
				<li><span>Number of Buildings:</span><?=$this->condo['number_of_buildings']?></li>
				<li><span>Number of Units:</span><?=$this->condo['number_of_units']?></li>
				<li><span>Number of Storeys:</span><?=$this->condo['number_of_storeys']?></li>
				<li><span>Ceiling Height:</span><?=isset($this->condo['ceiling_height_from']) && isset($this->condo['ceiling_height_to']) ? rtrim(rtrim($this->condo['ceiling_height_from'],'0'),'.').' - '.rtrim(rtrim($this->condo['ceiling_height_to'],'0'),'.').' '.$this->condo['ceiling_unit']:''?></li>
				<li><span>Maintenance Fee:</span><?=$this->condo['maintenance_fee']?></li>				
				<li><span>Electrical Includes:</span><?=$this->condo['electrical_includes']?></li>				
			</ul>			
			<button class="btn btnGotoMap">View MAP<i style="margin-left:5px;" class="icon-long-arrow-down"></i></button>
		</div>
	</div>
	<hr style="margin-bottom:0;">
	<div class="side_divs">
		<div style="width:161px;padding:30px 30px 0 30px;vertical-align:top;">
			<span style="font-weight:bold;font-size:0.95em;display:block;">Ammenities</span>
			<ul id="amm_list">
				<?php 				
					  $amm = preg_split("/;/", $this->condo['ammenities'], -1, PREG_SPLIT_NO_EMPTY);					  					  
					  for ($i = 0; $i < count($amm); $i++){ 
				?>
				<li><span><?=$amm[$i]?></span></li>
				<?php } ?>
			</ul>
			<span style="font-weight:bold;font-size:0.95em;margin-bottom:10px;display:block;">Other</span>
			<p style="font-size:0.85em;margin-bottom:40px;">
				<?=$this->condo['other_ammenities']?>
			</p>
			<span style="font-weight:bold;font-size:0.95em;margin-bottom:10px;display:block;">Floor Plan</span>
			<div class="clearfix">
				<?php for($i = 0; $i < count($this->floor_plans); $i++){ ?>
				<div class="floor_plan">
					<a href="<?=URL?>files/<?=$this->floor_plans[$i]['filename']?>"><i class="icon-download-alt"></i></a>
				</div>
				<?php } ?>			
			</div>			
		</div>		
		<div style="padding:30px;border-left:1px solid #C9C9C9;vertical-align:top;">
			<span class="title_1" style="font-size:2em;margin-bottom:20px;">Description</span>
			<div style="margin-bottom:20px;">
				<p style="font-size:0.8em;">
					<?=$this->condo['description']?>
				</p>
			</div>
			<?php 
				function parse_yturl($url) 
				{
					$pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
					preg_match($pattern, $url, $matches);
					return (isset($matches[1])) ? $matches[1] : false;
				}				
				
				if (isset($this->condo['youtube'])){										
			?>
			<iframe width="678" height="381" src="//www.youtube.com/embed/<?=parse_yturl($this->condo['youtube'])?>?wmode=opaque" frameborder="0" allowfullscreen></iframe>			
			<?php 
				}
			?>
		</div>
	</div>
	<hr style="margin:0 0 25px 0;">
	<span id="map" class="title_1" style="font-size:2em;">Map</span>
	<div style="height:450px;border:10px solid #DFDFDF;margin-bottom:40px;margin-top:10px;">
		<div id="map-canvas"></div>
	</div>
</div>
<div class="overlay" style="display:none;"></div>

<div style="position:fixed;top:0;left:0;right:0;height:0;z-index:6999;text-align:center;">
	<div id="reg_form_container" style="position:relative;display:inline-block;text-align:left;visibility:hidden;">
	<header id="registration_form">
		<div style="padding:20px 0 25px 0;height:309px;" class="clearfix">	
			<div style="position:relative;">
				<span class="title_1" style="font-size:2em;margin-right:15px;">Register as a VIP now.</span><button class="btn4 btnClose" style="position:absolute;top:0;right:0;border:1px solid #DFDFDF;"><i class="icon-remove"></i></button>
			</div>
			<hr style="margin:25px 0;">
			<div style="height:215px;">
				<form class="pure-form pure-form-stacked" id="reg_form">
					<div class="pure-u-1-4">
						<div class="pure-control-group" style="margin-bottom:40px;">
							<label for="first_name" style="width:80px;">First Name</label>
							<input id="first_name" name="first_name" type="text" placeholder="Username">
						</div>
						<div class="pure-control-group">
							<label for="last_name" style="width:80px;">Last Name</label>
							<input id="last_name" name="last_name" type="text" placeholder="Last Name" value="">
						</div>
					</div>
					<div class="pure-u-1-4">
						<div class="pure-control-group" style="margin-bottom:40px;">
							<label for="email" style="width:80px;">Email</label>
							<input id="email" name="email" type="email" placeholder="Email">
						</div>
						<div class="pure-control-group">
							<label for="phone" style="width:80px;">Phone</label>
							<input id="phone" name="phone" type="text" placeholder="Phone number">
						</div>
					</div>		
					<div class="pure-u-1-4" style="width:375px;">
						<div class="pure-control-group">
							<label for="message" style="width:80px;">Message</label>
							<textarea id="message" name="message" cols="33" style="height:108px;" placeholder="Message"></textarea>
						</div>
					</div>
					<hr>					
					<div style="position:relative;">
						<div>
							<button class="btn btnRegister">Register Now</button>
						</div>
						<!--<div style="position:absolute;right:0;top:0;font-size:0.9em;">What's the sum of <span id="math_equation"><?php //echo $math; ?></span>? <input type="text" value="" name="answer" style="margin-left:5px;width:35px;display:inline;" /></div>-->
					</div>
				</form>
			</div>
		</div>
	</header>
	</div>
</div>
<?php include('views/contact_info.php'); ?>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>