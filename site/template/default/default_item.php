<div class="event">
		<div class="box_date" style="background:<?php echo $stamp->cat_color; ?>">
		</div>
		<div>
			<div><?php if ($stamp->share) echo $stamp->share; ?></div>
			<?php echo $stamp->contentShort; ?>
			<a class="gcal" href="<?php echo $stamp->gcalendarUrl; ?>" alt="aggiungi a google calendar">Google Calendar</a>
	<div class="clr"></div>
</div>