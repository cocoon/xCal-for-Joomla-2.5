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

class JFormFieldModal_cat extends JFormField
{
	protected $type='modal_cat';
	
	protected function getInput()
	{
		
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		$query->select('a.title, a.id')
			->from('`#__xcal_category` AS a');
		$db->setQuery($query);
		$cat = $db->loadObjectList();
	
		$html= '
			<select id="'.$this->id.'_id"'.$class.' name="'.$this->name.'">';
		if ($this->name!='jform[catid]' && $this->name!='catid') $html.='<option value="0">'.JTEXT::_('COM_XCAL_ALL').'</option>';
		foreach ($cat as $c){
			$html.='<option value="'.$c->id.'"';
			if ($this->value == $c->id){
				$html.='selected="selected"';
			}
			$html.='>'.$c->title.'</option>';
		}
		$html.='</select>';
			
		return $html;
	}
}