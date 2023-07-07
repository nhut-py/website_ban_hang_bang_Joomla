<?php
/**
*
* Modify user form view
*
* @package	VirtueMart
* @subpackage User
* @author Oscar van Eijk
* @link https://virtuemart.net
* @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: edit.php 10396 2021-01-11 11:35:30Z alatak $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

$adminTemplate = VMPATH_ROOT . '/administrator/templates/vmadmin/html/com_virtuemart/';
JLoader::register('vmuikitAdminUIHelper', $adminTemplate . 'helpers/vmuikit_adminuihelper.php');
vmuikitAdminUIHelper::startAdminArea($this);



?>



<form method="post" id="adminForm" name="adminForm" action="index.php" enctype="multipart/form-data" class="form-validate uk-form-horizontal" onSubmit="return myValidator(this);">
<?php

$tabarray = array();
if (!empty($this->shipToFields) and $this->new) {
	$tabarray['shipto'] = 'COM_VIRTUEMART_USER_FORM_SHIPTO_LBL';
}
if($this->userDetails->user_is_vendor){
	$tabarray['vendor'] = 'COM_VIRTUEMART_VENDOR';
	$tabarray['vendorletter'] = 'COM_VIRTUEMART_VENDORLETTER';
}

//$tabarray['user'] = 'COM_VIRTUEMART_USER_FORM_TAB_GENERALINFO';
if (!empty($this->shipToFields) and !$this->new) {
	$tabarray['shipto'] = 'COM_VIRTUEMART_USER_FORM_SHIPTO_LBL';
}
$tabarray['shopper'] = 'COM_VIRTUEMART_SHOPPER_FORM_LBL';
if (($_ordcnt = count($this->orderlist)) > 0) {
	$tabarray['orderlist'] = 'COM_VIRTUEMART_ORDER_LIST_LBL';
}


vmuikitAdminUIHelper::buildTabs ( $this, $tabarray,'vm-user');

?>

<?php echo $this->addStandardHiddenToForm(); ?>
</form>
<?php
echo adminSublayouts::renderAdminVmSubLayout('images_template');
?>
<?php // Implement Joomla's form validation
 vmJsApi::vmValidator($this->userDetails->JUser->guest); ?>
<?php vmuikitAdminUIHelper::endAdminArea(); ?>
