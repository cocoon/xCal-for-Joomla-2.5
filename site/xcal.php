<?php
// impedisco l'accesso diretto
defined('_JEXEC') or die('Restricted access');
 
// importo le librerie di controllo di Joomla
jimport('joomla.application.component.controller');
 
// Ottengo un'istanza del controllo preceduto da X-Download
$controller = JController::getInstance('xcal');
 
// Eseguo l'attività richiesta
$controller->execute(JRequest::getCmd('task'));
 
// Reindirizzo
$controller->redirect();