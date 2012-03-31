<?php
/**
 * @version     2.0.5
 * @package     com_xcal
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Xcal helper.
 */
class XcalHelper
{
	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu($vName = '')
	{
	
		JSubMenuHelper::addEntry(
			JText::_('COM_XCAL_TITLE_XCAL'),
			'index.php?option=com_xcal&view=xcal',
			$vName == 'xcal'
		);

		JSubMenuHelper::addEntry(
			JText::_('COM_XCAL_TITLE_CATEGORIES'),
			'index.php?option=com_xcal&view=categories',
			$vName == 'categories'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_XCAL_TITLE_LOCATIONS'),
			'index.php?option=com_xcal&view=locations',
			$vName == 'locations'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_XCAL_TITLE_EVENTS'),
			'index.php?option=com_xcal&view=events',
			$vName == 'events'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_XCAL_TITLE_REGISTRATION'),
			'index.php?option=com_xcal&view=registration',
			$vName == 'registration'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_XCAL_TITLE_NEWSLETTER'),
			'index.php?option=com_xcal&view=mail&layout=edit',
			$vName == 'newsletter'
		);
		
		$document = JFactory::getDocument();

		$document->addStyleDeclaration('
			.icon48xcal{background: url(../media/com_xcal/images/icon48xcal.png);}
			.icon-48-events {background: url(../media/com_xcal/images/iconevent48.png) no-repeat;}
			.icon-48-event {background: url(../media/com_xcal/images/iconevent-add48.png) no-repeat;}
			.icon-48-registration {background: url(../media/com_xcal/images/iconregistration48.png) no-repeat;}
			.icon-48-locations {background: url(../media/com_xcal/images/iconlocation48.png) no-repeat;}
			.icon-48-location {background: url(../media/com_xcal/images/iconlocation-add48.png) no-repeat;}
			.icon-48-category {background: url(templates/bluestork/images/header/icon-48-category-add.png) no-repeat;}
			.icon-48-generic {background: url(../media/com_xcal/images/iconxcal48.png) no-repeat;}
			.icon-48-mail {background: url(../media/com_xcal/images/iconmail48.png) no-repeat;}
		');

	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		$assetName = 'com_xcal';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action,	$user->authorise($action, $assetName));
		}

		return $result;
	}
}
