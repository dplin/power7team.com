<header class="title_header">
	<div class="title_container">
		<span class="title_1">Our Listings</span>	
	</div>
</header>
<div style="min-height:300px;">
	<div style="padding:15px 0;margin-top:30px;" class="pagination">
		<button class="btn4 btnGoLeft"><i class="icon-long-arrow-left"></i></button>
		<?php 		
			echo $this->pagination;
		?>
		<button class="btn4 btnGoRight"><i class="icon-long-arrow-right"></i></button>
	</div>
	<div class="listing_container">
		<table class="listing_table">
			<thead>
				<tr>
					<td>Photo</td>
					<td>Address</td>
					<td>MLS&reg; Location</td>
					<td>Neighborhood</td>
					<td>Price</td>
					<td>Size (sq ft)</td>
					<td>Style</td>
					<td>Type</td>
				</tr>
			</thead>
			<tbody>
				<?php
					function convertUnit($size, $unit){
						if ($unit == "square meters"){
							$size = $unit * 10.7639;
						}
						return $size;					
					}
					for ($i = 0; $i < count($this->records); $i++){
				?>
				<tr id="<?=$this->records[$i]['lid']?>" data-url="<?=URL?>listings/detail/<?=$this->records[$i]['lid']?>">
					<td><?=isset($this->records[$i]['filename']) ? '<img src="'.URL.'thumb/'.$this->records[$i]['filename'].'" />':'<i style="font-size:3em;position:relative;top:4%;left:32%;" class="icon-picture"></i>'?></td>
					<td><?=$this->records[$i]['address']?></td>
					<td><?=$this->records[$i]['mls_location']?></td>
					<td><?=$this->records[$i]['neighborhood']?></td>
					<td><?=isset($this->records[$i]['price']) ? '$'.rtrim(rtrim(number_format($this->records[$i]['price'], 2),'0'), '.'):''?></td>
					<td><?=rtrim(rtrim(convertUnit($this->records[$i]['size'], $this->records[$i]['size_unit']),'0'),'.')?></td>
					<td><?=$this->records[$i]['style']?></td>
					<td><?=$this->records[$i]['development_type']?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<div style="padding:15px 0;" class="pagination">
		<button class="btn4 btnGoLeft"><i class="icon-long-arrow-left"></i></button>
		<?php 		
			echo $this->pagination;
		?>
		<button class="btn4 btnGoRight"><i class="icon-long-arrow-right"></i></button>
	</div>
</div>

<?php include('views/contact_info.php'); ?>
