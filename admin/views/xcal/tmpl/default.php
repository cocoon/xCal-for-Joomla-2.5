<?php
/**
 * @version     2.0.5
 * @package     com_xcal
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */


// no direct access
defined('_JEXEC') or die;

JHTML::_('stylesheet', 'style.css', 'administrator/components/com_xcal/add/');
JHtml::_('behavior.tooltip');
JHTML::_('script','system/multiselect.js',false,true);
$user	= JFactory::getUser();
$userId	= $user->get('id');
?>

<div class="cpanel-left">
	<div class="cpanel">
	
		<div class="icon-wrapper">
			<div class="icon">
				<a href="index.php?option=com_xcal&view=categories">
					<img alt="" src="templates/bluestork/images/header/icon-48-category.png">
					<span><?php echo JText::_( 'COM_XCAL_PANEL_CATEGORY' ); ?></span>
				</a>
			</div>
		</div>
		
		<div class="icon-wrapper">
			<div class="icon">
				<a href="index.php?option=com_xcal&view=category&layout=edit">
					<img alt="" src="templates/bluestork/images/header/icon-48-category-add.png">
					<span><?php echo JText::_( 'COM_XCAL_PANEL_NEW_CATEGORY' ); ?></span>
				</a>
			</div>
		</div>

		<div class="icon-wrapper">
			<div class="icon">
				<a href="index.php?option=com_xcal&view=locations">
					<img alt="" src="../media/com_xcal/images/iconlocation48.png">
					<span><?php echo JText::_( 'COM_XCAL_PANEL_LOCATIONS' ); ?></span>
				</a>
			</div>
		</div>
		
		<div class="icon-wrapper">
			<div class="icon">
				<a href="index.php?option=com_xcal&view=location&layout=edit">
					<img alt="" src="../media/com_xcal/images/iconlocation-add48.png">
					<span><?php echo JText::_( 'COM_XCAL_PANEL_NEW_LOCATION' ); ?></span>
				</a>
			</div>
		</div>
		
		<div class="icon-wrapper">
			<div class="icon">
				<a href="index.php?option=com_xcal&view=events">
					<img alt="" src="../media/com_xcal/images/iconevent48.png">
					<span><?php echo JText::_( 'COM_XCAL_PANEL_EVENTS' ); ?></span>
				</a>
			</div>
		</div>
		
		<div class="icon-wrapper">
			<div class="icon">
				<a href="index.php?option=com_xcal&view=event&layout=edit">
					<img alt="" src="../media/com_xcal/images/iconevent-add48.png">
					<span><?php echo JText::_( 'COM_XCAL_PANEL_NEW_EVENT' ); ?></span>
				</a>
			</div>
		</div>	
		
		<div class="icon-wrapper">
			<div class="icon">
				<a href="index.php?option=com_xcal&view=registration">
					<img alt="" src="../media/com_xcal/images/iconregistration48.png">
					<span><?php echo JText::_( 'COM_XCAL_PANEL_REGISTRATION' ); ?></span>
				</a>
			</div>
		</div>

		<div class="icon-wrapper">
			<div class="icon">
				<a href="index.php?option=com_xcal&view=mail&layout=edit">
					<img alt="" src="../media/com_xcal/images/iconmail48.png">
					<span><?php echo JText::_( 'COM_XCAL_PANEL_NEWSLETTER' ); ?></span>
				</a>
			</div>
		</div>	
		
	</div>
</div>






<div class="cpanel-right">
	
	<!--center>
		<h1><img alt="" src="../media/com_xcal/images/logo.png" /><a href="site.imgteam.net" style="color:#589c4c">iMG team</a></h1>
	</center-->
	
	<div style="width:560px; margin:0 auto;">
		<iframe width="560" height="315" src="http://www.youtube.com/embed/AJsC2DNjkUU" frameborder="0" allowfullscreen></iframe>
		<div style="border-top:1px solid #ccc; margin-top:10px;">
			<h3>Special Thanks</h3>

			<b>Developer:</b><br/>
			<p>JonxDuo (<a href="http://labs.imgteam.net">imgteam</a>)</p>

			<b>Adviser:</b><br/>
			<p>non_spararmi (scienzadellevanghe)</p>

			<b>Translators:</b><br/>
			<p>Patrick Schlicher</p>

			<b>Betatester:</b><br/>
			<p>Federicox2010, dangerin, gladio-it, alfiera, mauriziomerli, giusebos, AchLive, @tomino, damapo, shark996, vitoricciardi, Mauro73, personanormale, mcfazzo</p>

		</div>

	</div>
	
</div>