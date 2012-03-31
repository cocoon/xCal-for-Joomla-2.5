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

JHTML::script('jquery.min.js', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/');
JHTML::script('farbtastic.js', 'components/com_xcal/add/js/');
JHTML::_('stylesheet', 'style.css', 'components/com_xcal/add/css/');

class JFormFieldModal_color extends JFormField
{
	protected $type='modal_color';
	
	protected function getInput()
	{
	
		if($_GET['id']){
			$db	= JFactory::getDBO();
			$db->setQuery(
				'SELECT a.color' .
				' FROM #__xcal_category AS a' .
				' WHERE a.id = '.(int) $_GET['id']
			);
			$def= $db->loadResult();
		}
		
		if ($def=='')$def="#123456";
		
	
		$html= '
		 
		<script type="text/javascript" charset="utf-8">
		  $(document).ready(function() {
			$("#picker").farbtastic("#jform_color");
		  });
		</script>
		<div class="color">
			<div class="form-item">
				<input type="text" id="'.$this->id.'" name="'.$this->name.'" value="'.$def.'" />
			</div>
			<div id="picker"></div>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>
		';

		return $html;
	}
}