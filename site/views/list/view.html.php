<?php
// impedisco l'accesso diretto
defined('_JEXEC') or die('Restricted access');
 
// importo le librerie di Joomla relative alle view
jimport('joomla.application.component.view');
 
/**
 * HTML View class per il componente X-Download
 */
class xcalViewList extends JView
{
	// Metodo JView
	function display($tpl = null) 
	{
		JHTML::script('http://maps.google.com/maps/api/js?sensor=false');
		JHTML::script('jquery.min.js', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/');
		JHTML::script('jquery-ui.min.js', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/');
		JHTML::script('components/com_xcal/js/function.js');

		// caricamento dati
		$this->data = $this->get('Data');
		// carichiamo le imp
		$app = JFactory::getApplication();
		$xpar = $app->getParams();
		$this->template = $xpar->get('template');
		$this->format = $xpar->get('format');
 
		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}

		parent::display($tpl);
	}
}