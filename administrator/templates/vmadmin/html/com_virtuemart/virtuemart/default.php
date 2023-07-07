<?php
/**
*
* Description
*
* @package	VirtueMart
* @subpackage
* @author
* @link https://virtuemart.net
* @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: default.php 10391 2021-01-11 11:13:42Z alatak $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

$adminTemplate = VMPATH_ROOT . '/administrator/templates/vmadmin/html/com_virtuemart/';
JLoader::register('vmuikitAdminUIHelper', $adminTemplate . 'helpers/vmuikit_adminuihelper.php');
vmuikitAdminUIHelper::startAdminArea($this);

JToolbarHelper::title(vmText::_('COM_VIRTUEMART')." ".vmText::_('COM_VIRTUEMART_CONTROL_PANEL'), 'head vm_store_48');

$tabs =  array('controlpanel' => 'COM_VIRTUEMART_CONTROL_PANEL' );
if($this->manager('report')){
	$tabs['statisticspage'] = 'COM_VIRTUEMART_STATISTIC_STATISTICS';
}

// Loading Templates in Tabs
vmuikitAdminUIHelper::buildTabs ( $this,$tabs );

vmuikitAdminUIHelper::endAdminArea ();
