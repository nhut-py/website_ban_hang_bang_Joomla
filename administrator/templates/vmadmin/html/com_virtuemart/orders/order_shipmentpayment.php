<?php
/**
 *
 * Display Order shipment , payment
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
 * @version $Id: order_shipmentpayment.php 10414 2021-01-13 09:20:21Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');


// Get the plugins
VmConfig::importVMPlugins('vmpayment');

?>
<!-- Shipment -->
<div class="">
	<div class="uk-card   uk-card-small uk-card-vm " id="vm-order-shipment-payment">
		<div class="uk-card-header">
			<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: shipment; ratio: 1.2"></span>
				<?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_SHIPMENT_LBL') ?>
			</div>
		</div>
		<div class="uk-card-body">
			<div class="uk-grid-collapse" uk-grid>
				<?php

				$_dispatcher = JDispatcher::getInstance();
				$returnValues = $_dispatcher->trigger('plgVmOnShowOrderBEShipment', array($this->orderID, $this->orderbt->virtuemart_shipmentmethod_id, $this->orderdetails));

				foreach ($returnValues as $returnValue) {
					if ($returnValue !== null) {
						echo $returnValue;
					}
				}
				?>
			</div>

		</div>

	</div>
</div>
<!-- /Shipment -->
<!-- Payment -->
<div class="">
	<div class="uk-card   uk-card-small uk-card-vm ">
		<div class="uk-card-header">
			<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: credit-card; ratio: 1.2"></span><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_PAYMENT_LBL') ?>
			</div>
		</div>
		<div class="uk-card-body">
			<div class="uk-grid-collapse" uk-grid>
				<?php

				$_dispatcher = JDispatcher::getInstance();
				$_returnValues = $_dispatcher->trigger('plgVmOnShowOrderBEPayment', array($this->orderID, $this->orderbt->virtuemart_paymentmethod_id, $this->orderdetails));

				foreach ($_returnValues as $_returnValue) {
					if ($_returnValue !== null) {
						echo $_returnValue;
					}
				}
				?>
			</div>

		</div>

	</div>
</div>
<!-- /Payment -->