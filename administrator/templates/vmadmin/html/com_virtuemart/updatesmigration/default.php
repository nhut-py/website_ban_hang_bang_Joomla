<?php
/**
*
* Description
*
* @package	VirtueMart
* @subpackage UpdatesMigration
* @author Max Milbers
* @link https://virtuemart.net
* @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: default.php 10404 2021-01-11 13:36:30Z alatak $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$adminTemplate = VMPATH_ROOT . '/administrator/templates/vmadmin/html/com_virtuemart/';
JLoader::register('vmuikitAdminUIHelper', $adminTemplate . 'helpers/vmuikit_adminuihelper.php');
vmuikitAdminUIHelper::startAdminArea($this);

echo '<div id="cpanel">';

$tabs = array (	'tools' 	=> 	'COM_VIRTUEMART_UPDATE_TOOLS_TAB',
'spwizard' 	=> 	'COM_VM_WIZARD_TAB',
'migrator' 	=> 	'COM_VIRTUEMART_MIGRATION_TAB');

if(vRequest::getBool('show_spwizard',false)){
	unset($tabs['spwizard']);
	$tabs = array_merge(array('spwizard' 	=> 	'COM_VM_WIZARD_TAB'), $tabs);
}
vmuikitAdminUIHelper::buildTabs ( $this,  $tabs);

vmuikitAdminUIHelper::endAdminArea();

echo '</div>';

$j = 'function confirmation(message, destnUrl) {
	var answer = confirm(message);
	if (answer) {
		window.location = destnUrl;
	}
}';

vmJsApi::addJScript('vm-confirm',$j);