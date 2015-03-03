<header class="title_header">
	<div class="title_container">
		<span class="title_1">New Condos</span>	
	</div>
</header>
<div style="min-height:500px;">
	<div class="new_condos_container clearfix">
		<?php for ($i = 0; $i < count($this->records); $i++){ ?>
		<div class="content">
			<a href="./condos/detail/<?=$this->records[$i]['cid']?>">
				<div class="img_wrapper">
					<?php if ($this->records[$i]['filename']){ ?>					
					<img src="<?=URL?>photo/<?=$this->records[$i]['filename']?>" />					
					<?php  }else{ ?>
						<div style="font-size:60px;color:#C9C9C9;line-height:0;">
							<i class="icon-picture"></i>
						</div>					
					<?php  } ?>
				</div>
			</a>
			<dl>
				<dt><?=$this->records[$i]['condo_name']?></dt>
				<dd><?=$this->records[$i]['builder']?></dd>
				<dd>Price: <?=$this->records[$i]['price']?></dd>
			</dl>
		</div>	
		<?php } ?>
	</div>
</div>

<?php include('views/contact_info.php'); ?>