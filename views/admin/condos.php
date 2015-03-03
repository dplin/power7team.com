<?php include('nav/admin_nav.php'); ?>
<div style="clear:both;margin-left:30px;width:930px;padding-top:30px;">
	<?php if (isset($this->newCondo)) { include('forms/condo_form.php'); }else{ ?>
	<div style="height:50px;">
		<select data-placeholder="Choose your condo..." style="width:350px;" tabindex="1" id="current_listings">			
			<option value></option>			
			<?php for ($i = 0; $i < count($this->condos); $i++){ ?>
			<option value="<?=$this->condos[$i]['cid'] ?>"><?='['.$this->condos[$i]['created_date'].'] '.$this->condos[$i]['condo_name'] ?></option>
			<?php } ?>					
		</select>
	</div>
	<header class="header_form">
		<div style="min-height:600px;padding-top:30px;" data-cid="<?=isset($this->condo) ? $this->condo['cid']:'0';?>" id="condo_container" spellcheck='false'>
		<?php if (isset($this->condo)){ include('forms/condo_form.php');}?>		
		</div>
	</header>
	<?php } ?>
</div>