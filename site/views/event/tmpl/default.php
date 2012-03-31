<?php

// impedisco l'accesso diretto

defined('_JEXEC') or die('Restricted access');

JHTML::script('jquery.min.js', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/');
JHTML::script('jquery-ui.min.js', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/');
JHTML::_('stylesheet', 'style.css', 'components/com_xcal/add/css/');
JHTML::_('stylesheet', 'jquery-ui-1.8.17.custom.css', 'components/com_xcal/add/css/');
?>
<div id="xcal">
	<form name="registration" class="xcal_form" method="post" enctype="multipart/form-data">

		<legend><?php echo JText::_('COM_XCAL_LEGEND_GENERAL'); ?></legend>
		<div class="fieldset">
			<fieldset class="adminform">
				<ul class="adminformlist">

				<li><?php echo $this->form->getLabel('id'); ?>
				<?php echo $this->form->getInput('id'); ?></li>

				<li><?php echo $this->form->getLabel('username'); ?>
				<?php echo $this->form->getInput('username'); ?></li>

	            
				<li><?php echo $this->form->getLabel('email'); ?>
				<?php echo $this->form->getInput('email'); ?></li>

				<li><?php echo $this->form->getLabel('title'); ?>
				<?php echo $this->form->getInput('title'); ?></li>

				<li><?php echo $this->form->getLabel('catid'); ?>
				<?php echo $this->form->getInput('catid'); ?></li>

				<li><?php echo $this->form->getLabel('state'); ?>
				<?php echo $this->form->getInput('state'); ?></li><li><?php echo $this->form->getLabel('checked_out'); ?>
				<?php echo $this->form->getInput('checked_out'); ?></li><li><?php echo $this->form->getLabel('checked_out_time'); ?>
				<?php echo $this->form->getInput('checked_out_time'); ?></li>
				
				</ul>
			</fieldset>
		</div>

		<legend><?php echo JText::_('COM_XCAL_LEGEND_ALLEG'); ?></legend>
		<div class="fieldset">
			<fieldset class="adminform">
				<ul class="adminformlist">

		            
					<li><?php echo $this->form->getLabel('image'); ?>
					<?php echo $this->form->getInput('image'); ?>
					<?php 
						if ($this->form->getValue('image')){
							echo '<div class="clr"></div><div class="locandina"><img src="../'.$this->form->getValue('image').'" /></div><div class="clr"></div>';
						}
					?>
					</li>

		            
					<li><?php echo $this->form->getLabel('file'); ?>
					<?php echo $this->form->getInput('file'); ?></li>
				
				</ul>
			</fieldset>
		</div>

		<legend><?php echo JText::_('COM_XCAL_LEGEND_TIME'); ?></legend>
		<div class="fieldset">
			<fieldset class="adminform">
				<ul class="adminformlist">
				
				<li><?php echo $this->form->getLabel('dates'); ?>
				<?php echo $this->form->getInput('dates'); ?></li>
	            
				<li><?php echo $this->form->getLabel('next'); ?>
				<?php echo $this->form->getInput('next'); ?></li>

	            
				<li><?php echo $this->form->getLabel('time'); ?>
				<?php echo $this->form->getInput('time'); ?></li>
				
				</ul>
			</fieldset>
		</div>
		
		<legend><?php echo JText::_('COM_XCAL_LEGEND_GEO'); ?></legend>
		<div class="fieldset">
			<fieldset class="adminform">
				<ul class="adminformlist">
	            
				<li><?php echo $this->form->getLabel('location'); ?>
				<?php echo $this->form->getInput('location'); ?></li>
	            
				<li><?php echo $this->form->getLabel('address'); ?>
				<?php echo $this->form->getInput('address'); ?></li>
				
				<li><?php echo $this->form->getInput('coordinate'); ?></li>

	            
				<li><?php echo $this->form->getLabel('comune'); ?>
				<?php echo $this->form->getInput('comune'); ?></li>
				
				</ul>
			</fieldset>
		</div>
		
		<legend><?php echo JText::_('COM_XCAL_LEGEND_DESC'); ?></legend>
		<div class="fieldset">
			<fieldset class="adminform">
				<ul class="adminformlist">

	            
				<li><?php echo $this->form->getLabel('desc'); ?><div style="clear:both"></div>
				<?php echo $this->form->getInput('desc'); ?></li>
				
				</ul>
			</fieldset>
		</div>

		<input type="submit" value="<?php echo JText::_( 'XCAL_REGISTRATION_FORM_SUBMIT' ); ?>" class="button" name="Submit"/>
	</form>
</div>
