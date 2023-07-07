<?php
/**
 * @package		VINAORA VISITORS COUNTER
 * @subpackage	vvisit_counter
 *
 * @copyright	Copyright (C) 2007-2015 VINAORA. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 *
 * @website		http://vinaora.com
 * @twitter		http://twitter.com/vinaora
 * @facebook	https://www.facebook.com/pages/Vinaora/290796031029819
 * @google+		https://plus.google.com/111142324019789502653
 */

// no direct access
defined('_JEXEC') or die;
 
/**
 * Script file of Vinaora Visitors Counter plugin
 */
class plgSystemVVisit_CounterInstallerScript
{
	
	/**
	 * method to install the extension
	 *
	 * @return void
	 */
	function install($parent)
	{
		// $parent is the class calling this method
		// $parent->getParent()->setRedirectURL('index.php?option=com_helloworld');
	}
	
	/**
	 * method to uninstall the extension
	 *
	 * @return void
	 */
	function uninstall($parent) 
	{
		// $parent is the class calling this method
		// echo '<p>' . JText::_('COM_HELLOWORLD_UNINSTALL_TEXT') . '</p>';
	}
	
	/**
	 * method to update the extension
	 *
	 * @return void
	 */
	function update($parent) 
	{
		// $parent is the class calling this method
		// echo '<p>' . JText::sprintf('COM_HELLOWORLD_UPDATE_TEXT', $parent->get('manifest')->version) . '</p>';
	}
	
	/**
	 * method to run before an install/update/uninstall method
	 *
	 * @return void
	 */
	function preflight($type, $parent) 
	{
		// $parent is the class calling this method
		// $type is the type of change (install, update or discover_install)
		// echo '<p>' . JText::_('COM_HELLOWORLD_PREFLIGHT_' . $type . '_TEXT') . '</p>';
	}

	/**
	 * Method to run after an install/update/uninstall method
	 * $parent is the class calling this method
	 * $type is the type of change (install, update or discover_install)
	 *
	 * @return void
	 */
	function postflight($type, $parent)
	{
		// We only need to perform this if the extension is being installed, not updated
		if ( $type == 'install' )
		{
			$db		= JFactory::getDbo();
			$query	= $db->getQuery(true);

			$fields = array(
				$db->quoteName('enabled') . ' = 1',
				$db->quoteName('ordering') . ' = 9999'
			);

			$conditions = array(
				$db->quoteName('element') . ' = ' . $db->quote('vvisit_counter'), 
				$db->quoteName('type') . ' = ' . $db->quote('plugin')
			);

			$query
				->update($db->quoteName('#__extensions'))
				->set($fields)
				->where($conditions);

			$db->setQuery($query);
			$db->execute();
		}
	}
}
