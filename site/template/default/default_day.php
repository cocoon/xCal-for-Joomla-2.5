<?php if ($stamp->events) {?>
	<div class="event" style="background:<?php echo $stamp->events[0]['cat_color']; ?>">
		<a href="#"><?php echo $stamp->day; ?></a>
		<span class="spanEv">
			<?php 
			foreach($stamp->events as $e){
				echo '<span style="border-left:5px solid '.$e['cat_color'].'; padding-left:5px;" class="img"><img src="'.$e['image'].'"/></span>';
				echo '<span><h3><a href="'.$e['url'].'">'.$e['title'].'</a></h3>'.$e['location'].'</span><span class="clr"></span>';
			}
			?>
		</span>
		<span class="date"><?php echo $stamp->dateFormat; ?></span>
	</div>
<?php }else{ ?>
	<div>
		<?php echo $stamp->day; ?>
	</div>
<?php } ?>