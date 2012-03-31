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

class JFormFieldModal_Template extends JFormField
{
	protected $type='modal_template';
	
	protected function getInput()
	{
		$url=JPATH_SITE.DS.'components'.DS.'com_xcal'.DS.'template';
		$list=$this->getList($url);
		//echo '<pre>'.print_r($list, true).'</pre>';
		$html= '<select id="'.$this->id.'_id"'.$class.' name="'.$this->name.'">';
		foreach ($list as $l){
			$html.='<option value="'.$l.'"';
			if ($this->value == $c->id){
				$html.='selected="selected"';
			}
			$html.='>'.$l.'</option>';
		}
		$html.='</select>';

		return $html;
	}
	
	function getList($dirname){
		$arrayfiles=Array();
		if(file_exists($dirname)){
			$handle = opendir($dirname);
			while (false !== ($file = readdir($handle))) { 
				if(!is_file($dirname.$file) && $file!= '.' && $file!='..'){
					array_push($arrayfiles,$file);
				}
			}
			$handle = closedir($handle);
		}
		sort($arrayfiles);
		return $arrayfiles;
	}
}