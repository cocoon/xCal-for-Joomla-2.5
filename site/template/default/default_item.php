<div class="event">	<?php if ($stamp->next): ?>
		<div class="box_date" style="background:<?php echo $stamp->cat_color; ?>">				<?php echo $stamp->day.'<br/>'.$stamp->monthShort; ?>
		</div>	<?php endif; ?>		<div class="content">	
		<div>			<h2>				<a href="<?php echo $stamp->url; ?>" alt="<?php echo $stamp->title; ?>"><?php echo $stamp->title; ?></a> [<?php echo $stamp->cat_title; ?>]			</h2>
			<div><?php if ($stamp->share) echo $stamp->share; ?></div>
			<?php echo $stamp->contentShort; ?>		</div>				<?php if ($stamp->gcalendar): ?>
			<a class="gcal" href="<?php echo $stamp->gcalendarUrl; ?>" alt="aggiungi a google calendar">Google Calendar</a>		<?php endif; ?>				</div>	
	<div class="clr"></div>
</div>