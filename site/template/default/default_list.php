<div id="xcal">
	<?php  	if($stamp->container->navigator): ?>
		<?php echo $stamp->container->navigator; ?>
	<div class="clr"></div>
	<?php endif ?>
	
	<div class="items">
	<?php 
  
  if ($stamp->data->items)
  {
    $stampitems = $stamp->data->items;
  }
  else
  {
    $stampitems = $stamp->items;
  } 
  
  if($stampitems){
  
    foreach ($stampitems as $item){ ?>
  
  			<div class="event">
  
  				<?php if ($item->next): ?>
  					<div class="box_date" style="background:<?php echo $item->cat_color; ?>">
  							<?php echo $item->day.'<br/>'.$item->monthShort; ?>
  					</div>
  				<?php endif; ?>
  				
  				<div class="xcalcontent">
  				
  					<div>
  						<h2>
  							<a href="<?php echo $item->url; ?>" alt="<?php echo $item->title; ?>"><?php echo $item->title; ?></a> [<?php echo $item->cat_title; ?>]
  						</h2>
  						<div><?php if ($item->share) echo $item->share; ?></div>
  						<?php echo $item->descShort; ?>
  						<div class="clr"></div>
  					</div>
  					
  					<?php if ($item->gcalendar): ?>
  						<a class="gcal" href="<?php echo $item->gcalendarUrl; ?>" alt="aggiungi a google calendar">Google Calendar</a>
  					<?php endif; ?>	
  					
  				</div>
  				
  				<div class="clr"></div>
  
  			</div>
        
	<?php }
  } ?>
	</div>
	
</div>