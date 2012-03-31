<div id="xcal">	
<?php if($stamp->container->navigator): ?>
	<?php echo $stamp->container->navigator; ?>
<div class="clr"></div>
<?php endif ?>
<div class="items">
	<?php foreach ($stamp->items as $item){  ?>

		<div class="event" style="border-left:3px solid <?php echo $item->cat_color ; ?>">	
			<div class="content">
				<div>
					<h2><a href="<?php echo $item->url; ?>" alt="<?php echo $item->title; ?>"><?php echo $item->title; ?></a>
						<span class="month"><?php echo $item->monthShort.'<br/>'.$item->Year; ?></span>
						<span class="day"><?php echo $item->day; ?></span>
						<span class="clr"></span>
					</h2>	
					<div class="image">	
						<?php echo $item->imageTag; ?>
					</div>
					<?php echo $item->descShort; ?>
				</div>				
				<?php if ($item->gcalendar): ?>			
				<a class="gcal" href="<?php echo $item->gcalendarUrl; ?>" alt="aggiungi a google calendar">Google Calendar</a>	
				<?php endif; ?>
			</div>
			<div class="clr"></div>
		</div>

	<?php } ?>
</div>	
</div>