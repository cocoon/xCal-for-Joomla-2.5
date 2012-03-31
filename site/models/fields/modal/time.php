<?php
/**
 * @version     1.0.1
 * @package     com_xwall
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */

// no direct access
defined('_JEXEC') or die;

jimport( 'joomla.filesystem.path' );
jimport('joomla.form.formfield');

JHTML::script('timepiker.js', 'components/com_xcal/add/js/');

class JFormFieldModal_time extends JFormField
{
	protected $type='modal_time';
	
	protected function getInput()
	{
		if($_GET['id']){
			$db	= JFactory::getDBO();
			$db->setQuery(
				'SELECT a.ora' .
				' FROM #__xcal_events AS a' .
				' WHERE a.id = '.(int) $_GET['id']
			);
			$time= $db->loadResult();
		}

		$html ='<script>
		$(function(){
			$(\'#'.$this->id.'\').timepicker({
				hourGrid: 4,
				minuteGrid: 10
			});
		})

		</script>
		<input tipe="text" id="'.$this->id.'" class="'.$this->class.'" name="'.$this->name.'" value="'.$time.'"/>';
			
		return $html;
	}
}