<?php if (isset($this->listing)) { ?>
<div id="tab-container" class="tab-container">
	<ul class='etabs'>
		<li class='tab'><a href="#e_form"><i class="icon-edit" style="margin-right:5px;"></i>Edit</a></li>
		<li class='tab'><a href="#gallery"><i class="icon-picture" style="margin-right:5px;"></i>Gallery</a></li>    
		<li class='tab'><a href="#youtube"><i class="icon-youtube-play" style="margin-right:5px;"></i>Youtube</a></li> 
	</ul>
	<div id="e_form">
		<form class="pure-form pure-form-aligned" id="listing_form">
			<fieldset>
				<legend>Address & Location</legend>
				<div class="pure-control-group">
					<label for="address"><span style="color:#B51313;">*</span> Address</label>
					<input id="address" name="address" type="text" placeholder="Address" class="pure-input-1-3" value="<?=$this->listing['address']?>">
				</div>
				<div class="pure-control-group">
					<label for="suite_number">Suite Number</label>				
					<input id="suite_number" name="suite_number" type="text" placeholder="Suite No." class="pure-input-1-4" style="width:80px;" value="<?=$this->listing['suite_number']?>">		
				</div>			
				<div class="pure-control-group">
					<label for="neighborhood"><span style="color:#B51313;">*</span> Neighborhood</label>
					<input id="neighborhood" name="neighborhood" type="text" placeholder="Neighborhood" class="pure-input-1-3" value="<?=$this->listing['neighborhood']?>">
				</div>
				<div class="pure-control-group">
					<label for="city"><span style="color:#B51313;">*</span> City</label>
					<select id="city" name="city">
						<option value></option>
						<option value="Ajax" <?=$this->listing['city'] == 'Ajax' ? 'selected':''?>>Ajax</option>
						<option value="Aurora" <?=$this->listing['city'] == 'Aurora' ? 'selected':''?>>Aurora</option>
						<option value="Brampton" <?=$this->listing['city'] == 'Brampton' ? 'selected':''?>>Brampton</option>
						<option value="Burlington" <?=$this->listing['city'] == 'Burlington' ? 'selected':''?>>Burlington</option>
						<option value="Markham" <?=$this->listing['city'] == 'Markham' ? 'selected':''?>>Markham</option>
						<option value="Milton" <?=$this->listing['city'] == 'Milton' ? 'selected':''?>>Milton</option>
						<option value="Mississauga" <?=$this->listing['city'] == 'Mississauga' ? 'selected':''?>>Mississauga</option>
						<option value="Newmarket" <?=$this->listing['city'] == 'Newmarket' ? 'selected':''?>>Newmarket</option>
						<option value="North York" <?=$this->listing['city'] == 'North York' ? 'selected':''?>>North York</option>
						<option value="Oakville" <?=$this->listing['city'] == 'Oakville' ? 'selected':''?>>Oakville</option>
						<option value="Oshawa" <?=$this->listing['city'] == 'Oshawa' ? 'selected':''?>>Oshawa</option>
						<option value="Pickering" <?=$this->listing['city'] == 'Pickering' ? 'selected':''?>>Pickering</option>
						<option value="Richmond Hill" <?=$this->listing['city'] == 'Richmond Hill' ? 'selected':''?>>Richmond Hill</option>
						<option value="Scarborough" <?=$this->listing['city'] == 'Scarborough' ? 'selected':''?>>Scarborough</option>
						<option value="Toronto" <?=$this->listing['city'] == 'Toronto' ? 'selected':''?>>Toronto</option>
						<option value="Vaughan" <?=$this->listing['city'] == 'Vaughan' ? 'selected':''?>>Vaughan</option>					
						<option value="Whitby" <?=$this->listing['city'] == 'Whitby' ? 'selected':''?>>Whitby</option>
					</select>
				</div>
				<div class="pure-control-group">
					<label for="postal_zip">Postal/Zip Code</label>				
					<input id="postal_zip" name="postal_zip" type="text" maxlength="6" placeholder="Postal/Zip" class="pure-input-1-4" style="width:80px;" value="<?=$this->listing['postal_zip']?>">
				</div>
				<div class="pure-control-group">
					<label for="mls_location">MLS&reg; Location</label>
					<input id="mls_location" name="mls_location" type="text" placeholder="MLS&reg; Location" value="<?=$this->listing['mls_location']?>">
				</div>
				<legend>General Information</legend>
				<div class="pure-control-group">
					<label for="status">Status</label>				
					<select id="status" name="status">
						<option value></option>
						<option value="For Sale" <?=$this->listing['status'] == 'For Sale' ? 'selected':''?>>For Sale</option>
						<option value="Sale Pending" <?=$this->listing['status'] == 'Sale Pending' ? 'selected':''?>>Sale Pending</option>
						<option value="Sold" <?=$this->listing['status'] == 'Sold' ? 'selected':''?>>Sold</option>
						<option value="For Rent/Lease" <?=$this->listing['status'] == 'For Rent/Lease' ? 'selected':''?>>For Rent/Lease</option>
						<option value="Rented/Leased" <?=$this->listing['status'] == 'Rented/Leased' ? 'selected':''?>>Rented/Leased</option>					
						<option value="Expired" <?=$this->listing['status'] == 'Expired' ? 'selected':''?>>Expired</option>
						<option value="Archived" <?=$this->listing['status'] == 'Archived' ? 'selected':''?>>Archived</option>
					</select>				
				</div>
				<div class="pure-control-group">
					<label for="listed_date"><span style="color:#B51313;">*</span> Listed Date</label>
					<input id="listed_date" class="datepicker" name="listed_date" type="text" placeholder="yyyy-mm-dd" value="<?=$this->listing['listed_date']?>">
				</div>
				<div class="pure-control-group">
					<label for="expiry_date">Expiry Date</label>
					<input id="expiry_date" class="datepicker" name="expiry_date" type="text" placeholder="yyyy-mm-dd" value="<?=$this->listing['expiry_date']?>">
				</div>
				<div class="pure-control-group">
					<label for="price">Price</label>
					<input id="price" name="price" type="text" placeholder="Price" value="<?=rtrim(rtrim($this->listing['price'], "0"), ".")?>" <?=$this->listing['status'] == 'For Rent/Lease' || $this->listing['status'] == 'Rented/Leased' ? 'disabled':''?>>
				</div>			
				<div class="pure-control-group">
					<label for="rent_lease">Rent/Lease</label>
					<input id="rent_lease" name="rent_lease" type="text" placeholder="Rent/Lease" value="<?=rtrim(rtrim($this->listing['rent_lease'], "0"), ".")?>" <?=$this->listing['status'] <> 'For Rent/Lease' && $this->listing['status'] <> 'Rented/Leased' ? 'disabled':''?>>
					<select id="rent_lease_length" name="rent_lease_length" <?=$this->listing['status'] <> 'For Rent/Lease' && $this->listing['status'] <> 'Rented/Leased' ? 'disabled':''?>>
						<option value="Daily" <?=$this->listing['rent_lease_length'] == 'Daily' ? 'selected':''?>>Daily</option>
						<option value="Weekly" <?=$this->listing['rent_lease_length'] == 'Weekly' ? 'selected':''?>>Weekly</option>
						<option value="Monthly" <?=$this->listing['rent_lease_length'] == 'Monthly' ? 'selected':''?>>Monthly</option>
						<option value="Six Months" <?=$this->listing['rent_lease_length'] == 'Six Months' ? 'selected':''?>>Six Months</option>
						<option value="Yearly" <?=$this->listing['rent_lease_length'] == 'Yearly' ? 'selected':''?>>Yearly</option>
						<option value="Two Years" <?=$this->listing['rent_lease_length'] == 'Two Years' ? 'selected':''?>>Two Years</option>
						<option value="Three Years" <?=$this->listing['rent_lease_length'] == 'Three Years' ? 'selected':''?>>Three Years</option>
						<option value="Five Years" <?=$this->listing['rent_lease_length'] == 'Five Years' ? 'selected':''?>>Five Years</option>
						<option value="Negotiable" <?=$this->listing['rent_lease_length'] == 'Negotiable' ? 'selected':''?>>Negotiable</option>
					</select>								
				</div>						
				<div class="pure-control-group">
					<label for="price_highlight">Price Highlight</label>
					<input id="price_highlight" name="price_highlight" type="text" placeholder="Price Highlight" class="pure-input-1-3" value="<?=$this->listing['price_highlight']?>">
				</div>
				<div class="pure-control-group">
					<label for="general_highlight">General Highlight</label>
					<input id="general_highlight" name="general_highlight" type="text" placeholder="General Highlight" class="pure-input-1-3" value="<?=$this->listing['general_highlight']?>">
				</div>
				<div class="pure-control-group">
					<label for="mls_number"><span style="color:#B51313;">*</span> MLS&reg; Number</label>
					<input id="mls_number" name="mls_number" type="text" placeholder="MLS&reg; Number" value="<?=$this->listing['mls_number']?>">
				</div>
				<legend>Details</legend>
				<div class="pure-control-group">
					<label for="new_construction">New Construction</label>				
					<input id="new_construction" name="new_construction" type="checkbox" value="" <?=$this->listing['development_level'] <> 'Built' ? 'checked':''?>>				
				</div>
				<div class="pure-control-group">
					<label for="development_level">Development Level</label>				
					<select id="development_level" name="development_level" style="width:160px;" <?=$this->listing['development_level'] == 'Built' ? 'disabled':''?>>
						<option value="Built" <?=$this->listing['development_level'] == 'Built' ? 'selected':''?>>Built</option>
						<option value="Land Only" <?=$this->listing['development_level'] == 'Land Only' ? 'selected':''?>>Land Only</option>
						<option value="Plan Only" <?=$this->listing['development_level'] == 'Plan Only' ? 'selected':''?>>Plan Only</option>
						<option value="Renovation" <?=$this->listing['development_level'] == 'Renovation' ? 'selected':''?>>Renovation</option>
						<option value="Under Construction" <?=$this->listing['development_level'] == 'Under Construction' ? 'selected':''?>>Under Construction</option>
					</select>				
				</div>						
				<div class="pure-control-group">
					<label for="development_type">Type</label>
					<select id="development_type" name="development_type" style="width:160px;">
						<option value></option>
						<option value="Commercial" <?=$this->listing['development_type'] == 'Commercial' ? 'selected':''?>>Commercial</option>
						<option value="Condominium" <?=$this->listing['development_type'] == 'Condominium' ? 'selected':''?>>Condominium</option>
						<option value="Farm and Ranch" <?=$this->listing['development_type'] == 'Farm and Ranch' ? 'selected':''?>>Farm and Ranch</option>
						<option value="Lots and Land" <?=$this->listing['development_type'] == 'Lots and Land' ? 'selected':''?>>Lots and Land</option>
						<option value="Multifamily" <?=$this->listing['development_type'] == 'Multifamily' ? 'selected':''?>>Multifamily</option>
						<option value="Other" <?=$this->listing['development_type'] == 'Other' ? 'selected':''?>>Other</option>
						<option value="Recreational" <?=$this->listing['development_type'] == 'Recreational' ? 'selected':''?>>Recreational</option>
						<option value="Residential" <?=$this->listing['development_type'] == 'Residential' ? 'selected':''?>>Residential</option>
					</select>
				</div>
				<div class="pure-control-group">
					<label for="has_suite">Has Suite</label>				
					<input id="has_suite_option_one" type="radio" name="has_suite" value="Yes" <?=$this->listing['has_suite'] == 'Yes' ? 'checked':''?>>
					<span style="font-size:0.8em;">Yes</span>
					<input id="has_suite_option_two" type="radio" name="has_suite" value="No" <?=$this->listing['has_suite'] == 'No' ? 'checked':''?>>
					<span style="font-size:0.8em;">No</span>			
					<input id="has_suite_option_three" type="radio" name="has_suite" value="Potential" <?=$this->listing['has_suite'] == 'Potential' ? 'checked':''?>>
					<span style="font-size:0.8em;">Potential</span>
				</div>
				<div class="pure-control-group">
					<label for="style">Style</label>
					<select id="style" name="style">
						<option value></option>
						<option value="1 1/2 Storey" <?=$this->listing['style'] == '1 1/2 Storey' ? 'selected':''?>>1 1/2 Storey</option>
						<option value="1 3/4 Storey" <?=$this->listing['style'] == '1 3/4 Storey' ? 'selected':''?>>1 3/4 Storey</option>
						<option value="2 1/2 Storey" <?=$this->listing['style'] == '2 1/2 Storey' ? 'selected':''?>>2 1/2 Storey</option>
						<option value="2 Storey" <?=$this->listing['style'] == '2 Storey' ? 'selected':''?>>2 Storey</option>
						<option value="2 Storey Split" <?=$this->listing['style'] == '2 Storey Split' ? 'selected':''?>>2 Storey Split</option>
						<option value="3 Storey" <?=$this->listing['style'] == '3 Storey' ? 'selected':''?>>3 Storey</option>
						<option value="3-Level Split" <?=$this->listing['style'] == '3-Level Split' ? 'selected':''?>>3-Level Split</option>
						<option value="4-Level Split" <?=$this->listing['style'] == '4-Level Split' ? 'selected':''?>>4-Level Split</option>
						<option value="5-Level Split" <?=$this->listing['style'] == '5-Level Split' ? 'selected':''?>>5-Level Split</option>
						<option value="Apartment" <?=$this->listing['style'] == 'Apartment' ? 'selected':''?>>Apartment</option>
						<option value="Bi-Level" <?=$this->listing['style'] == 'Bi-Level' ? 'selected':''?>>Bi-Level</option>
						<option value="Bungalow" <?=$this->listing['style'] == 'Bungalow' ? 'selected':''?>>Bungalow</option>
						<option value="Colonial" <?=$this->listing['style'] == 'Colonial' ? 'selected':''?>>Colonial</option>
						<option value="Commercial" <?=$this->listing['style'] == 'Commercial' ? 'selected':''?>>Commercial</option>
						<option value="Duplex" <?=$this->listing['style'] == 'Duplex' ? 'selected':''?>>Duplex</option>
						<option value="Fourplex" <?=$this->listing['style'] == 'Fourplex' ? 'selected':''?>>Fourplex</option>
						<option value="Lot / Land" <?=$this->listing['style'] == 'Lot / Land' ? 'selected':''?>>Lot / Land</option>
						<option value="Manufactured Home" <?=$this->listing['style'] == 'Manufactured Home' ? 'selected':''?>>Manufactured Home</option>
						<option value="Multiplex" <?=$this->listing['style'] == 'Multiplex' ? 'selected':''?>>Multiplex</option>
						<option value="Other" <?=$this->listing['style'] == 'Other' ? 'selected':''?>>Other</option>
						<option value="Ranch" <?=$this->listing['style'] == 'Ranch' ? 'selected':''?>>Ranch</option>
						<option value="Single Storey" <?=$this->listing['style'] == 'Single Storey' ? 'selected':''?>>Single Storey</option>
						<option value="Townhouse" <?=$this->listing['style'] == 'Townhouse' ? 'selected':''?>>Townhouse</option>
						<option value="Triplex" <?=$this->listing['style'] == 'Triplex' ? 'selected':''?>>Triplex</option>					
					</select>
				</div>
				<div class="pure-control-group">
					<label for="year_built">Year Built</label>				
					<input id="year_built" name="year_built" type="number" maxlength="4" placeholder="Year Built" style="width:80px;" value="<?=$this->listing['year_built']?>">
				</div>			
				<div class="pure-control-group">
					<label for="d_size">Size</label>
					<input id="d_size" name="d_size" type="number" placeholder="Size" style="width:80px;" value="<?=rtrim(rtrim($this->listing['size'], "0"), ".")?>">
					<select id="size_unit" name="size_unit">					
						<option value="square feet" <?=$this->listing['size_unit'] == 'square feet' ? 'selected':''?>>square feet</option>
						<option value="square meters" <?=$this->listing['size_unit'] == 'square meters' ? 'selected':''?>>square meters</option>
					</select>					
				</div>
				<div class="pure-control-group">
					<label for="bedrooms">Bedrooms</label>
					<select id="bedrooms" name="bedrooms">
						<option value></option>
						<option value="1" <?=$this->listing['bedrooms'] == '1' ? 'selected':''?>>1</option>
						<option value="2" <?=$this->listing['bedrooms'] == '2' ? 'selected':''?>>2</option>
						<option value="3" <?=$this->listing['bedrooms'] == '3' ? 'selected':''?>>3</option>
						<option value="4" <?=$this->listing['bedrooms'] == '4' ? 'selected':''?>>4</option>
						<option value="5" <?=$this->listing['bedrooms'] == '5' ? 'selected':''?>>5</option>
						<option value="6" <?=$this->listing['bedrooms'] == '6' ? 'selected':''?>>6</option>
						<option value="7" <?=$this->listing['bedrooms'] == '7' ? 'selected':''?>>7</option>
						<option value="8" <?=$this->listing['bedrooms'] == '8' ? 'selected':''?>>8</option>					
						<option value="9" <?=$this->listing['bedrooms'] == '9' ? 'selected':''?>>9</option>
						<option value="10" <?=$this->listing['bedrooms'] == '10' ? 'selected':''?>>10</option>
						<option value="11" <?=$this->listing['bedrooms'] == '11' ? 'selected':''?>>11</option>
						<option value="12" <?=$this->listing['bedrooms'] == '12' ? 'selected':''?>>12</option>	
					</select>
					<span style="font-size:0.8em;">Plus?</span>
					<select id="plus" name="plus">
						<option value></option>
						<option value="+1" <?=$this->listing['plus'] == '+1' ? 'selected':''?>>+1</option>
						<option value="+2" <?=$this->listing['plus'] == '+2' ? 'selected':''?>>+2</option>
						<option value="+3" <?=$this->listing['plus'] == '+3' ? 'selected':''?>>+3</option>
						<option value="+4" <?=$this->listing['plus'] == '+4' ? 'selected':''?>>+4</option>
						<option value="+5" <?=$this->listing['plus'] == '+5' ? 'selected':''?>>+5</option>
					</select>				
				</div>
				<div class="pure-control-group">
					<label for="bathrooms">Bathrooms</label>
					<select id="bathrooms" name="bathrooms">
						<option value></option>
						<option value="1" <?=$this->listing['bathrooms'] == '1' ? 'selected':''?>>1</option>
						<option value="2" <?=$this->listing['bathrooms'] == '2' ? 'selected':''?>>2</option>
						<option value="3" <?=$this->listing['bathrooms'] == '3' ? 'selected':''?>>3</option>
						<option value="4" <?=$this->listing['bathrooms'] == '4' ? 'selected':''?>>4</option>
						<option value="5" <?=$this->listing['bathrooms'] == '5' ? 'selected':''?>>5</option>
						<option value="6" <?=$this->listing['bathrooms'] == '6' ? 'selected':''?>>6</option>
						<option value="7" <?=$this->listing['bathrooms'] == '7' ? 'selected':''?>>7</option>
						<option value="8" <?=$this->listing['bathrooms'] == '8' ? 'selected':''?>>8</option>					
						<option value="9" <?=$this->listing['bathrooms'] == '9' ? 'selected':''?>>9</option>
						<option value="10" <?=$this->listing['bathrooms'] == '10' ? 'selected':''?>>10</option>
					</select>
				</div>
				<div class="pure-control-group">
					<label for="garage">Garage</label>
					<select id="garage" name="garage">					
						<option value></option>
						<option value="1" <?=$this->listing['garage'] == '1' ? 'selected':''?>>Single</option>
						<option value="2" <?=$this->listing['garage'] == '2' ? 'selected':''?>>Double</option>
						<option value="3" <?=$this->listing['garage'] == '3' ? 'selected':''?>>Triple</option>
						<option value="4" <?=$this->listing['garage'] == '4' ? 'selected':''?>>4-Stalls</option>
						<option value="5" <?=$this->listing['garage'] == '5' ? 'selected':''?>>5-Stalls</option>
						<option value="6" <?=$this->listing['garage'] == '6' ? 'selected':''?>>6-Stalls</option>
						<option value="7" <?=$this->listing['garage'] == '7' ? 'selected':''?>>7-Stalls</option>
						<option value="8" <?=$this->listing['garage'] == '8' ? 'selected':''?>>8-Stalls</option>
						<option value="9" <?=$this->listing['garage'] == '9' ? 'selected':''?>>9-Stalls</option>
						<option value="10" <?=$this->listing['garage'] == '10' ? 'selected':''?>>10-Stalls</option>
						<option value="11" <?=$this->listing['garage'] == '11' ? 'selected':''?>>11-Stalls</option>
						<option value="12" <?=$this->listing['garage'] == '12' ? 'selected':''?>>12-Stalls</option>
						<option value="13" <?=$this->listing['garage'] == '13' ? 'selected':''?>>13-Stalls</option>
						<option value="14" <?=$this->listing['garage'] == '14' ? 'selected':''?>>14-Stalls</option>
						<option value="15" <?=$this->listing['garage'] == '15' ? 'selected':''?>>15-Stalls</option>
						<option value="16" <?=$this->listing['garage'] == '16' ? 'selected':''?>>16-Stalls</option>
						<option value="17" <?=$this->listing['garage'] == '17' ? 'selected':''?>>17-Stalls</option>
						<option value="18" <?=$this->listing['garage'] == '18' ? 'selected':''?>>18-Stalls</option>
						<option value="19" <?=$this->listing['garage'] == '19' ? 'selected':''?>>19-Stalls</option>
						<option value="20" <?=$this->listing['garage'] == '20' ? 'selected':''?>>20-Stalls</option>
						<option value="21" <?=$this->listing['garage'] == '21' ? 'selected':''?>>21-Stalls</option>
						<option value="22" <?=$this->listing['garage'] == '22' ? 'selected':''?>>22-Stalls</option>
						<option value="23" <?=$this->listing['garage'] == '23' ? 'selected':''?>>23-Stalls</option>
						<option value="24" <?=$this->listing['garage'] == '24' ? 'selected':''?>>24-Stalls</option>
						<option value="25" <?=$this->listing['garage'] == '25' ? 'selected':''?>>25-Stalls</option>
						<option value="26" <?=$this->listing['garage'] == '26' ? 'selected':''?>>26-Stalls</option>
						<option value="27" <?=$this->listing['garage'] == '27' ? 'selected':''?>>27-Stalls</option>
						<option value="28" <?=$this->listing['garage'] == '28' ? 'selected':''?>>28-Stalls</option>
						<option value="29" <?=$this->listing['garage'] == '29' ? 'selected':''?>>29-Stalls</option>
						<option value="30" <?=$this->listing['garage'] == '30' ? 'selected':''?>>30-Stalls</option>
						<option value="31" <?=$this->listing['garage'] == '31' ? 'selected':''?>>31-Stalls</option>
						<option value="32" <?=$this->listing['garage'] == '32' ? 'selected':''?>>32-Stalls</option>
						<option value="33" <?=$this->listing['garage'] == '33' ? 'selected':''?>>33-Stalls</option>
						<option value="34" <?=$this->listing['garage'] == '34' ? 'selected':''?>>34-Stalls</option>
						<option value="35" <?=$this->listing['garage'] == '35' ? 'selected':''?>>35-Stalls</option>
						<option value="36" <?=$this->listing['garage'] == '36' ? 'selected':''?>>36-Stalls</option>
						<option value="37" <?=$this->listing['garage'] == '37' ? 'selected':''?>>37-Stalls</option>
						<option value="38" <?=$this->listing['garage'] == '38' ? 'selected':''?>>38-Stalls</option>
						<option value="39" <?=$this->listing['garage'] == '39' ? 'selected':''?>>39-Stalls</option>
						<option value="40" <?=$this->listing['garage'] == '40' ? 'selected':''?>>40-Stalls</option>
						<option value="41" <?=$this->listing['garage'] == '41' ? 'selected':''?>>41-Stalls</option>
						<option value="42" <?=$this->listing['garage'] == '42' ? 'selected':''?>>42-Stalls</option>
						<option value="43" <?=$this->listing['garage'] == '43' ? 'selected':''?>>43-Stalls</option>
						<option value="44" <?=$this->listing['garage'] == '44' ? 'selected':''?>>44-Stalls</option>
						<option value="45" <?=$this->listing['garage'] == '45' ? 'selected':''?>>45-Stalls</option>
						<option value="46" <?=$this->listing['garage'] == '46' ? 'selected':''?>>46-Stalls</option>
						<option value="47" <?=$this->listing['garage'] == '47' ? 'selected':''?>>47-Stalls</option>
						<option value="48" <?=$this->listing['garage'] == '48' ? 'selected':''?>>48-Stalls</option>
						<option value="49" <?=$this->listing['garage'] == '49' ? 'selected':''?>>49-Stalls</option>
						<option value="50" <?=$this->listing['garage'] == '50' ? 'selected':''?>>50-Stalls</option>
						<option value="51" <?=$this->listing['garage'] == '51' ? 'selected':''?>>51-Stalls</option>
						<option value="52" <?=$this->listing['garage'] == '52' ? 'selected':''?>>52-Stalls</option>
						<option value="53" <?=$this->listing['garage'] == '53' ? 'selected':''?>>53-Stalls</option>
						<option value="54" <?=$this->listing['garage'] == '54' ? 'selected':''?>>54-Stalls</option>
						<option value="55" <?=$this->listing['garage'] == '55' ? 'selected':''?>>55-Stalls</option>
						<option value="56" <?=$this->listing['garage'] == '56' ? 'selected':''?>>56-Stalls</option>
						<option value="57" <?=$this->listing['garage'] == '57' ? 'selected':''?>>57-Stalls</option>
						<option value="58" <?=$this->listing['garage'] == '58' ? 'selected':''?>>58-Stalls</option>
						<option value="59" <?=$this->listing['garage'] == '59' ? 'selected':''?>>59-Stalls</option>
						<option value="60" <?=$this->listing['garage'] == '60' ? 'selected':''?>>60-Stalls</option>
						<option value="61" <?=$this->listing['garage'] == '61' ? 'selected':''?>>61-Stalls</option>
						<option value="62" <?=$this->listing['garage'] == '62' ? 'selected':''?>>62-Stalls</option>
						<option value="63" <?=$this->listing['garage'] == '63' ? 'selected':''?>>63-Stalls</option>
						<option value="64" <?=$this->listing['garage'] == '64' ? 'selected':''?>>64-Stalls</option>
						<option value="65" <?=$this->listing['garage'] == '65' ? 'selected':''?>>65-Stalls</option>
						<option value="66" <?=$this->listing['garage'] == '66' ? 'selected':''?>>66-Stalls</option>
						<option value="67" <?=$this->listing['garage'] == '67' ? 'selected':''?>>67-Stalls</option>
						<option value="68" <?=$this->listing['garage'] == '68' ? 'selected':''?>>68-Stalls</option>
						<option value="69" <?=$this->listing['garage'] == '69' ? 'selected':''?>>69-Stalls</option>
						<option value="70" <?=$this->listing['garage'] == '70' ? 'selected':''?>>70-Stalls</option>
						<option value="71" <?=$this->listing['garage'] == '71' ? 'selected':''?>>71-Stalls</option>
						<option value="72" <?=$this->listing['garage'] == '72' ? 'selected':''?>>72-Stalls</option>
						<option value="73" <?=$this->listing['garage'] == '73' ? 'selected':''?>>73-Stalls</option>
						<option value="74" <?=$this->listing['garage'] == '74' ? 'selected':''?>>74-Stalls</option>
						<option value="75" <?=$this->listing['garage'] == '75' ? 'selected':''?>>75-Stalls</option>
						<option value="76" <?=$this->listing['garage'] == '76' ? 'selected':''?>>76-Stalls</option>
						<option value="77" <?=$this->listing['garage'] == '77' ? 'selected':''?>>77-Stalls</option>
						<option value="78" <?=$this->listing['garage'] == '78' ? 'selected':''?>>78-Stalls</option>
						<option value="79" <?=$this->listing['garage'] == '79' ? 'selected':''?>>79-Stalls</option>
						<option value="80" <?=$this->listing['garage'] == '80' ? 'selected':''?>>80-Stalls</option>
						<option value="81" <?=$this->listing['garage'] == '81' ? 'selected':''?>>81-Stalls</option>
						<option value="82" <?=$this->listing['garage'] == '82' ? 'selected':''?>>82-Stalls</option>
						<option value="83" <?=$this->listing['garage'] == '83' ? 'selected':''?>>83-Stalls</option>
						<option value="84" <?=$this->listing['garage'] == '84' ? 'selected':''?>>84-Stalls</option>
						<option value="85" <?=$this->listing['garage'] == '85' ? 'selected':''?>>85-Stalls</option>
						<option value="86" <?=$this->listing['garage'] == '86' ? 'selected':''?>>86-Stalls</option>
						<option value="87" <?=$this->listing['garage'] == '87' ? 'selected':''?>>87-Stalls</option>
						<option value="88" <?=$this->listing['garage'] == '88' ? 'selected':''?>>88-Stalls</option>
						<option value="89" <?=$this->listing['garage'] == '89' ? 'selected':''?>>89-Stalls</option>
						<option value="90" <?=$this->listing['garage'] == '90' ? 'selected':''?>>90-Stalls</option>
						<option value="91" <?=$this->listing['garage'] == '91' ? 'selected':''?>>91-Stalls</option>
						<option value="92" <?=$this->listing['garage'] == '92' ? 'selected':''?>>92-Stalls</option>
						<option value="93" <?=$this->listing['garage'] == '93' ? 'selected':''?>>93-Stalls</option>
						<option value="94" <?=$this->listing['garage'] == '94' ? 'selected':''?>>94-Stalls</option>
						<option value="95" <?=$this->listing['garage'] == '95' ? 'selected':''?>>95-Stalls</option>
						<option value="96" <?=$this->listing['garage'] == '96' ? 'selected':''?>>96-Stalls</option>
						<option value="97" <?=$this->listing['garage'] == '97' ? 'selected':''?>>97-Stalls</option>
						<option value="98" <?=$this->listing['garage'] == '98' ? 'selected':''?>>98-Stalls</option>
						<option value="99" <?=$this->listing['garage'] == '99' ? 'selected':''?>>99-Stalls</option>
						<option value="100" <?=$this->listing['garage'] == '100' ? 'selected':''?>>100-Stalls</option>
						<option value="101" <?=$this->listing['garage'] == '101' ? 'selected':''?>>101-Stalls</option>
						<option value="102" <?=$this->listing['garage'] == '102' ? 'selected':''?>>102-Stalls</option>
						<option value="103" <?=$this->listing['garage'] == '103' ? 'selected':''?>>103-Stalls</option>
						<option value="104" <?=$this->listing['garage'] == '104' ? 'selected':''?>>104-Stalls</option>
						<option value="105" <?=$this->listing['garage'] == '105' ? 'selected':''?>>105-Stalls</option>
						<option value="106" <?=$this->listing['garage'] == '106' ? 'selected':''?>>106-Stalls</option>
						<option value="107" <?=$this->listing['garage'] == '107' ? 'selected':''?>>107-Stalls</option>
						<option value="108" <?=$this->listing['garage'] == '108' ? 'selected':''?>>108-Stalls</option>
						<option value="109" <?=$this->listing['garage'] == '109' ? 'selected':''?>>109-Stalls</option>
						<option value="110" <?=$this->listing['garage'] == '110' ? 'selected':''?>>110-Stalls</option>
						<option value="111" <?=$this->listing['garage'] == '111' ? 'selected':''?>>111-Stalls</option>
						<option value="112" <?=$this->listing['garage'] == '112' ? 'selected':''?>>112-Stalls</option>
						<option value="113" <?=$this->listing['garage'] == '113' ? 'selected':''?>>113-Stalls</option>
						<option value="114" <?=$this->listing['garage'] == '114' ? 'selected':''?>>114-Stalls</option>
						<option value="115" <?=$this->listing['garage'] == '115' ? 'selected':''?>>115-Stalls</option>
						<option value="116" <?=$this->listing['garage'] == '116' ? 'selected':''?>>116-Stalls</option>
						<option value="117" <?=$this->listing['garage'] == '117' ? 'selected':''?>>117-Stalls</option>
						<option value="118" <?=$this->listing['garage'] == '118' ? 'selected':''?>>118-Stalls</option>
						<option value="119" <?=$this->listing['garage'] == '119' ? 'selected':''?>>119-Stalls</option>
						<option value="120" <?=$this->listing['garage'] == '120' ? 'selected':''?>>120-Stalls</option>
						<option value="121" <?=$this->listing['garage'] == '121' ? 'selected':''?>>121-Stalls</option>
						<option value="122" <?=$this->listing['garage'] == '122' ? 'selected':''?>>122-Stalls</option>
						<option value="123" <?=$this->listing['garage'] == '123' ? 'selected':''?>>123-Stalls</option>
						<option value="124" <?=$this->listing['garage'] == '124' ? 'selected':''?>>124-Stalls</option>
						<option value="125" <?=$this->listing['garage'] == '125' ? 'selected':''?>>125-Stalls</option>
						<option value="126" <?=$this->listing['garage'] == '126' ? 'selected':''?>>125+Stalls</option>				
					</select>
					<span style="font-size:0.8em;">Type</span>
					<select id="garage_type" name="garage_type">
						<option value></option>
						<option value="Attached" <?=$this->listing['garage_type'] == 'Attached' ? 'selected':''?>>Attached</option>
						<option value="Detached" <?=$this->listing['garage_type'] == 'Detached' ? 'selected':''?>>Detached</option>
					</select>	
					<input id="garage_note" name="garage_note" type="text" placeholder="Note" style="margin-left:60px;" class="pure-input-1-3" value="<?=$this->listing['garage_note']?>">
				</div>						
				<div class="pure-control-group">
					<label for="basement">Basement</label>
					<select id="basement" name="basement">
						<option value></option>
						<option value="Yes" <?=$this->listing['basement'] == 'Yes' ? 'selected':''?>>Yes</option>
						<option value="No" <?=$this->listing['basement'] == 'No' ? 'selected':''?>>No</option>
					</select>
					<span style="font-size:0.8em;">Type</span>
					<select id="basement_type" name="basement_type">
						<option value></option>					
						<option value="Crawl" <?=$this->listing['basement_type'] == 'Crawl' ? 'selected':''?>>Crawl</option>
						<option value="Partial" <?=$this->listing['basement_type'] == 'Partial' ? 'selected':''?>>Partial</option>
						<option value="Slab" <?=$this->listing['basement_type'] == 'Slab' ? 'selected':''?>>Slab</option>
						<option value="Walkout" <?=$this->listing['basement_type'] == 'Walkout' ? 'selected':''?>>Walkout</option>
						<option value="Full" <?=$this->listing['basement_type'] == 'Full' ? 'selected':''?>>Full</option>			
					</select>	
					<input id="basement_note" name="basement_note" type="text" placeholder="Note" style="margin-left:107px;" class="pure-input-1-3" value="<?=$this->listing['basement_note']?>">
				</div>
				<div class="pure-control-group">
					<label for="virtual_tour_url">Virtual Tour</label>
					<input id="virtual_tour_url" name="virtual_tour_url" style="width:610px;" type="text" placeholder="URL" value="<?=$this->listing['virtual_tour_url']?>">
				</div>				
				<legend>Lot</legend>
				<div class="pure-control-group">
					<label for="lot_legal">Lot Legal</label>
					<input id="lot_legal" name="lot_legal" type="text" placeholder="Lot Legal" value="<?=$this->listing['lot_legal']?>">
				</div>
				<div class="pure-control-group">
					<label for="lot_type">Type</label>
					<select id="lot_type" name="lot_type">
						<option value></option>
						<option value="Corner" <?=$this->listing['lot_type'] == 'Corner' ? 'selected':''?>>Corner</option>
						<option value="Irregular" <?=$this->listing['lot_type'] == 'Irregular' ? 'selected':''?>>Irregular</option>
						<option value="Rectangular" <?=$this->listing['lot_type'] == 'Rectangular' ? 'selected':''?>>Rectangular</option>
						<option value="Wedge" <?=$this->listing['lot_type'] == 'Wedge' ? 'selected':''?>>Wedge</option>
					</select>			
				</div>
				<div class="pure-control-group">
					<label for="lot_size">Size</label>
					<input id="lot_size" name="lot_size" type="text" placeholder="Size" style="width:80px;" value="<?=rtrim(rtrim($this->listing['lot_size'], "0"), ".")?>">
					<select id="lot_size_unit" name="lot_size_unit">					
						<option value="acres" <?=$this->listing['lot_size_unit'] == 'acres' ? 'selected':''?>>acres</option>
						<option value="hectares" <?=$this->listing['lot_size_unit'] == 'hectares' ? 'selected':''?>>hectares</option>
						<option value="square feet" <?=$this->listing['lot_size_unit'] == 'square feet' ? 'selected':''?>>square feet</option>
						<option value="square meters" <?=$this->listing['lot_size_unit'] == 'square meters' ? 'selected':''?>>square meters</option>
					</select>							
				</div>
				<div class="pure-control-group">
					<label for="dimensions">Dimensions</label>
					<input id="dimensions_w" name="dimensions_w" type="text" placeholder="" style="width:80px;" value="<?=rtrim(rtrim($this->listing['dimensions_w'], "0"), ".")?>"> x <input id="dimensions_l" name="dimensions_l" type="text" placeholder="" style="width:80px;" value="<?=rtrim(rtrim($this->listing['dimensions_l'], "0"), ".")?>">
					<select id="dimensions_unit" name="dimensions_unit">					
						<option value="feet" <?=$this->listing['dimensions_unit'] == 'feet' ? 'selected':''?>>feet</option>
						<option value="inches" <?=$this->listing['dimensions_unit'] == 'inches' ? 'selected':''?>>inches</option>
						<option value="meters" <?=$this->listing['dimensions_unit'] == 'meters' ? 'selected':''?>>meters</option>
					</select>				
				</div>
				<legend>Taxes and fees</legend>
				<div class="pure-control-group">
					<label for="amount">Amount</label>
					<input id="amount" name="amount" type="text" placeholder="Amount" value="<?=rtrim(rtrim($this->listing['amount'], "0"), ".")?>">
					<span style="font-size:0.8em;">For Year</span>
					<input id="amount_for_year" name="amount_for_year" type="number" maxlength="4" placeholder="Year" style="width:80px;" value="<?=$this->listing['amount_for_year']?>">
				</div>
				<div class="pure-control-group">
					<label for="condo_fee">Condo Fee</label>
					<input id="condo_fee" name="condo_fee" type="text" placeholder="Condo Fee" value="<?=rtrim(rtrim($this->listing['condo_fee'], "0"), ".")?>">
				</div>
				<legend>Description</legend>
				<div class="pure-control-group">				
					<textarea rows="14" cols="80" name="description" id="description"><?=$this->listing['description']?></textarea> 
				</div>			
				<div class="pure-controls" style="text-align:left;padding:40px 0;margin:0;height:30px;width:160px;text-align:center;">			
					<button type="submit" class="pure-button pure-button-small pure-button-primary" id="btnSave">Save</button>&nbsp;<button type="submit" class="pure-button pure-button-small pure-button-primary" id="btnDelete">Delete</button>
				</div>
			</fieldset>
		</form>
	</div>
	<div id="gallery">
<style>
#files_table{
	border:0;
}
.thumb {
    height: 50px;
    border: 1px solid #DFDFDF;    
	display:block;
}
.progress {
	width: 200px;   
	border: 1px solid #DFDFDF;
	position: relative; 
	background-color:#fff;
}
.percent {
	position: absolute;   
	left: 45%;
}
.bar {
	height: 10px;
	background-color:#B2D6F8;
	width:0.5%;
}  
.pure-form-stacked img{
	display:block;
}
.pure-form-stacked .pure-controls img{
	display:inline;
}
.pure-u-1-5{
	position:relative;
}
#gallery_container img{
	width:176px;
}
#gallery_container > div{
	height:159px;
}
</style>
		
        <form class="pure-form" method="post" enctype="multipart/form-data" id="upload_form">        
			<legend>File Upload</legend>
			<div style="height:70px;">				
				<div class="fileUpload pure-button pure-button-xsmall pure-button-secondary" style="float:left;margin:5px;">
					<span>+ Add files...</span>
					<input type="file" class="upload" id="upload" accept="image/*" multiple />
				</div>	
				<div class="pure-button pure-button-xsmall pure-button-secondary btnStartUpload" style="float:left;margin:5px;">                    
				   <span>Start upload</span>
				</div>
				<div class="pure-button pure-button-xsmall pure-button-secondary btnClearQueue" style="float:left;margin:5px;">
				   <span>Clear Queue</span>
				</div>			
				<div style="clear:both;font-size:0.7em;color:#555;">
					<span>* Maximum 5 files</span>
				</div>
			</div>
			<div style="max-height:324px;">
				<table id="files_table" class="pure-table pure-table-horizontal"></table>				
			</div>
		</form> 
		<form class="pure-form pure-form-stacked" id="gallery_form" style="margin-top:30px;">
			<legend>Photos <span id="photo_count" style="font-size:0.75em;">(<?=count($this->gallery)?>)</span></legend>
			<div class="pure-g-r" id="gallery_container" data-dom-cache="false">
				<?php for ($i=0; $i < count($this->gallery); $i++){ ?>
				<div class="pure-u-1-5" id="<?=$this->gallery[$i]['gid'] ?>">
					<img src="<?=URL?>views/admin/server/files/thumbnail/<?=$this->gallery[$i]['filename'] ?>" />
					<input id="description<?=$this->gallery[$i]['gid'] ?>" name="description<?=$this->gallery[$i]['gid'] ?>" type="text" class="pure-input-1" placeholder="Description" style="width:94.5%;" value="<?=$this->gallery[$i]['description']?>">
					<button type="button" class="pure-button pure-button-xsmall pure-button-delete btnDeleteImg">x</button>					
					<input id="album_cover<?=$this->gallery[$i]['gid'] ?>" type="radio" name="album_cover" value="<?=$this->gallery[$i]['gid'] ?>" class="album_cover_rb" <?=$this->gallery[$i]['album_cover'] == 'Yes' ? 'checked':''?>>					
				</div>	
				<?php } ?>
			</div>
			<div class="pure-controls" style="text-align:left;padding:40px 0;margin:0;height:30px;width:73px;text-align:center;">			
				<button type="submit" class="pure-button pure-button-small pure-button-primary" id="btnSaveGallery">Save</button>
			</div>
		</form>
	</div>
	<div id="youtube">
		<form class="pure-form pure-form-stacked" id="youtube_form" style="margin-top:30px;">
			<legend>Youtube</legend>
			<div class="pure-control-group" style="margin-bottom:20px;">
				<label for="youtube_url">URL</label>
				<input id="youtube_url" name="youtube_url" type="text" style="width:400px;" placeholder="Youtube URL" value="<?=$this->listing['youtube']?>">
			</div>			
			<div class="pure-control-group">				
				<div class="youtube_container" style="width:709px;position:relative;">				
				<?php 
					function parse_yturl($url) 
					{
						$pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
						preg_match($pattern, $url, $matches);
						return (isset($matches[1])) ? $matches[1] : false;
					}								
					
					if (parse_yturl($this->listing['youtube'])){
				?>								
				
					<label for="youtube" style="margin-bottom:20px;">Preview</label>
					<iframe width="709" height="399" src="//www.youtube.com/embed/<?=parse_yturl($this->listing['youtube'])?>?wmode=opaque" frameborder="0" allowfullscreen></iframe>	
					<button type="button" class="pure-button pure-button-xsmall pure-button-delete btnDeleteYoutube" style="right:0;top:36px;padding:5px 13px;font-size:1.3em;font-weight:bold;background: rgba(66, 184, 221, 0.8);z-index:1;">x</button>
				
				<?php } ?>
				</div>
			</div>						
			<div class="pure-controls" style="text-align:left;padding:40px 0;margin:0;height:30px;width:73px;text-align:center;">			
				<button type="submit" class="pure-button pure-button-small pure-button-primary" id="btnSaveYoutube">Save</button>
			</div>
		</form>	
	</div>
</div>
<?php }else{ ?>
<form class="pure-form pure-form-aligned" id="listing_form">
	<fieldset>
		<legend>Address & Location</legend>
		<div class="pure-control-group">
			<label for="address"><span style="color:#B51313;">*</span> Address</label>
			<input id="address" name="address" type="text" placeholder="Address" class="pure-input-1-3">
		</div>
		<div class="pure-control-group">
			<label for="suite_number">Suite Number</label>				
			<input id="suite_number" name="suite_number" type="text" placeholder="Suite No." class="pure-input-1-4" style="width:80px;">				
		</div>			
		<div class="pure-control-group">
			<label for="neighborhood"><span style="color:#B51313;">*</span> Neighborhood</label>
			<input id="neighborhood" name="neighborhood" type="text" placeholder="Neighborhood" class="pure-input-1-3">
		</div>
		<div class="pure-control-group">
			<label for="city"><span style="color:#B51313;">*</span> City</label>
			<select id="city" name="city">
				<option value></option>
				<option value="Ajax">Ajax</option>
				<option value="Aurora">Aurora</option>
				<option value="Brampton">Brampton</option>
				<option value="Burlington">Burlington</option>
				<option value="Markham">Markham</option>
				<option value="Milton">Milton</option>
				<option value="Mississauga">Mississauga</option>
				<option value="Newmarket">Newmarket</option>
				<option value="North York">North York</option>
				<option value="Oakville">Oakville</option>
				<option value="Oshawa">Oshawa</option>
				<option value="Pickering">Pickering</option>
				<option value="Richmond Hill">Richmond Hill</option>
				<option value="Scarborough">Scarborough</option>
				<option value="Toronto">Toronto</option>
				<option value="Vaughan">Vaughan</option>					
				<option value="Whitby">Whitby</option>
			</select>
		</div>
		<div class="pure-control-group">
			<label for="postal_zip">Postal/Zip Code</label>				
			<input id="postal_zip" name="postal_zip" type="text" maxlength="6" placeholder="Postal/Zip" class="pure-input-1-4" style="width:80px;">
		</div>
		<div class="pure-control-group">
			<label for="mls_location">MLS&reg; Location</label>
			<input id="mls_location" name="mls_location" type="text" placeholder="MLS&reg; Location">
		</div>
		<legend>General Information</legend>
		<div class="pure-control-group">
			<label for="status">Status</label>				
			<select id="status" name="status">
				<option value></option>
				<option value="For Sale">For Sale</option>
				<option value="Sale Pending">Sale Pending</option>
				<option value="Sold">Sold</option>
				<option value="For Rent/Lease">For Rent/Lease</option>
				<option value="Rented/Leased">Rented/Leased</option>					
				<option value="Expired">Expired</option>
				<option value="Archived">Archived</option>
			</select>				
		</div>
		<div class="pure-control-group">
			<label for="listed_date"><span style="color:#B51313;">*</span> Listed Date</label>
			<input id="listed_date" class="datepicker" name="listed_date" type="text" placeholder="yyyy-mm-dd">
		</div>
		<div class="pure-control-group">
			<label for="expiry_date">Expiry Date</label>
			<input id="expiry_date" class="datepicker" name="expiry_date" type="text" placeholder="yyyy-mm-dd">
		</div>
		<div class="pure-control-group">
			<label for="price">Price</label>
			<input id="price" name="price" type="text" placeholder="Price">
		</div>			
		<div class="pure-control-group">
			<label for="rent_lease">Rent/Lease</label>
			<input id="rent_lease" name="rent_lease" type="text" placeholder="Rent/Lease" disabled>
			<select id="rent_lease_length" name="rent_lease_length" disabled>
				<option value="Daily">Daily</option>
				<option value="Weekly">Weekly</option>
				<option value="Monthly" selected>Monthly</option>
				<option value="Six Months">Six Months</option>
				<option value="Yearly">Yearly</option>
				<option value="Two Years">Two Years</option>
				<option value="Three Years">Three Years</option>
				<option value="Five Years">Five Years</option>
				<option value="Negotiable">Negotiable</option>
			</select>								
		</div>						
		<div class="pure-control-group">
			<label for="price_highlight">Price Highlight</label>
			<input id="price_highlight" name="price_highlight" type="text" placeholder="Price Highlight" class="pure-input-1-3">
		</div>
		<div class="pure-control-group">
			<label for="general_highlight">General Highlight</label>
			<input id="general_highlight" name="general_highlight" type="text" placeholder="General Highlight" class="pure-input-1-3">
		</div>
		<div class="pure-control-group">
			<label for="mls_number"><span style="color:#B51313;">*</span> MLS&reg; Number</label>
			<input id="mls_number" name="mls_number" type="text" placeholder="MLS&reg; Number">
		</div>
		<legend>Details</legend>
		<div class="pure-control-group">
			<label for="new_construction">New Construction</label>				
			<input id="new_construction" name="new_construction" type="checkbox" value="">				
		</div>
		<div class="pure-control-group">
			<label for="development_level">Development Level</label>				
			<select id="development_level" name="development_level" style="width:160px;" disabled>
				<option value="Built" selected>Built</option>
				<option value="Land Only">Land Only</option>
				<option value="Plan Only">Plan Only</option>
				<option value="Renovation">Renovation</option>
				<option value="Under Construction">Under Construction</option>
			</select>				
		</div>						
		<div class="pure-control-group">
			<label for="development_type">Type</label>
			<select id="development_type" name="development_type" style="width:160px;">
				<option value></option>
				<option value="Commercial">Commercial</option>
				<option value="Condominium">Condominium</option>
				<option value="Farm and Ranch">Farm and Ranch</option>
				<option value="Lots and Land">Lots and Land</option>
				<option value="Multifamily">Multifamily</option>
				<option value="Other">Other</option>
				<option value="Recreational">Recreational</option>
				<option value="Residential">Residential</option>
			</select>
		</div>
		<div class="pure-control-group">
			<label for="has_suite">Has Suite</label>				
			<input id="has_suite_option_one" type="radio" name="has_suite" value="Yes">
			<span style="font-size:0.8em;">Yes</span>
			<input id="has_suite_option_two" type="radio" name="has_suite" value="No">
			<span style="font-size:0.8em;">No</span>			
			<input id="has_suite_option_three" type="radio" name="has_suite" value="Potential">
			<span style="font-size:0.8em;">Potential</span>
		</div>
		<div class="pure-control-group">
			<label for="style">Style</label>
			<select id="style" name="style">
				<option value></option>
				<option value="1 1/2 Storey">1 1/2 Storey</option>
				<option value="1 3/4 Storey">1 3/4 Storey</option>
				<option value="2 1/2 Storey">2 1/2 Storey</option>
				<option value="2 Storey">2 Storey</option>
				<option value="2 Storey Split">2 Storey Split</option>
				<option value="3 Storey">3 Storey</option>
				<option value="3-Level Split">3-Level Split</option>
				<option value="4-Level Split">4-Level Split</option>
				<option value="5-Level Split">5-Level Split</option>
				<option value="Apartment">Apartment</option>
				<option value="Bi-Level">Bi-Level</option>
				<option value="Bungalow">Bungalow</option>
				<option value="Colonial">Colonial</option>
				<option value="Commercial">Commercial</option>
				<option value="Duplex">Duplex</option>
				<option value="Fourplex">Fourplex</option>
				<option value="Lot / Land">Lot / Land</option>
				<option value="Manufactured Home">Manufactured Home</option>
				<option value="Multiplex">Multiplex</option>
				<option value="Other">Other</option>
				<option value="Ranch">Ranch</option>
				<option value="Single Storey">Single Storey</option>
				<option value="Townhouse">Townhouse</option>
				<option value="Triplex">Triplex</option>			
			</select>
		</div>
		<div class="pure-control-group">
			<label for="year_built">Year Built</label>				
			<input id="year_built" name="year_built" type="number" maxlength="4" placeholder="Year Built" style="width:80px;">
		</div>			
		<div class="pure-control-group">
			<label for="d_size">Size</label>
			<input id="d_size" name="d_size" type="number" placeholder="Size" style="width:80px;">
			<select id="size_unit" name="size_unit">					
				<option value="square feet">square feet</option>
				<option value="square meters">square meters</option>
			</select>					
		</div>
		<div class="pure-control-group">
			<label for="bedrooms">Bedrooms</label>
			<select id="bedrooms" name="bedrooms">
				<option value></option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>					
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>	
			</select>
			<span style="font-size:0.8em;">Plus?</span>
			<select id="plus" name="plus">
				<option value></option>
				<option value="+1">+1</option>
				<option value="+2">+2</option>
				<option value="+3">+3</option>
				<option value="+4">+4</option>
				<option value="+5">+5</option>
			</select>				
		</div>
		<div class="pure-control-group">
			<label for="bathrooms">Bathrooms</label>
			<select id="bathrooms" name="bathrooms">
				<option value></option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>					
				<option value="9">9</option>
				<option value="10">10</option>
			</select>
		</div>
		<div class="pure-control-group">
			<label for="garage">Garage</label>
			<select id="garage" name="garage">					
				<option value></option>
				<option value="1">Single</option>
				<option value="2">Double</option>
				<option value="3">Triple</option>
				<option value="4">4-Stalls</option>
				<option value="5">5-Stalls</option>
				<option value="6">6-Stalls</option>
				<option value="7">7-Stalls</option>
				<option value="8">8-Stalls</option>
				<option value="9">9-Stalls</option>
				<option value="10">10-Stalls</option>
				<option value="11">11-Stalls</option>
				<option value="12">12-Stalls</option>
				<option value="13">13-Stalls</option>
				<option value="14">14-Stalls</option>
				<option value="15">15-Stalls</option>
				<option value="16">16-Stalls</option>
				<option value="17">17-Stalls</option>
				<option value="18">18-Stalls</option>
				<option value="19">19-Stalls</option>
				<option value="20">20-Stalls</option>
				<option value="21">21-Stalls</option>
				<option value="22">22-Stalls</option>
				<option value="23">23-Stalls</option>
				<option value="24">24-Stalls</option>
				<option value="25">25-Stalls</option>
				<option value="26">26-Stalls</option>
				<option value="27">27-Stalls</option>
				<option value="28">28-Stalls</option>
				<option value="29">29-Stalls</option>
				<option value="30">30-Stalls</option>
				<option value="31">31-Stalls</option>
				<option value="32">32-Stalls</option>
				<option value="33">33-Stalls</option>
				<option value="34">34-Stalls</option>
				<option value="35">35-Stalls</option>
				<option value="36">36-Stalls</option>
				<option value="37">37-Stalls</option>
				<option value="38">38-Stalls</option>
				<option value="39">39-Stalls</option>
				<option value="40">40-Stalls</option>
				<option value="41">41-Stalls</option>
				<option value="42">42-Stalls</option>
				<option value="43">43-Stalls</option>
				<option value="44">44-Stalls</option>
				<option value="45">45-Stalls</option>
				<option value="46">46-Stalls</option>
				<option value="47">47-Stalls</option>
				<option value="48">48-Stalls</option>
				<option value="49">49-Stalls</option>
				<option value="50">50-Stalls</option>
				<option value="51">51-Stalls</option>
				<option value="52">52-Stalls</option>
				<option value="53">53-Stalls</option>
				<option value="54">54-Stalls</option>
				<option value="55">55-Stalls</option>
				<option value="56">56-Stalls</option>
				<option value="57">57-Stalls</option>
				<option value="58">58-Stalls</option>
				<option value="59">59-Stalls</option>
				<option value="60">60-Stalls</option>
				<option value="61">61-Stalls</option>
				<option value="62">62-Stalls</option>
				<option value="63">63-Stalls</option>
				<option value="64">64-Stalls</option>
				<option value="65">65-Stalls</option>
				<option value="66">66-Stalls</option>
				<option value="67">67-Stalls</option>
				<option value="68">68-Stalls</option>
				<option value="69">69-Stalls</option>
				<option value="70">70-Stalls</option>
				<option value="71">71-Stalls</option>
				<option value="72">72-Stalls</option>
				<option value="73">73-Stalls</option>
				<option value="74">74-Stalls</option>
				<option value="75">75-Stalls</option>
				<option value="76">76-Stalls</option>
				<option value="77">77-Stalls</option>
				<option value="78">78-Stalls</option>
				<option value="79">79-Stalls</option>
				<option value="80">80-Stalls</option>
				<option value="81">81-Stalls</option>
				<option value="82">82-Stalls</option>
				<option value="83">83-Stalls</option>
				<option value="84">84-Stalls</option>
				<option value="85">85-Stalls</option>
				<option value="86">86-Stalls</option>
				<option value="87">87-Stalls</option>
				<option value="88">88-Stalls</option>
				<option value="89">89-Stalls</option>
				<option value="90">90-Stalls</option>
				<option value="91">91-Stalls</option>
				<option value="92">92-Stalls</option>
				<option value="93">93-Stalls</option>
				<option value="94">94-Stalls</option>
				<option value="95">95-Stalls</option>
				<option value="96">96-Stalls</option>
				<option value="97">97-Stalls</option>
				<option value="98">98-Stalls</option>
				<option value="99">99-Stalls</option>
				<option value="100">100-Stalls</option>
				<option value="101">101-Stalls</option>
				<option value="102">102-Stalls</option>
				<option value="103">103-Stalls</option>
				<option value="104">104-Stalls</option>
				<option value="105">105-Stalls</option>
				<option value="106">106-Stalls</option>
				<option value="107">107-Stalls</option>
				<option value="108">108-Stalls</option>
				<option value="109">109-Stalls</option>
				<option value="110">110-Stalls</option>
				<option value="111">111-Stalls</option>
				<option value="112">112-Stalls</option>
				<option value="113">113-Stalls</option>
				<option value="114">114-Stalls</option>
				<option value="115">115-Stalls</option>
				<option value="116">116-Stalls</option>
				<option value="117">117-Stalls</option>
				<option value="118">118-Stalls</option>
				<option value="119">119-Stalls</option>
				<option value="120">120-Stalls</option>
				<option value="121">121-Stalls</option>
				<option value="122">122-Stalls</option>
				<option value="123">123-Stalls</option>
				<option value="124">124-Stalls</option>
				<option value="125">125-Stalls</option>
				<option value="126">125+Stalls</option>			
			</select>
			<span style="font-size:0.8em;">Type</span>
			<select id="garage_type" name="garage_type">
				<option value></option>
				<option value="Attached">Attached</option>
				<option value="Detached">Detached</option>
			</select>	
			<input id="garage_note" name="garage_note" type="text" placeholder="Note" style="margin-left:60px;" class="pure-input-1-3">
		</div>						
		<div class="pure-control-group">
			<label for="basement">Basement</label>
			<select id="basement" name="basement">
				<option value></option>
				<option value="Yes">Yes</option>
				<option value="No">No</option>
			</select>
			<span style="font-size:0.8em;">Type</span>
			<select id="basement_type" name="basement_type">
				<option value></option>					
				<option value="Crawl">Crawl</option>
				<option value="Partial">Partial</option>
				<option value="Slab">Slab</option>
				<option value="Walkout">Walkout</option>
				<option value="Full">Full</option>			
			</select>	
			<input id="basement_note" name="basement_note" type="text" placeholder="Note" style="margin-left:107px;" class="pure-input-1-3">
		</div>
		<div class="pure-control-group">
			<label for="virtual_tour_url">Virtual Tour</label>
			<input id="virtual_tour_url" name="virtual_tour_url" type="text" style="width:610px;" placeholder="URL">
		</div>		
		<legend>Lot</legend>
		<div class="pure-control-group">
			<label for="lot_legal">Lot Legal</label>
			<input id="lot_legal" name="lot_legal" type="text" placeholder="Lot Legal">
		</div>
		<div class="pure-control-group">
			<label for="lot_type">Type</label>
			<select id="lot_type" name="lot_type">
				<option value></option>
				<option value="Corner">Corner</option>
				<option value="Irregular">Irregular</option>
				<option value="Rectangular">Rectangular</option>
				<option value="Wedge">Wedge</option>
			</select>			
		</div>
		<div class="pure-control-group">
			<label for="lot_size">Size</label>
			<input id="lot_size" name="lot_size" type="text" placeholder="Size" style="width:80px;">
			<select id="lot_size_unit" name="lot_size_unit">					
				<option value="acres">acres</option>
				<option value="hectares">hectares</option>
				<option value="square feet">square feet</option>
				<option value="square meters">square meters</option>
			</select>							
		</div>
		<div class="pure-control-group">
			<label for="dimensions">Dimensions</label>
			<input id="dimensions_w" name="dimensions_w" type="text" placeholder="" style="width:80px;"> x <input id="dimensions_l" name="dimensions_l" type="text" placeholder="" style="width:80px;">
			<select id="dimensions_unit" name="dimensions_unit">					
				<option value="feet">feet</option>
				<option value="inches">inches</option>
				<option value="meters">meters</option>
			</select>				
		</div>
		<legend>Taxes and fees</legend>
		<div class="pure-control-group">
			<label for="amount">Amount</label>
			<input id="amount" name="amount" type="text" placeholder="Amount">
			<span style="font-size:0.8em;">For Year</span>
			<input id="amount_for_year" name="amount_for_year" type="number" maxlength="4" placeholder="Year" style="width:80px;">
		</div>
		<div class="pure-control-group">
			<label for="condo_fee">Condo Fee</label>
			<input id="condo_fee" name="condo_fee" type="text" placeholder="Condo Fee">
		</div>
		<legend>Description</legend>
		<div class="pure-control-group">				
			<textarea rows="14" cols="80" name="description" id="description"></textarea> 
		</div>			
		<section>
			<div class="pure-controls white_bar" style="text-align:left;padding:40px 0;margin:0;height:30px;width:145px;text-align:center;">			
				<button type="submit" class="pure-button pure-button-small pure-button-primary" id="btnAdd">Add</button>&nbsp;<button type="submit" class="pure-button pure-button-small pure-button-primary" id="btnClear">Clear</button>
			</div>
		</section>
	</fieldset>
</form>		
<?php } ?>