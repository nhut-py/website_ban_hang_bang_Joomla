<?php
defined ('_JEXEC') or die();
/**
*
*
* @package	VirtueMart
* @subpackage
* @author Max Milbers
* @link https://virtuemart.net
* @copyright Copyright (c) 2012 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: massxref.php 10418 2021-01-13 12:24:24Z alatak $
 *
*/

if($this->task=='massxref_cats' or $this->task=='massxref_cats_exe'){

	JLoader::register('VirtuemartControllerCategory', VMPATH_ADMIN.'/controllers/category.php');
	$catController = new VirtuemartControllerCategory();

	JLoader::register('virtuemartViewCategory', VMPATH_ADMIN.'/views/category/view.html.php');
	$view = $catController->getView('category', 'default');
	$view ->setPaginationDragAndOrderIcons($this->categories);
	//$view->display();

	include(VMPATH_ADMIN .'/views/category/tmpl/default.php');
}

if($this->task=='massxref_sgrps' or $this->task=='massxref_sgrps_exe'){
	include(VMPATH_ADMIN .'/views/shoppergroup/tmpl/default.php');
}