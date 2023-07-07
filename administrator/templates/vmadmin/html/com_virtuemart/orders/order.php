<?php
/**
 *
 * Display form details
 *
 * @package    VirtueMart
 * @subpackage Orders
 * @author Oscar van Eijk, Max Milbers, Valérie Isaksen
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: order.php 10408 2021-01-12 08:18:32Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$adminTemplate = VMPATH_ROOT . '/administrator/templates/vmadmin/html/com_virtuemart/';
JLoader::register('vmuikitAdminUIHelper', $adminTemplate . 'helpers/vmuikit_adminuihelper.php');

vmuikitAdminUIHelper::startAdminArea($this);

vmuikitAdminUIHelper::imitateTabs('start', 'COM_VIRTUEMART_ORDER_PRINT_PO_LBL', 'uk-card-small');

// Get the plugins
VmConfig::importVMPlugins('vmpayment');

$jsOrderStatusShopperEmail = '""';
$j = 'if (typeof Virtuemart === "undefined")
	var Virtuemart = {};
	Virtuemart.confirmDelete = "' . vmText::_('COM_VIRTUEMART_ORDER_DELETE_ITEM_JS', true) . '";
	jQuery(document).ready(function() {
		Virtuemart.onReadyOrderItems();
	});
	var editingItem = 0;';
vmJsApi::addJScript('onReadyOrder', $j);

vmJsApi::addJScript('/administrator/components/com_virtuemart/assets/js/orders.js', false, false);


$this->unequal = (int)$this->currency->truncate($this->orderbt->toPay - $this->orderbt->paid);
?>
<?php // adminForm is the form for the filter only ?>
	<form name='adminForm' id="adminForm">
		<input type="hidden" name="task" value=""/>
		<input type="hidden" name="option" value="com_virtuemart"/>
		<input type="hidden" name="view" value="orders"/>
		<input type="hidden" name="virtuemart_order_id" value="<?php echo $this->orderID; ?>"/>
		<?php echo JHtml::_('form.token'); ?>
		<?php echo $this->loadTemplate('filter') ?>


	</form>
	<!-- HEADER -->
	<div class="uk-child-width-1-5@xl uk-child-width-1-3@l uk-child-width-1-2@s uk-grid-small uk-grid-match" uk-grid>
		<?php echo $this->loadTemplate('header') ?>
	</div>
	<!-- /HEADER -->


	<form action="index.php" method="post" name="orderForm" id="orderForm" class="uk-margin-medium-top">
		<div class="uk-child-width-1-3@l uk-child-width-1-2@m uk-grid uk-grid-small uk-grid-match" uk-grid>
		<?php echo $this->loadTemplate('btststatus') ?>
		<!-- /BT, ST, Order status -->
		<input type="hidden" name="task" value="updateOrderHead"/>
		<input type="hidden" name="option" value="com_virtuemart"/>
		<input type="hidden" name="view" value="orders"/>
		<input type="hidden" name="virtuemart_order_id" value="<?php echo $this->orderID; ?>"/>
		<input type="hidden" name="old_virtuemart_paymentmethod_id"
				value="<?php echo $this->orderbt->virtuemart_paymentmethod_id; ?>"/>
		<input type="hidden" name="old_virtuemart_shipmentmethod_id"
				value="<?php echo $this->orderbt->virtuemart_shipmentmethod_id; ?>"/>
		<?php echo JHtml::_('form.token'); ?>
		</div>

	</form>

	<!-- Update order status Form -->
	<div uk-dropdown="toggle:#update-status-button; mode:click;boundary: #update-status-button; boundary-align: true">
		<?php echo $this->loadTemplate('editstatus'); ?>
	</div>
	<!-- /Update order status Form -->

	<!-- Order items -->
	<div class="uk-grid uk-grid-medium uk-grid-match" uk-grid>
		<?php echo $this->loadTemplate('items') ?>
	</div>
	<!-- /Order items -->

	<!-- shipment and payment -->
	<div class="uk-child-width-1-2@m uk-grid uk-grid-small uk-grid-match" uk-grid>

		<?php echo $this->loadTemplate('shipmentpayment') ?>

	</div>
	<!-- /shipment and payment -->
<?php


vmuikitAdminUIHelper::imitateTabs('end');
vmuikitAdminUIHelper::endAdminArea();



vmJsApi::addJScript('/administrator/components/com_virtuemart/assets/js/dynotable.js', false, false);

$j = 'jQuery(document).ready(function ($) {
        jQuery("#order-items-table").dynoTable({
            removeClass: ".order-item-remove", //remove class name in  table
            cloneClass: ".order-item-clone", //Custom cloner class name in  table
            addRowTemplateId: "#add-tmpl", //Custom id for  row template
            addRowButtonId: "#add-order-item", //Click this to add a new order item
            lastRowRemovable:true, //let the table be empty.
            orderable:true, //items can be rearranged
            dragHandleClass: ".order-item-ordering", //class for the click and draggable drag handle
            insertRowPlace: ".order-item", //class for the click and draggable drag handle
            onRowRemove:function () {
            },
            onBeforeRowInsert:function (newTr) {
            	var randomNumber = Math.floor(Math.random() * 100);
            	$(newTr).find("*").andSelf().filter("[name]").each(function () {
            		var name=this.name;
            		var needle = "item_id["
					var newname = name.replace(needle, needle+"0-"+randomNumber+"-");
                    this.name = newname;
                    this.id += randomNumber;
				});
            },
             onRowClone:function () {
            },
            onRowAdd:function (newTr) {
            	$(".orderEdit").show();
				$(".orderView").hide();
            },
            onTableEmpty:function () {
            },
            onRowReorder:function () {
            }
        });
        
      
        
    });';
vmJsApi::addJScript('dynotable_order_item_ini', $j);


vmJsApi::addJScript('vm-order-STsameAsBT', "
		jQuery(document).ready(function($) {

			if ( $('#STsameAsBT').is(':checked') ) {
				$('.order-st').find('button').prop('disabled', true) ;
					$('.order-st').find('input').prop('readonly', true) ;
			} else {
					$('.order-st').find('button').prop('disabled', false) ;
					$('.order-st').find('input').prop('readonly', false) ;
			}
			$('#STsameAsBT').click(function(event) {
				if($(this).is(':checked')){
					$('#STsameAsBT').val('1') ;
					$('.order-st').find('button').prop('disabled', true) ;
					$('.order-st').find('input').prop('readonly', true) ;
				} else {
					$('#STsameAsBT').val('0') ;
					$('.order-st').find('button').prop('disabled', false) ;
					$('.order-st').find('input').prop('readonly', false) ;
				}

			});
		});
	");


?>