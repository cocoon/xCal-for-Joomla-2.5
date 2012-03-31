<?php
// impedisco l'accesso diretto
defined('_JEXEC') or die('Restricted access');
 
// importo le librerie di Joomla relative alle view
jimport('joomla.application.component.view');
 
/**
 * HTML View class per il componente X-Download
 */
class xcalViewEvent extends JView
{
	// Metodo JView
	function display($tpl = null) 
	{
		JHTML::script('http://maps.google.com/maps/api/js?sensor=false');
		JHTML::script('jquery.min.js', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/');
		JHTML::script('jquery.min.js', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js');
		//JHTML::script('jquery-ui.min.js', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/');
		JHTML::script('components/com_xcal/js/function.js');
		// Assegnamo i dati alla view
		if ($_POST) $this->get('db');
		$this->form = $this->get('form');
		$app = JFactory::getApplication();
		$xpar = $app->getParams();
		$this->template = $xpar->get('template');

		if(file_exists("components/com_xcal/template/".$this->data['template']."/".$this->data['template']."_list.php")){ 
			JHTML::_('stylesheet', $this->template.'_style.css', 'components/com_xcal/template/'.$this->template.'/css/');

		}else{
			JHTML::_('stylesheet', 'default_style.css', 'components/com_xcal/template/default/css/');
		}
 
		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		
		parent::display($tpl);
	}
}