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

JHTML::script('dates.js', 'administrator/components/com_xcal/add/js/');

class JFormFieldModal_date extends JFormField
{
	protected $type='modal_date';
	
	protected function getInput()
	{
		if($_GET['id']){
			$db	= JFactory::getDBO();
			$db->setQuery(
				'SELECT a.dates' .
				' FROM #__xcal_events AS a' .
				' WHERE a.id = '.(int) $_GET['id']
			);
			$datesDB= $db->loadResult();
		}

		$dates=unserialize($datesDB);

		$html= '
			<table id="dTable">
				<thead><tr><th width="70%">'.JText::_('COM_XCAL_TB_DATE').'</th><th width="30%">'.JText::_('COM_XCAL_TB_ACT').'</th></tr></thead>
			';

		if($dates){
			foreach($dates as $dat){
				$html.='<tr><td><input class="data" type="text" name="d" value="'.$dat.'" /></td><td><a class="del" href="#">Delete</a></td></tr>';
			}
		}else{
			$html.='<tr><td><input class="data" type="text" name="d"/></td><td><a class="del" href="#">Delete</a></td></tr>';
		}
			
		$html.='</table>
			<a id="add" href="#">'.JText::_('COM_XCAL_ADD_DATE').'</a><br/>

			<input class="date" type="hidden" id="'.$this->id.'_id"'.$class.' name="'.$this->name.'" value=\''.$datesDB.'\' />
		';
			
		return $html;
	}
}