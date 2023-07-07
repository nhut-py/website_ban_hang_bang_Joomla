<?php
/**
 *
 * Display form Order header
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
 * @version $Id: order_header.php 10408 2021-01-12 08:18:32Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

$unequal = (int)$this->currency->truncate($this->orderbt->toPay - $this->orderbt->paid);
if ($unequal) {
	$icon = 'unpublish';
	$val = '1';
	$text = 'COM_VIRTUEMART_ORDER_SET_PAID';
} else {
	$icon = 'publish';
	$val = '0';
	$text = 'COM_VIRTUEMART_ORDER_SET_UNPAID';
}
$baseUrl = 'index.php?option=com_virtuemart&view=orders&task=callInvoiceView&tmpl=component&virtuemart_order_id=' . $this->orderbt->virtuemart_order_id;
$print_url = $baseUrl . '&layout=invoice';


$linkTogglePaid = 'index.php?option=com_virtuemart&view=orders&task=toggle.paid.' . $val . '&cidName=virtuemart_order_id&virtuemart_order_id[]=' . $this->orderID . '&rtask=edit&' . JSession::getFormToken() . '=1';



?>


	<?php // the first card will be displayed alone on mobile ?>
	<!-- order number -->
	<div class="uk-width-1-5@xl uk-width-1-3@l uk-width-1-1@s">
		<div class="uk-card uk-card-small uk-card-vm uk-flex">
			<div class="uk-flex-1">
				<div class="uk-position-absolute uk-position-top-right uk-margin-small-right uk-margin-small-top">
					<?php
					$orderLink = JURI::root() . 'index.php?option=com_virtuemart&view=orders&layout=details&order_number=' . $this->orderbt->order_number . '&order_pass=' . $this->orderbt->order_pass;
					?>
					<a href="<?php echo $orderLink ?>" target="_blank"
							class="uk-icon-button md-color-cyan-600"
							uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_ORDER_VIEW_ORDER_FRONTEND') ?>"
					>
						<span uk-icon="icon: link"></span>
					</a>
				</div>
				<div class="uk-card-body">
					<div>
						<?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_PO_NUMBER') ?>
					</div>
					<div class="uk-card-title">
						<?php echo $this->orderbt->order_number; ?>
					</div>
					<div class="uk-margin-small-top">

							<span uk-icon="icon: lock; ratio: 0.75"
									uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_PO_PASS') ?>"></span>
						<span class=" uk-margin-small-left"><?php echo $this->orderbt->order_pass; ?></span>
					</div>
					<?

					?>
					<div class="uk-margin-small-top">
						<?php
						/*
						echo adminSublayouts::renderAdminVmSubLayout('print_links',
							array(
								'order' => $this->orderbt,
								'iconRatio' => 1.2,
								'hrefClass' => 'uk-icon-button',
							));
						*/
						?>
						<?php
						if ($this->orderbt->invoiceNumbers) {
							?>
							<div class="uk-flex">
								<div class=" uk-width-auto  uk-flex-middle uk-flex uk-flex-center">
										<span uk-icon="icon: file-pdf; ratio: 0.75"
												uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_INVOICE') ?>">
										</span>
								</div>
								<div class="uk-flex-1 uk-margin-small-left">
									<?php
									foreach ($this->orderbt->invoiceNumbers as $index => $invoiceNumber) {
										?>
										<span class="uk-margin-small-right"><?php echo $invoiceNumber ?></span>
										<?php
									}
									?>
								</div>
							</div>
							<?php
						}
						?>

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /order number -->
	<?php
	$userlink = false;
	if ($this->orderbt->virtuemart_user_id) {
		$userlink = JRoute::_('index.php?option=com_virtuemart&view=user&task=edit&virtuemart_user_id[]=' . $this->orderbt->virtuemart_user_id);
		$orderName = $this->orderbt->order_name;
	} else {
		$orderName = $this->orderbt->first_name . ' ' . $this->orderbt->last_name;
	}
	?>
	<!-- user -->
	<div>
		<div class="uk-card uk-card-small uk-card-vm uk-flex">
			<div class="uk-flex-1">
				<div class="uk-position-absolute uk-position-top-right uk-margin-small-right uk-margin-small-top">
					<?php
					if ($userlink) {
						?>
						<a href="<?php echo $userlink ?>" target="_blank"
								class="uk-icon-button md-color-cyan-600"
								title="<?php echo vmText::_('COM_VIRTUEMART_ORDER_EDIT_USER') ?>"
								uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_ORDER_EDIT_USER') ?>"

						>
							<span uk-icon="icon: pencil; ratio: 0.75"></span>
						</a>
						<?php
					}
					?>

				</div>
				<div class="uk-card-body">
					<div>
						<?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_NAME') ?>
					</div>
					<div class="uk-card-title">
						<?php echo $orderName; ?>
					</div>
					<div class="uk-margin-small-top">
							<span uk-icon="icon: location; ratio: 0.75"
									uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_PO_IPADDRESS') ?>"></span>
						<span class=" uk-margin-small-left"><?php echo $this->orderbt->ip_address; ?></span>
					</div>
					<div class="uk-margin-small-top">
							<span uk-icon="icon: world; ratio: 0.75"
									uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_ORDER_LANGUAGE') ?>"></span>
						<span class=" uk-margin-small-left"><?php echo $this->orderbt->order_language; ?></span>
					</div>


				</div>
			</div>
		</div>
	</div>
	<!-- /user -->
	<!-- total -->
	<div>
		<div class="uk-card uk-card-small uk-card-vm uk-flex">
			<div class="uk-flex-1">
				<div class="uk-position-absolute uk-position-top-right uk-margin-small-right uk-margin-small-top">
					<!--<a href="" class="uk-icon-button md-bg-green-600 md-color-white" uk-icon="check"></a>-->

					<a href="#vm-order-items" class="uk-icon-button md-color-cyan-600"
							uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_ORDER_GOTO_ORDER_ITEMS') ?>"
							uk-scroll
					>
						<span uk-icon="icon: cart"></span>
					</a>

				</div>
				<div class="uk-card-body">
					<div>
						<?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_PO_LBL') ?>
					</div>
					<div class="uk-card-title">
						<?php echo $this->currency->priceDisplay($this->orderbt->order_total); ?>
						<?php
						$unequal = (int)$this->currency->truncate($this->orderbt->toPay - $this->orderbt->paid);
						if ($unequal) {
							$iconPaid = 'unpublish';
							$labelPaid = 'COM_VIRTUEMART_ORDER_IS_UNPAID';
							$colorPaid = 'md-color-red-600';
							$ukIconPaid = 'close';
							$valPaid = '1';
							$textPaid = 'COM_VIRTUEMART_ORDER_SET_PAID';
						} else {
							$iconPaid = 'publish';
							$labelPaid = 'COM_VIRTUEMART_ORDER_IS_PAID';
							$colorPaid = 'md-color-green-600';
							$ukIconPaid = 'check';
							$valPaid = '0';
							$texPaidt = 'COM_VIRTUEMART_ORDER_SET_UNPAID';
						}
						$linkPaid = 'index.php?option=com_virtuemart&view=orders&task=toggle.paid.' . $valPaid . '&cidName=virtuemart_order_id&virtuemart_order_id[]=' . $this->orderID . '&rtask=edit&' . JSession::getFormToken() . '=1';
						if (empty($this->orderbt->invoice_locked)) {
							$iconLocked = 'publish';
							$valLocked = '1';
							$textLocked = 'COM_VM_ORDER_INVOICE_LOCK';
							$textStateLocked = '';
							$ukIconLocked = 'unlock';
							$colorLocked = 'md-color-green-600';
						} else {
							$iconLocked = 'unpublish';
							$valLocked = '0';
							$textLocked = 'COM_VIRTUEMART_INVOICE_UNLOCK';
							$textStateLocked = vmText::_('COM_VM_ORDER_INVOICE_LOCKED');
							$ukIconLocked = 'lock';
							$colorLocked = 'md-color-red-600';
						}
						$linkLocked = 'index.php?option=com_virtuemart&view=orders&task=toggle.invoice_locked.' . $val . '&cidName=virtuemart_order_id&virtuemart_order_id[]=' . $this->orderID . '&rtask=edit&' . JSession::getFormToken() . '=1';

						?>
						<!--
							<a href="<?php echo JRoute::_($linkPaid, FALSE) ?>" class="uk-icon-button <?php echo $colorPaid ?>">
								<span uk-icon="icon: <?php echo $ukIconPaid ?>"; ratio: 1.2"></span>
							</a>
							<a href="<?php echo JRoute::_($linkLocked, FALSE) ?>" class="uk-icon-button <?php echo $colorLocked ?>">
								<span uk-icon="icon: <?php echo $ukIconLocked ?>"; ratio: 1.2"></span>
							</a>
							-->
					</div>
					<div class="uk-margin-small-top">

							<span uk-icon="icon: calendar; ratio: 0.75"
									uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_PO_DATE') ?>"></span>
						<span class=" uk-margin-small-left"><?php echo vmJsApi::date($this->orderbt->created_on, 'LC2', true); ?></span>
					</div>
					<?php

					if ($this->orderbt->coupon_code) {
						?>
						<div class="uk-margin-small-top">

								<span uk-icon="icon: gift-box; ratio: 0.75"
										uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_COUPON_CODE') ?>"></span>
							<span class=" uk-margin-small-left"><?php echo $this->orderbt->coupon_code; ?></span>
						</div>
					<?php } ?>


				</div>
			</div>
		</div>
	</div>
	<!-- /total -->
	<div>
		<div class="uk-card uk-card-small uk-card-vm uk-flex">

			<div class="uk-flex-1">
				<div class="uk-position-absolute uk-position-top-right uk-margin-small-right uk-margin-small-top">
					<a href="#vm-order-shipment-payment"
							class="uk-icon-button md-color-cyan-600"
							uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_ORDER_GOTO_SHIPMENT_PAYMENT') ?>"
							uk-scroll
					>
						<span uk-icon="icon: arrow-down; ratio: 1.2"></span>
					</a>
				</div>
				<div class="uk-card-body">
					<div>
						<?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_PAYMENT_LBL') ?>
					</div>
					<div class="uk-card-title">
						<?php
						$model = VmModel::getModel('paymentmethod');
						$payments = $model->getPayments();
						$model = VmModel::getModel('shipmentmethod');
						$shipments = $model->getShipments();
						?>
						<input type="hidden" size="10"
								name="virtuemart_paymentmethod_id"
								value="<?php echo $this->orderbt->virtuemart_paymentmethod_id; ?>"/>
						<!--
							<? echo VmHTML::select("virtuemart_paymentmethod_id", $payments, $this->orderbt->virtuemart_paymentmethod_id, '', "virtuemart_paymentmethod_id", "payment_name"); ?>
							<span id="delete_old_payment" style="display: none;"><br />
								<input id="delete_old_payment" type="checkbox" name="delete_old_payment" value="1" /> <label class='' for="" title="<?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_PAYMENT_DELETE_DESC'); ?>"><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_PAYMENT_DELETE'); ?></label>
							</span>
							-->
						<?php
						foreach ($payments as $payment) {
							if ($payment->virtuemart_paymentmethod_id == $this->orderbt->virtuemart_paymentmethod_id) {
								echo $payment->payment_name;
							}
						}
						?>
					</div>
					<div>
						<?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_SHIPMENT_LBL') ?>
					</div>
					<div class="uk-card-title">
						<input type="hidden" size="10"
								name="virtuemart_shipmentmethod_id"
								value="<?php echo $this->orderbt->virtuemart_shipmentmethod_id; ?>"/>
						<!--
							<? echo VmHTML::select("virtuemart_shipmentmethod_id", $shipments, $this->orderbt->virtuemart_shipmentmethod_id, '', "virtuemart_shipmentmethod_id", "shipment_name"); ?>
							<span id="delete_old_shipment" style="display: none;"><br />
								<input id="delete_old_shipment" type="checkbox" name="delete_old_shipment" value="1" /> <label class='' for=""><?php echo vmText::_('COM_VIRTUEMART_ORDER_EDIT_CALCULATE'); ?></label>
							</span>
							-->
						<?php
						foreach ($shipments as $shipment) {
							if ($shipment->virtuemart_shipmentmethod_id == $this->orderbt->virtuemart_shipmentmethod_id) {
								echo $shipment->shipment_name;
							}
						}
						?>
					</div>
					<!--
									<div>
										<?php echo vmText::_('COM_VIRTUEMART_DELIVERY_DATE') ?>
									</div>
									<div>
										<input type="text" maxlength="190" class="required"
												value="<?php echo $this->orderbt->delivery_date; ?>"
												size="30" name="delivery_date"
												id="delivery_date_field">
									</div>
									-->
				</div>
			</div>
		</div>
	</div>
	<!-- order status -->
	<div>
		<div class="uk-card uk-card-small uk-card-vm uk-flex">
			<div class="uk-flex-1">
				<div class="uk-position-absolute uk-position-top-right uk-margin-small-right uk-margin-small-top">
					<a href="#vm-order-history"
							class="uk-icon-button md-color-cyan-600"
							uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_ORDER_GOTO_CHANGE_STATUS') ?>"
							uk-scroll>
						<span uk-icon="icon: commenting; ratio: 0.75"></span>
					</a>
				</div>
				<div class="uk-card-body">
					<div>
						<?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_PO_STATUS') ?>
					</div>
					<div class="uk-card-title">
						<?php echo $this->orderstatuslist[$this->orderbt->order_status]; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /order status -->



