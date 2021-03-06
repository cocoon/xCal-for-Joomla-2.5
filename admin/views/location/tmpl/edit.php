<?php
/**
 * @version     2.0.5
 * @package     com_xcal
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */

// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

JHTML::script('jquery.min.js', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/');
JHTML::script('jquery-ui.min.js', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/');
JHTML::_('stylesheet', 'style.css', 'administrator/components/com_xcal/add/css/');
JHTML::_('stylesheet', 'jquery-ui-1.8.17.custom.css', 'administrator/components/com_xcal/add/css/');
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'event.cancel' || document.formvalidator.isValid(document.id('event-form'))) {
			Joomla.submitform(task, document.getElementById('event-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_xcal&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="event-form" class="form-validate" enctype="multipart/form-data">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo JText::_('COM_XCAL_LEGEND_GENERAL'); ?></legend>
			<ul class="adminformlist">

            
			<li><?php echo $this->form->getLabel('id'); ?>
			<?php echo $this->form->getInput('id'); ?></li>

            
			<li><?php echo $this->form->getLabel('name'); ?>
			<?php echo $this->form->getInput('name'); ?></li>
			
			<li><?php echo $this->form->getLabel('state'); ?>
			<?php echo $this->form->getInput('state'); ?></li><li><?php echo $this->form->getLabel('checked_out'); ?>
			<?php echo $this->form->getInput('checked_out'); ?></li><li><?php echo $this->form->getLabel('checked_out_time'); ?>
			<?php echo $this->form->getInput('checked_out_time'); ?></li>

			</ul>
		</fieldset>
	</div>
	
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo JText::_('COM_XCAL_LEGEND_GEO'); ?></legend>
			<ul class="adminformlist">

			<li><?php echo $this->form->getLabel('city'); ?>
			<?php echo $this->form->getInput('city'); ?></li>
            
			<li><?php echo $this->form->getLabel('address'); ?>
			<?php echo $this->form->getInput('address'); ?></li>
			
			<li><?php echo $this->form->getInput('coordinate'); ?></li>
			
			</ul>
		</fieldset>
	</div>
	
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo JText::_('COM_XCAL_LEGEND_DESC'); ?></legend>
			<ul class="adminformlist">

            
			<li><?php echo $this->form->getLabel('desc'); ?><div style="clear:both"></div>
			<?php echo $this->form->getInput('desc'); ?></li>
			
			</ul>
		</fieldset>
	</div>


	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
	<div class="clr"></div>
</form>