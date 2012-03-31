<div id="xcal">	<h2><?php echo $stamp->title; ?></h2>	<?php echo $stamp->share; ?><?php echo $stamp->reg; ?><br/>
	<div class="info">		<?php echo $stamp->image; ?>
		<div class="details">
			<label>Categoria: </label><?php echo $stamp->cat_title; ?><br/>
			<label>Data: </label><?php echo $stamp->next; ?><br/>
			<label>Location: </label><?php echo $stamp->location; ?>			<?php if($stamp->file){ echo '<br/><label>File: </label>'.$stamp->file;} ?>
		</div>		</div>
	<?php echo $stamp->content; ?>
	<?php echo $stamp->map; ?>		<div class="datesList">		<h3>Altre Date:</h3>		<?php echo $stamp->datelistUl; ?>	</div></div>