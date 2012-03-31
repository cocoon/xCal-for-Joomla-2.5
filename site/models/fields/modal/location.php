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

JHTML::_('stylesheet', 'style.css', 'components/com_xcal/add/css/');
JHTML::script('http://maps.google.com/maps/api/js?sensor=false');
JHTML::script('main.js', 'components/com_xcal/add/js/');

class JFormFieldModal_location extends JFormField
{
	protected $type='modal_location';
	
	protected function getInput()
	{
		
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		$query->select('a.name, a.id, a.coordinate')
			->from('`#__xcal_location` AS a');
		$db->setQuery($query);
		$loc = $db->loadObjectList();
	
		$html= '
			<select id="'.$this->id.'_id"'.$class.' name="'.$this->name.'">';
		foreach ($loc as $l){
			$html.='<option value="'.$l->id.'"';
			if ($this->value == $l->id){
				$html.='selected="selected"';
			}
			$html.='>'.$l->name.'</option>';
			$span.='<span id="coord'.$l->id.'" style="display:none;">'.$l->coordinate.'</span>';
		}
		$html.='</select>'.$span;
		$html.='<div class="clr"></div><div style="background:#e5e3df; width:300px; height:300px"><div id="map_canvas" style="width:300px; height:300px"></div></div>';
			
		return $html;
	}
}