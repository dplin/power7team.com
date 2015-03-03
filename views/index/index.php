<header class="header_sen">
	<div style="background-color:#fff;display:table-cell;text-align:center;height:151px;vertical-align:middle;padding:0 130px;">
		<p style="line-height:31px;font-size:1.22em;">
			"The Real Estate Market Has Been Changing at a Rapid Pace. As a Realtor, We Must Always Think Positive and be a Multi-Tasking Individual, Always Think 
			Ahead of our Clients." - <span style="color:#1e52a7;">POWER</span><span style="color:#b51313;">7</span><span style="color:#1e52a7">TEAM</span>
		</p>
	</div>
</header>
<header class="header_slider">
	<div style="width:960px;background-color:#222222;height:488px;">
		<div style="padding:15px 0;height:39px;color:#fff;">
			<div style="float:left;">
				<span class="title_1" style="color:#fff;">Featured Listings</span>
			</div>
			<div style="float:right;">
				<button class="btn2 btnGoLeft"><i class="icon-long-arrow-left"></i></button>
				<button class="btn2 btnGoRight"><i class="icon-long-arrow-right"></i></button>
			</div>
		</div>
		<div class="slideshow_container" style="height:350px;">
			<ul class="bxslider" style="margin:0;padding:0;">
				<?php 			
				$cnt = 0; 
				for ($i=0; $i < ceil(count($this->listings) / 3); $i++){ ?>
				<li>
					<div>
						<?php 
							for ($j=0, $k=$cnt; $j < count($this->listings), $k < count($this->listings); $j++, $k++){ 						
								if ($j == 3){
									$cnt = $k;
									break 1;
								}
						?>
								<div class="listing_container" id="<?=$this->listings[$k]['lid']?>">
									<div style="position:relative;">
										<div class="img_wrapper2">
											<?php if ($this->listings[$k]['filename']){ ?>
											<img src="<?=URL?>thumb/<?=$this->listings[$k]['filename']?>" />
											<?php  }else{ ?>
												<div style="font-size:5em;color:#C9C9C9;line-height:0;">
													<i class="icon-picture"></i>
												</div>					
											<?php  } ?>																										
										</div>
										<button class="btn3 btnViewListing" data-url="<?='./listings/detail/'.$this->listings[$k]['lid']?>">view<i class="icon-long-arrow-right"></i></button>											
									</div>
									<div>
										<dl>
											<dt><?=$this->listings[$k]['neighborhood']?></dt>
											<dd><?=$this->listings[$k]['address']?></dd>
											<dd><?=isset($this->listings[$k]['style']) && isset($this->listings[$k]['development_type']) ? $this->listings[$k]['style'].', '.$this->listings[$k]['development_type'] : '&nbsp;' ?></dd>
											<dd><?=isset($this->listings[$k]['price']) ? '$'.rtrim(rtrim(number_format($this->listings[$k]['price'], 2),'0'), '.') : ''?></dd>
										</dl>
									</div>
								</div>
						<?php 
							} 
						?>							
					</div>
				</li>
			  <?php } ?>		  
			</ul>		
		</div>
		<div style="padding:15px 0;height:39px;text-align:right;">		
			<button class="btn btnViewAllListings" data-url="./listings">View All Listings<i class="icon-long-arrow-right" style="margin-left:5px;"></i></button>
		</div>
	</div>
</header>
<div class="left" style="margin-top:40px;padding-bottom:40px;">
	<div style="width:643px;height:345px;padding-right:40px;">
		<span class="title_1">Upcoming Projects</span>
		<div class="builders clearfix" style="min-height:352px;margin-top:12px;">
			<?php for ($i=0; $i < count($this->condos); $i++){ ?>
			<div class="condo">
				<a href="./condos/detail/<?=$this->condos[$i]['cid']?>">
					<div class="img_wrapper">
						<?php if ($this->condos[$i]['filename']){ ?>
						<img src="<?=URL?>photo/<?=$this->condos[$i]['filename']?>" />
						<?php  }else{ ?>
							<div style="font-size:5em;color:#C9C9C9;line-height:0;">
								<i class="icon-picture"></i>
							</div>					
						<?php  } ?>
					</div>
				</a>
			</div>						
			<?php } ?>
		</div>
		<button class="btn btnViewMore" data-url="./condos">View More<i class="icon-long-arrow-right" style="margin-left:5px;"></i></button>
		<hr>
		<div>
			<span class="title_1">News & More</span>
			<p style="margin-top:15px;">Welcome to Re/Max Realtron Realty Inc., Brokerage, your source for Greater Toronto Area real estate. If you own real estate that you're thinking of selling, We would be happy to provide you with a <strong>FREE</strong> Home Evaluation.</p>				
			<p style="margin-top:8px;">In today's competitive real estate market, timing is everything. Many good homes are sold before they are ever advertised. Beat other homebuyers to the hottest new homes for sale in Greater Toronto area with our New Listings Notification.</p>				
			<p style="margin-top:8px;">Whether you are buying or selling a home, hire someone like us, who wants to earn your business. We invite you to contact us as we'd be happy to assist you with this important transaction.</p>				
			<p style="margin-top:8px;">In addition, if you have any general questions about buying or selling real estate in reater Toronto Area, please contact us as we are more than willing to help.</p>				
			<p style="margin-top:8px;">Please browse our website for listings, reports and important local real estate information.</p>				
			<p style="margin-top:8px;">Sincerely,</p>
			<p style="margin-top:23px;font-weight:bold;"><span style="color:#1e52a7;">POWER</span><span style="color:#b51313;">7</span><span style="color:#1e52a7">TEAM</span></p>			
		</div>
	</div>
	<div>
		<div class="sidebar" style="width:235px;border:1px solid #DFDFDF;background-color:#fff;padding:20px;font-size:0.9em;">
			<span class="title_1" style="font-size:1.8em;">Contact Us</span>
			<img src="<?=URL?>public/images/remaxlogo.jpg" style="margin-top:10px;" />
			<p style="line-height:18px;">
				<span style="color:#1e52a7;">RE/MAX REALTRON</span><br />
				<span style="color:#1e52a7;">REALTY INC, BROKERAGE</span><br />
				<span style="font-size:0.8em;">Independently owned and operated</span>
			</p>
			<hr>
			<div style="font-size:1.2em;font-weight:bold;">
				<span style="color:#1e52a7;">POWER 7 TEAM</span>
			</div>
			<p style="font-size:0.9em;">
				<a href="mailto:info@power7team.com"><span style="color:#b51313;">email us<i class="icon-envelope-alt" style="margin-left:5px;"></i></span></a><a href="http://www.facebook.com/power7team" target="_blank"><i class="icon-facebook-sign" style="color:#3B5998;font-size:1.2em;margin-left:5px;position:relative;top:1px;"></i></a><br />
				<strong>Email:</strong> info@power7team.com<br />
				<strong>Phone:</strong> (905) 764- 8688<br />
				<strong>Cell:</strong> (416) 300-2000<br />
				<strong>Fax:</strong> (905) 764- 7335<br />
				<strong>Address:</strong> Penthouse - 505 Hwy 7 E.,<br />
				Thornihill, Ontario, L3T 7T1, Canada
			</p>
			<hr>
			<div style="font-size:1.2em;font-weight:bold;">
				<span style="color:#1e52a7;">POWER 7 TEAM</span><br />
				<span style="color:#1e52a7;">MEMBERS</span>
			</div>
			<table class="members_table">
				<tr>
					<td><img src="<?=URL?>public/images/ken-pic.jpg" /></td><td><b>Ken Fok</b><br />B.A., Broker</td>
				</tr>
				<tr>
					<td><img src="<?=URL?>public/images/Paul-CMA-Photo.jpg" /></td><td><b>Paul Cheng</b><br />Sales Representative</td>
				</tr>
				<tr>
					<td><img src="<?=URL?>public/images/Patsy-CMA.jpg" /></td><td><b>Patsy Leung</b><br />Sales Representative</td>
				</tr>				
				<tr>
					<td><img src="<?=URL?>public/images/Ronald-CMA.jpg" /></td><td><b>Ronald Yung</b><br />Sales Representative</td>
				</tr>				
				<tr>
					<td><img src="<?=URL?>public/images/Crystal.jpg" /></td><td><b>Crystal Fan</b><br />Sales Representative</td>
				</tr>				
				<tr>
					<td><img src="<?=URL?>public/images/Maggie-CMA.jpg" /></td><td><b>Maggie Ma</b><br />Sales Representative</td>
				</tr>				
				<tr>
					<td><img src="<?=URL?>public/images/Stephen-CMA.jpg" /></td><td><b>Stephen Leung</b><br />Sales Representative</td>
				</tr>								
			</table>
		</div>
	</div>
</div>