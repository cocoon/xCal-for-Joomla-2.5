<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.categories');

function XcalBuildRoute( &$query )
{
       $segments = array();

       // se il link punta ad un evento
       if(isset($query['layout']) && $query['layout']=='event')
       {
       		$exCat=explode(':', $query['cat']);
       		$segments[] = $exCat[1];
       		unset($query['cat']);

       		$exId=explode(':', $query['id']);
       		$segments[] = $exId[1];
       		unset($query['id']);

       		$segments[]='event_details';
       		unset($query['view']);
       		unset($query['layout']);
       }

       // se il link punta alla registrazione di un evento
       if(isset($query['layout']) && $query['layout']=='registration')
       {
       		$exCat=explode(':', $query['cat']);
       		$segments[] = $exCat[1];
       		unset($query['cat']);

       		$exId=explode(':', $query['id']);
       		$segments[] = $exId[1];
       		unset($query['id']);

       		$segments[]='event_registration';
       		unset($query['view']);
       		unset($query['layout']);
       }

       // se il link punta alla ricerca
       if(isset($query['view'])&&$query['view']=='search')
       {
       		$segments[]='serach';
       }


       return $segments;
}

function XcalParseRoute( $segments )
{
       $vars = array();
       if(isset($segments[2])){
	       switch($segments[2])
		       {
		               case 'event_details':
		               		   $vars['option'] = 'com_xcal';
		                       $vars['view'] = 'list';
		                       $vars['layout'] = 'event';
		                       break;
		               case 'event_registration':
		               		   $vars['option'] = 'com_xcal';
		                       $vars['view'] = 'list';
		                       $vars['layout'] = 'registration';
		                       break;
		       }
       }else{
       		switch($segments[0])
		       {
		               case 'search':
		               		   $vars['option'] = 'com_xcal';
		                       $vars['view'] = 'list';
		                       $vars['layout'] = 'search';
		                       break;
		       }
       }

       return $vars;
}
