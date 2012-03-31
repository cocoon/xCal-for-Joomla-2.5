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

<form action="<?php echo JRoute::_('index.php?option=com_xcal&view=mail&layout=edit') ?>" method="post" name="adminForm" id="event-form" class="form-validate" enctype="multipart/form-data">
	<div class="width-100">
		<fieldset class="adminform">
			<legend><?php echo JText::_('COM_XCAL_LEGEND_GENERAL'); ?></legend>
			<ul class="adminformlist">

            
			<li><?php echo $this->form->getLabel('list'); ?>
			<?php echo $this->form->getInput('list'); ?></li>

			
			<li><?php echo $this->form->getLabel('obj'); ?>
			<?php echo $this->form->getInput('obj'); ?></li>

            
			<li><?php echo $this->form->getLabel('body'); ?><div class="clr"></div>
			<?php echo $this->form->getInput('body'); ?></li>

			
			</ul>
		</fieldset>
	</div>

	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
	<div class="clr"></div>
</form>