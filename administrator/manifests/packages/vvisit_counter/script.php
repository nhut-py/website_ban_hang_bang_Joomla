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
 * Script file of Vinaora Visitors Counter [Package]
 */
class Pkg_VVisit_CounterInstallerScript
{
	/**
	 * method to install the extension
	 *
	 * @return void
	 */
	function install($parent)
	{
		// $parent is the class calling this method
	}
 
	/**
	 * method to uninstall the extension
	 *
	 * @return void
	 */
	function uninstall($parent) 
	{
	}
 
	/**
	 * method to update the extension
	 *
	 * @return void
	 */
	function update($parent)
	{
		// $parent is the class calling this method
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
	}
 
	/**
	 * method to run after an install/update/uninstall method
	 *
	 * @return void
	 */
	function postflight($type, $parent) 
	{
		// $parent is the class calling this method
		// $type is the type of change (install, update or discover_install)
		$parent->getParent()->setRedirectURL('index.php?option=com_modules&filter_search=vinaora');
	}
}