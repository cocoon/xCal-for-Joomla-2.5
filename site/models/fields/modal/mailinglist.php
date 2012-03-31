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

class JFormFieldModal_mailinglist extends JFormField
{
	protected $type='modal_mailinglist';
	
	protected function getInput()
	{
		
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		$query->select('e.*')->from('`#__xcal_events` AS e');
		$db->setQuery($query);
		$evs = $db->loadObjectList();
		
		
		
		$events=array();
		
		foreach ($evs as $e){
			$qr = $db->getQuery(true);
			$qr->select('r.email')->from('`#__xcal_registration` AS r')->where('r.eventid='.$e->id);
			$db->setQuery($qr);
			$r = $db->loadObjectList();
			$list='';
			foreach ($r as $v){
				$list.=$v->email.', ';
			}
			$events[$e->id]=array(
				'title'=>$e->title,
				'list'=>$list
			);
		}
	
		$html= '
			<select id="'.$this->id.'_id"'.$class.' name="'.$this->name.'">';
		foreach ($events as $k=>$v){
			$html.='<option value="'.$v['list'].'"';
			if ($this->value == $v['list']){
				$html.='selected="selected"';
			}
			$html.='>'.$v['title'].'</option>';
		}
		$html.='</select>';
			
		return $html;
	}
}