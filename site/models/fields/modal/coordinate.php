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

JHTML::_('stylesheet', 'style.css', 'administrator/components/com_xcal/add/css/');
JHTML::script('http://maps.google.com/maps/api/js?sensor=false');
JHTML::script('main.js', 'components/com_xcal/add/js/');

class JFormFieldModal_coordinate extends JFormField
{
	protected $type='modal_coordinate';
	
	protected function getInput()
	{	
	
		if($_GET['id']){
			$db	= JFactory::getDBO();
			$db->setQuery(
				'SELECT a.coordinate' .
				' FROM #__xcal_events AS a' .
				' WHERE a.id = '.(int) $_GET['id']
			);
			$def= $db->loadResult();
		}
		
		if ($def=='')$def="41.89017636745147, 12.492124290460197";
	
		$html= '
			<div class="clr"></div>
			<div id="map_canvas" style="width:100%; height:300px"></div><br/>
			<label>Coordinate: </label><input name="'.$this->name.'" id="'.$this->id.'" type="text" size="41" value="'.$def.'"/>
		';

		return $html;
	}
}