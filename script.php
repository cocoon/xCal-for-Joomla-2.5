<?php
defined('_JEXEC') or die('Restricted access');

/**
 * Script file of HelloWorld component
 */
class com_xcalInstallerScript
{
	/**
	 * method to install the component
	 *
	 * @return void
	 */
	function install($parent) 
	{
			
		// $parent is the class calling this method
		//$parent->getParent()->setRedirectURL('index.php?option=com_xcal');
		
		// installazione modulo
		$db = JFactory::getDbo();
		$manifest = $parent->get("manifest");
		$parent = $parent->getParent();
		$source = $parent->getPath("source");
		$installer = new JInstaller();
		$installModules = array();
        // procediamo
		if (is_object($manifest->modules) && isset($manifest->modules->module)) 
		{
         foreach($manifest->modules->module as $module) 
			{
				$attributes = $module->attributes();
				$mod = $source . DS . $attributes['folder'].DS.$attributes['module'];
				$installer->install($mod);
				$installModules[] =  $attributes['module'];
            }
        }
	}
}