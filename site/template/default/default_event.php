<div id="xcal">	<h2><?php echo $item->title; ?></h2>	<?php echo $item->share; ?><?php echo $item->reg.' <span class="xRegitered" >'.$item->registered.'</span>'; ?><br/>	<div class="info">		<?php echo $item->imageTag; ?>		<div class="details">			<label><?php echo JText::_('COM_XCAL_GENERAL_CATEGORY');?>: </label><?php echo $item->cat_title; ?><br/>			<label><?php echo JText::_('COM_XCAL_GENERAL_DATE');?>: </label><?php echo $item->next; ?><br/>			<label><?php echo JText::_('COM_XCAL_GENERAL_LOCATION');?>: </label><?php echo $item->location_name.',<br/>'.$item->address;?>			<?php if($item->file){ echo "<br/><label>".JText::_('COM_XCAL_GENERAL_FILE').": </label>".$item->fileTag;} ?>		</div>		</div>	<?php echo $item->desc; ?>	<?php echo $item->map; ?>		<div class="datesList">		<h3><?php echo JText::_('COM_XCAL_GENERAL_ADDITIONAL_DATES'); ?></h3>		<?php echo $item->datelistUl; ?>	</div></div>