<?php
// no direct access
defined('_JEXEC') or die;

// Component Helper
jimport('joomla.application.component.helper');
jimport('joomla.application.categories');


abstract class XcalHelperRoute
{

	function XcalBuildRoute( &$query )
	{
			echo '<pre>ECCOMI:'.print_r($query, true).'</pre>';
	       $segments = array();
	       if(isset($query['view']))
	       {
	                $segments[] = $query['view'];
	                unset( $query['view'] );
	       }
	       if(isset($query['id']))
	       {
	                $segments[] = $query['id'];
	                unset( $query['id'] );
	       };
	       return $segments;
	}

	function XcalParseRoute( $segments )
	{
	       $vars = array();
	       switch($segments[0])
	       {
	               case 'categories':
	                       $vars['view'] = 'categories';
	                       break;
	               case 'category':
	                       $vars['view'] = 'category';
	                       $id = explode( ':', $segments[1] );
	                       $vars['id'] = (int) $id[0];
	                       break;
	               case 'article':
	                       $vars['view'] = 'article';
	                       $id = explode( ':', $segments[1] );
	                       $vars['id'] = (int) $id[0];
	                       break;
	       }
	       return $vars;
	}

}