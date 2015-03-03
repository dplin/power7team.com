<?php	
	Session::init();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $this->title; ?></title>	
	<meta name="description" content="leading real estate agents in the market">
    <meta name="keywords" content="real estate power7team power7teams remax toronto">	
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<?php 
		if (isset($this->css)){
			foreach ($this->css as $css){
				echo '<link href="'.URL.'views/'.$css.'" media="all" type="text/css" rel="stylesheet" />';				
			}
		}	
	?>	 			
	<link href="<?php echo URL; ?>public/css/jquery.fancybox.css" media="all" type="text/css" rel="stylesheet" />
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo URL; ?>public/css/superfish.css" media="all" type="text/css" rel="stylesheet" />
	<link href="<?php echo URL; ?>public/css/main.css" media="all" type="text/css" rel="stylesheet" />	
	<script src="<?php echo URL; ?>public/js/jquery.js"></script>	
	<script src="<?php echo URL; ?>public/js/jquery-migrate-1.2.1.min.js"></script>
	<script src="<?php echo URL; ?>public/js/jquery.hoverIntent.min.js"></script>
	<script src="<?php echo URL; ?>public/js/jquery.fancybox.pack.js"></script>
	<script src="<?php echo URL; ?>public/js/jquery.fancybox-media.js"></script>
	<script src="<?php echo URL; ?>public/js/superfish.js"></script>
	<script src="<?php echo URL; ?>public/js/main.js"></script>
	<!--[if lt IE 9]>
	  <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<!--[if IE 8 ]>    
		<script>
			// Add trim function.  Some browsers don't have trim() function.  Ex. IE8.  
			if(typeof String.prototype.trim !== 'function') {
			  String.prototype.trim = function() {
				return this.replace(/^\s+|\s+$/g, ''); 
			  }
			}	
		</script>
	<![endif]-->	
	<?php 
		if (isset($this->js)){
			foreach ($this->js as $js){
				echo '<script type="text/javascript" src="'.URL.'views/'.$js.'"></script>';
			}
		}	
	?>
</head>
<body>
<div class="wrapper">
	<div style="position:fixed;top:0;left:0;right:0;height:0;z-index:7000;text-align:center;">
		<div id="header_container" style="position:relative;display:inline-block;text-align:left;">
			<header id="top_nav" class="gradientBG">
				<div style="height:68px;padding-left:200px;" class="gradientBG">
					<div id="navigation">				
						<nav>
							<ul class="sf-menu" id="p7t_menu">
								<li><a href="<?php echo URL; ?>">Home</a></li>
								<li><a href="<?php echo URL; ?>listings">Our Listings</a></li>
								<li><a href="<?php echo URL; ?>condos">New Condos</a></li>
								<li><a class="calculator" data-fancybox-type="iframe" href="http://tools.td.com/HMCIA/">Calculator</a></li>
							</ul>
						</nav>
					</div>
				</div>
			</header>
			<header id="bottom_nav">
				<div style="height:68px;">
					<nav>
						<table class="nav2">
							<tr>
								<td><a href="<?php echo URL; ?>tips">Tips on Home Staging</a></td>
								<td><a href="<?php echo URL; ?>meetourteam">Meet Our Team</a></td>
								<td><a href="<?php echo URL; ?>testimonials">Testimonials</a></td>
								<td><a href="<?php echo URL; ?>aboutremax">About RE/MAX</a></td>
								<td><a href="<?php echo URL; ?>aboutontario">About Ontario</a></td>
								<td><a class="clientdinner2012" data-fancybox-type="iframe" href="http://www.power7event.com">Client Dinner 2012</a></td>
							</tr>
						</table>			
					</nav>
				</div>
			</header>
			<a href="<?=URL?>"><img src="<?=URL?>public/images/logo.jpg" style="position:absolute;top:0;left:0;" class="sh" /></a>
		</div>	
	</div>
	<div id="container">
		<div id="content" style="background-color:#F5F5F5;margin-top:137px;">
