<?php if (isset($this->condo)) { ?>
<div id="tab-container" class="tab-container">
	<ul class='etabs'>
		<li class='tab'><a href="#e_form"><i class="icon-edit" style="margin-right:5px;"></i>Edit</a></li>
		<li class='tab'><a href="#gallery"><i class="icon-picture" style="margin-right:5px;"></i>Gallery</a></li>    
		<li class='tab'><a href="#youtube"><i class="icon-youtube-play" style="margin-right:5px;"></i>Youtube</a></li> 
		<li class='tab'><a href="#cover_image"><i class="icon-group" style="margin-right:5px;"></i>Cover Image</a></li>
		<li class='tab'><a href="#floor_plan"><i class="icon-file-text" style="margin-right:5px;"></i>Floor Plan</a></li>
	</ul>
	<div id="e_form">
		<form class="pure-form pure-form-aligned" id="condo_form">
			<fieldset>
				<legend>Address & Location</legend>
				<div class="pure-control-group">
					<label for="address"><span style="color:#B51313;">*</span> Address</label>
					<input id="address" name="address" type="text" placeholder="Address" class="pure-input-1-3" value="<?=$this->condo['address']?>">
				</div>
				<div class="pure-control-group">
					<label for="city"><span style="color:#B51313;">*</span> City</label>
					<select id="city" name="city">
						<option value></option>
						<option value="Ajax" <?=$this->condo['city'] == 'Ajax' ? 'selected':''?>>Ajax</option>
						<option value="Aurora" <?=$this->condo['city'] == 'Aurora' ? 'selected':''?>>Aurora</option>
						<option value="Brampton" <?=$this->condo['city'] == 'Brampton' ? 'selected':''?>>Brampton</option>
						<option value="Burlington" <?=$this->condo['city'] == 'Burlington' ? 'selected':''?>>Burlington</option>
						<option value="Markham" <?=$this->condo['city'] == 'Markham' ? 'selected':''?>>Markham</option>
						<option value="Milton" <?=$this->condo['city'] == 'Milton' ? 'selected':''?>>Milton</option>
						<option value="Mississauga" <?=$this->condo['city'] == 'Mississauga' ? 'selected':''?>>Mississauga</option>
						<option value="Newmarket" <?=$this->condo['city'] == 'Newmarket' ? 'selected':''?>>Newmarket</option>
						<option value="North York" <?=$this->condo['city'] == 'North York' ? 'selected':''?>>North York</option>
						<option value="Oakville" <?=$this->condo['city'] == 'Oakville' ? 'selected':''?>>Oakville</option>
						<option value="Oshawa" <?=$this->condo['city'] == 'Oshawa' ? 'selected':''?>>Oshawa</option>
						<option value="Pickering" <?=$this->condo['city'] == 'Pickering' ? 'selected':''?>>Pickering</option>
						<option value="Richmond Hill" <?=$this->condo['city'] == 'Richmond Hill' ? 'selected':''?>>Richmond Hill</option>
						<option value="Scarborough" <?=$this->condo['city'] == 'Scarborough' ? 'selected':''?>>Scarborough</option>
						<option value="Toronto" <?=$this->condo['city'] == 'Toronto' ? 'selected':''?>>Toronto</option>
						<option value="Vaughan" <?=$this->condo['city'] == 'Vaughan' ? 'selected':''?>>Vaughan</option>					
						<option value="Whitby" <?=$this->condo['city'] == 'Whitby' ? 'selected':''?>>Whitby</option>
					</select>
				</div>
				<div class="pure-control-group">
					<label for="postal_zip">Postal/Zip Code</label>				
					<input id="postal_zip" name="postal_zip" type="text" maxlength="6" placeholder="Postal/Zip" class="pure-input-1-4" style="width:80px;" value="<?=$this->condo['postal_zip']?>">
				</div>
				<legend>General Information</legend>
				<div class="pure-control-group">
					<label for="condo_name"><span style="color:#B51313;">*</span> Condo Name</label>
					<input id="condo_name" name="condo_name" type="text" placeholder="Condo Name" value="<?=$this->condo['condo_name']?>">
				</div>		
				<div class="pure-control-group">
					<label for="builder"><span style="color:#B51313;">*</span> Builder</label>
					<input id="builder" name="builder" type="text" placeholder="Builder" value="<?=$this->condo['builder']?>">
					<span style="font-size:0.75em;">Website (Optional)</span>
					<input id="website" name="website" type="text" placeholder="Website URL" value="<?=$this->condo['website']?>">
				</div>								
				<div class="pure-control-group">
					<label for="price"><span style="color:#B51313;">*</span> Price</label>
					<input id="price" name="price" type="text" placeholder="Price" value="<?=$this->condo['price']?>">
				</div>			
				<div class="pure-control-group">
					<label for="pre_construction">Pre-construction</label>
					<select id="pre_construction" name="pre_construction">
						<option value></option>
						<option value="Yes" <?=$this->condo['pre_construction'] == 'Yes' ? 'selected':''?>>Yes</option>
						<option value="No" <?=$this->condo['pre_construction'] == 'No' ? 'selected':''?>>No</option>
					</select>
				</div>
				<div class="pure-control-group">
					<label for="closing_date">Closing Date</label>
					<input id="closing_date" name="closing_date" type="text" placeholder="yyyy-mm-dd" value="<?=isset($this->condo['closing_date']) ? $this->condo['closing_date']:'' ?>">
				</div>
				<div class="pure-control-group">
					<label for="number_of_buildings">Number of Buildings</label>
					<input id="number_of_buildings" name="number_of_buildings" type="text" placeholder="" style="width:80px;" value="<?=$this->condo['number_of_buildings']?>">
				</div>			
				<div class="pure-control-group">
					<label for="number_of_units">Number of Units</label>
					<input id="number_of_units" name="number_of_units" type="text" placeholder="" style="width:80px;" value="<?=$this->condo['number_of_units']?>">
				</div>			
				<div class="pure-control-group">
					<label for="number_of_storeys">Number of Storeys</label>
					<input id="number_of_storeys" name="number_of_storeys" type="text" placeholder="" style="width:80px;" value="<?=$this->condo['number_of_storeys']?>">
				</div>					
				<div class="pure-control-group">
					<label for="ceiling_height">Ceiling Height</label>
					<input id="ceiling_height_from" name="ceiling_height_from" type="text" placeholder="" style="width:80px;" value="<?=$this->condo['ceiling_height_from']?>"> - <input id="ceiling_height_to" name="ceiling_height_to" type="text" placeholder="" style="width:80px;" value="<?=$this->condo['ceiling_height_to']?>">
					<select id="ceiling_unit" name="ceiling_unit">					
						<option value="feet" <?=$this->condo['ceiling_unit'] == 'feet' ? 'selected':''?>>feet</option>
						<option value="inches" <?=$this->condo['ceiling_unit'] == 'inches' ? 'selected':''?>>inches</option>
						<option value="meters" <?=$this->condo['ceiling_unit'] == 'meters' ? 'selected':''?>>meters</option>
					</select>				
				</div>		
				<div class="pure-control-group">
					<label for="maintenance_fee">Maintenance Fee</label>
					<input id="maintenance_fee" name="maintenance_fee" type="text" placeholder="Maintenance Fee" value="<?=$this->condo['maintenance_fee']?>">
				</div>					
				<div class="pure-control-group">
					<label for="electrical_includes">Electrical Includes</label>
					<input id="electrical_includes" name="electrical_includes" type="text" placeholder="Electrical Includes" value="<?=$this->condo['electrical_includes']?>">
				</div>
				<div class="pure-control-group">
					<label for="created_date">Created Date</label>
					<input id="created_date" class="datepicker" name="created_date" type="text" placeholder="yyyy-mm-dd" value="<?=isset($this->condo['created_date']) ? $this->condo['created_date']:'' ?>"><span style="font-size:0.7em;margin-left:5px;">(Order of display. Clear to hide from page)</span>
				</div>				
				<legend>Ammenities</legend>		
				<div class="pure-control-group">	
					<?php 
						$arr = explode(";", $this->condo['ammenities']);
					?>
					<div style="margin-bottom:8px;">
						<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">1</label><input name="ammenities[]" type="text" placeholder="" value="<?=isset($arr[0]) ? $arr[0]:''?>">
						<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">2</label><input name="ammenities[]" type="text" placeholder="" value="<?=isset($arr[1]) ? $arr[1]:''?>">
						<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">3</label><input name="ammenities[]" type="text" placeholder="" value="<?=isset($arr[2]) ? $arr[2]:''?>">
						<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">4</label><input name="ammenities[]" type="text" placeholder="" value="<?=isset($arr[3]) ? $arr[3]:''?>">
					</div>
					<div style="margin-bottom:8px;">
						<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">5</label><input name="ammenities[]" type="text" placeholder="" value="<?=isset($arr[4]) ? $arr[4]:''?>">
						<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">6</label><input name="ammenities[]" type="text" placeholder="" value="<?=isset($arr[5]) ? $arr[5]:''?>">
						<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">7</label><input name="ammenities[]" type="text" placeholder="" value="<?=isset($arr[6]) ? $arr[6]:''?>">
						<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">8</label><input name="ammenities[]" type="text" placeholder="" value="<?=isset($arr[7]) ? $arr[7]:''?>">
					</div>
					<div style="margin-bottom:8px;">
						<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">9</label><input name="ammenities[]" type="text" placeholder="" value="<?=isset($arr[8]) ? $arr[8]:''?>">
						<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">10</label><input name="ammenities[]" type="text" placeholder="" value="<?=isset($arr[9]) ? $arr[9]:''?>">
						<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">11</label><input name="ammenities[]" type="text" placeholder="" value="<?=isset($arr[10]) ? $arr[10]:''?>">
						<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">12</label><input name="ammenities[]" type="text" placeholder="" value="<?=isset($arr[11]) ? $arr[11]:''?>">
					</div>
					<div style="margin-bottom:8px;">
						<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">13</label><input name="ammenities[]" type="text" placeholder="" value="<?=isset($arr[12]) ? $arr[12]:''?>">
						<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">14</label><input name="ammenities[]" type="text" placeholder="" value="<?=isset($arr[13]) ? $arr[13]:''?>">
						<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">15</label><input name="ammenities[]" type="text" placeholder="" value="<?=isset($arr[14]) ? $arr[14]:''?>">
						<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">16</label><input name="ammenities[]" type="text" placeholder="" value="<?=isset($arr[15]) ? $arr[15]:''?>">
					</div>
				</div>			
				<legend>Other Ammenities</legend>
				<div class="pure-control-group">
					<textarea rows="6" cols="60" name="other_ammenities" id="other_ammenities"><?=$this->condo['other_ammenities']?></textarea> 
				</div>			
				<legend>Condo Description</legend>
				<div class="pure-control-group">				
					<textarea rows="14" cols="80" name="description" id="description"><?=$this->condo['description']?></textarea> 
				</div>			
				<div class="pure-controls" style="text-align:left;padding:40px 0;margin:0;height:30px;width:160px;text-align:center;">
					<button type="submit" class="pure-button pure-button-small pure-button-primary" id="btnSave">Save</button>&nbsp;<button type="submit" class="pure-button pure-button-small pure-button-primary" id="btnSave">Delete</button>
				</div>
			</fieldset>
		</form>
	</div>
	<div id="gallery">
<style>
#files_table, #floor_plan_table{
	border:0;
}
/*#files_table{
	border-collapse:separate;
	border-spacing:0;
	color:#222;
	font-size:0.8em;
}
#files_table tr td{
	padding:5px;
}*/
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
				<input id="youtube_url" name="youtube_url" type="text" style="width:400px;" placeholder="Youtube URL" value="<?=$this->condo['youtube']?>">
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
					
					if (parse_yturl($this->condo['youtube'])){
				?>								
				
					<label for="youtube" style="margin-bottom:20px;">Preview</label>
					<iframe width="709" height="399" src="//www.youtube.com/embed/<?=parse_yturl($this->condo['youtube'])?>?wmode=opaque" frameborder="0" allowfullscreen></iframe>	
					<button type="button" class="pure-button pure-button-xsmall pure-button-delete btnDeleteYoutube" style="right:0;top:36px;padding:5px 13px;font-size:1.3em;font-weight:bold;background: rgba(66, 184, 221, 0.8);z-index:1;">x</button>
				
				<?php } ?>
				</div>
			</div>						
			<div class="pure-controls" style="text-align:left;padding:40px 0;margin:0;height:30px;width:73px;text-align:center;">			
				<button type="submit" class="pure-button pure-button-small pure-button-primary" id="btnSaveYoutube">Save</button>
			</div>
		</form>	
	</div>
	<div id="cover_image">
		<form class="pure-form pure-form-stacked" id="cover_image_form" style="margin-top:30px;">
			<legend>File Upload</legend>
			<div style="height:70px;">				
				<div class="fileUpload pure-button pure-button-xsmall pure-button-secondary" style="float:left;margin:5px;">
					<span>+ Add file...</span>
					<input type="file" class="upload" id="uploadCoverImage" accept="image/*" />
				</div>	
			</div>	
			<div style="max-height:324px;">
				<table id="cover_image_table" class="pure-table pure-table-horizontal"></table>				
			</div>
		</form>
		<form class="pure-form pure-form-stacked" style="margin-top:30px;">
			<legend>Cover Image</legend>
			<div class="pure-g-r" id="cover_image_container" data-dom-cache="false" style="display:table-cell;">
				<?php if ($this->cover_image){?>				
					<img id="<?=$this->cover_image['fid'] ?>" src="<?=URL?>views/admin/server/files/thumbnail/<?=$this->cover_image['filename'] ?>" />									
				<?php } ?>
			</div>
			<div class="pure-controls btnContainer" style="text-align:left;padding:40px 0;margin:0;height:30px;width:73px;text-align:center;">			
				<?php if ($this->cover_image){?>				
				<button type="submit" class="pure-button pure-button-small pure-button-primary" id="btnDeleteCoverImage">Delete</button>
				<?php } ?>
			</div>
		</form>
	</div>	
	<div id="floor_plan">
		<form class="pure-form pure-form-stacked" id="floor_plan_upload_form" style="margin-top:30px;">
			<legend>File Upload</legend>
			<div style="height:70px;">				
				<div class="fileUpload pure-button pure-button-xsmall pure-button-secondary" style="float:left;margin:5px;">
					<span>+ Add files...</span>
					<input type="file" class="upload" id="uploadFloorPlan" />
				</div>	
				<div class="pure-button pure-button-xsmall pure-button-secondary btnStartUpload" style="float:left;margin:5px;">                    
				   <span>Start upload</span>
				</div>
				<div class="pure-button pure-button-xsmall pure-button-secondary btnClearQueue" style="float:left;margin:5px;">
				   <span>Clear Queue</span>
				</div>			
			</div>
			<div style="max-height:64px;">
				<table id="floor_plan_table" class="pure-table pure-table-horizontal"></table>				
			</div>			
		</form>	
		<form class="pure-form pure-form-stacked" id="floor_plan_form" style="margin-top:30px;">
			<legend>Floor Plan <span id="photo_count" style="font-size:0.5em;">(Maximum 4 files. Order by filename.)</span></legend>
			<div class="pure-g-r" id="floor_plan_container" data-dom-cache="false">
				<?php 
					function formatSizeUnits($bytes)
					{
						if ($bytes >= 1073741824)
						{
							$bytes = number_format($bytes / 1073741824, 2) . ' GB';
						}
						elseif ($bytes >= 1048576)
						{
							$bytes = number_format($bytes / 1048576, 2) . ' MB';
						}
						elseif ($bytes >= 1024)
						{
							$bytes = number_format($bytes / 1024, 2) . ' KB';
						}
						elseif ($bytes > 1)
						{
							$bytes = $bytes . ' bytes';
						}
						elseif ($bytes == 1)
						{
							$bytes = $bytes . ' byte';
						}
						else
						{
							$bytes = '0 bytes';
						}

						return $bytes;
					}				
					
					for ($i=0; $i < count($this->floor_plan); $i++){ 
				?>
				<div class="pure-u-1-2" id="<?=$this->floor_plan[$i]['fid'] ?>" style="padding:20px 0;border-bottom:1px solid #DFDFDF;display:block;font-size:0.8em;">
					<span><?=$this->floor_plan[$i]['filename'] ?></span>					
					<button type="button" class="pure-button pure-button-xsmall btnDeleteFloorPlan" style="float:right;padding:3px 7px;"><i class="icon-remove"></i></button>					
					<span style="float:right;margin-right:10px;"><?=formatSizeUnits($this->floor_plan[$i]['size']) ?></span>					
				</div>	
				<?php } ?>
			</div>
		</form>				
	</div>		
</div>
<?php }else{ ?>
<form class="pure-form pure-form-aligned" id="condo_form">
	<fieldset>
		<legend>Address & Location</legend>
		<div class="pure-control-group">
			<label for="address"><span style="color:#B51313;">*</span> Address</label>
			<input id="address" name="address" type="text" placeholder="Address" class="pure-input-1-3">
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
		<legend>General Information</legend>
		<div class="pure-control-group">
			<label for="condo_name"><span style="color:#B51313;">*</span> Condo Name</label>
			<input id="condo_name" name="condo_name" type="text" placeholder="Condo Name">
		</div>		
		<div class="pure-control-group">
			<label for="builder"><span style="color:#B51313;">*</span> Builder</label>
			<input id="builder" name="builder" type="text" placeholder="Builder">
			<span style="font-size:0.75em;">Website (Optional)</span>
			<input id="website" name="website" type="text" placeholder="Website URL">
		</div>								
		<div class="pure-control-group">
			<label for="price"><span style="color:#B51313;">*</span> Price</label>
			<input id="price" name="price" type="text" placeholder="Price">
		</div>			
		<div class="pure-control-group">
			<label for="pre_construction">Pre-construction</label>
			<select id="pre_construction" name="pre_construction">
				<option value></option>
				<option value="Yes">Yes</option>
				<option value="No">No</option>
			</select>
		</div>
		<div class="pure-control-group">
			<label for="closing_date">Closing Date</label>
			<input id="closing_date" class="datepicker" name="closing_date" type="text" placeholder="yyyy-mm-dd">
		</div>
		<div class="pure-control-group">
			<label for="number_of_buildings">Number of Buildings</label>
			<input id="number_of_buildings" name="number_of_buildings" type="text" placeholder="" style="width:80px;">
		</div>			
		<div class="pure-control-group">
			<label for="number_of_units">Number of Units</label>
			<input id="number_of_units" name="number_of_units" type="text" placeholder="" style="width:80px;">
		</div>			
		<div class="pure-control-group">
			<label for="number_of_storeys">Number of Storeys</label>
			<input id="number_of_storeys" name="number_of_storeys" type="text" placeholder="" style="width:80px;">
		</div>					
		<div class="pure-control-group">
			<label for="ceiling_height">Ceiling Height</label>
			<input id="ceiling_height_from" name="ceiling_height_from" type="text" placeholder="" style="width:80px;"> - <input id="ceiling_height_to" name="ceiling_height_to" type="text" placeholder="" style="width:80px;">
			<select id="ceiling_unit" name="ceiling_unit">					
				<option value="feet">feet</option>
				<option value="inches">inches</option>
				<option value="meters">meters</option>
			</select>				
		</div>		
		<div class="pure-control-group">
			<label for="maintenance_fee">Maintenance Fee</label>
			<input id="maintenance_fee" name="maintenance_fee" type="text" placeholder="Maintenance Fee">
		</div>					
		<div class="pure-control-group">
			<label for="electrical_includes">Electrical Includes</label>
			<input id="electrical_includes" name="electrical_includes" type="text" placeholder="Electrical Includes">
		</div>		
		<legend>Ammenities</legend>		
		<div class="pure-control-group">			
			<div style="margin-bottom:8px;">
				<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">1</label><input name="ammenities[]" type="text" placeholder="">
				<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">2</label><input name="ammenities[]" type="text" placeholder="">
				<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">3</label><input name="ammenities[]" type="text" placeholder="">
				<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">4</label><input name="ammenities[]" type="text" placeholder="">
			</div>
			<div style="margin-bottom:8px;">
				<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">5</label><input name="ammenities[]" type="text" placeholder="">
				<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">6</label><input name="ammenities[]" type="text" placeholder="">
				<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">7</label><input name="ammenities[]" type="text" placeholder="">
				<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">8</label><input name="ammenities[]" type="text" placeholder="">
			</div>
			<div style="margin-bottom:8px;">
				<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">9</label><input name="ammenities[]" type="text" placeholder="">
				<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">10</label><input name="ammenities[]" type="text" placeholder="">
				<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">11</label><input name="ammenities[]" type="text" placeholder="">
				<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">12</label><input name="ammenities[]" type="text" placeholder="">
			</div>
			<div style="margin-bottom:8px;">
				<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">13</label><input name="ammenities[]" type="text" placeholder="">
				<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">14</label><input name="ammenities[]" type="text" placeholder="">
				<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">15</label><input name="ammenities[]" type="text" placeholder="">
				<label for="ammenities" style="font-size:0.8em;width:15px;margin-right:3px;">16</label><input name="ammenities[]" type="text" placeholder="">
			</div>
		</div>			
		<legend>Other Ammenities</legend>
		<div class="pure-control-group">
			<textarea rows="6" cols="60" name="other_ammenities" id="other_ammenities"></textarea> 
		</div>			
		<legend>Condo Description</legend>
		<div class="pure-control-group">				
			<textarea rows="14" cols="80" name="description" id="description"></textarea> 
		</div>			
		<section>
			<div class="pure-controls white_bar" style="text-align:left;padding:40px 0;margin:0;height:30px;width:145px;text-align:center;">							
				<button type="submit" class="pure-button pure-button-small pure-button-primary" id="btnAdd">Add</button>&nbsp;<button type="submit" class="pure-button pure-button-small pure-button-primary">Clear</button>
			</div>
		</section>
	</fieldset>
</form>	
<?php } ?>



	