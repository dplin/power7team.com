<?php include('nav/admin_nav.php'); ?>
<div style="clear:both;margin-left:30px;width:930px;padding-top:30px;">
	<?php if (isset($this->newListing)) { include('forms/listing_form.php'); }else{ ?>
	<div style="height:50px;">
		<select data-placeholder="Choose your listing..." style="width:350px;" tabindex="1" id="current_listings">			
			<option value></option>									
			<optgroup label="Active Listings">							
				<?php for ($i = 0; $i < count($this->activeListings); $i++){ ?>
				<option value="<?=$this->activeListings[$i]['lid'] ?>"><?=$this->activeListings[$i]['address'] ?></option>
				<?php } ?>
			</optgroup>
			<optgroup label="Archived">
				<?php for ($i = 0; $i < count($this->archivedListings); $i++){ ?>
				<option value="<?=$this->archivedListings[$i]['lid'] ?>"><?=$this->archivedListings[$i]['address'] ?></option>
				<?php } ?>
			</optgroup>
		</select>
	</div>
	<header class="header_form">
		<div style="min-height:450px;padding-top:30px;" data-lid="<?=isset($this->listing) ? $this->listing['lid']:'0';?>" id="listing_container" spellcheck='false'>
			<?php if (isset($this->listing)){ include('forms/listing_form.php');}?>		
		</div>
	</header>
	<?php } ?>
</div>