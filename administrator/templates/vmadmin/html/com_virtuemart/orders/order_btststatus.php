<?php
/**
 *
 * Display Order BT, ST, order status
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
 * @version $Id: order_btststatus.php 10431 2021-01-21 15:22:32Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');


?>


<!-- BT -->
<div class="">
	<div class="uk-card   uk-card-small uk-card-vm ">
		<div class="uk-card-header">
			<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: home; ratio: 1.2"></span>
				<?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_BILL_TO_LBL') ?>
			</div>
		</div>
		<div class="uk-card-body">
			<div class="uk-grid-collapse" uk-grid>
				<?php foreach ($this->userfields['fields'] as $_field) { ?>
					<div class="uk-width-1-3@m">
						<div class="">
							<label for="<?php echo $_field['name'] . '_field' ?>">
								<?php echo $_field['title'] ?>
							</label>
						</div>
					</div>
					<div class="uk-width-2-3@m">
						<div class="">
							<?php
							if ($_field['type'] === 'hidden') {
								echo htmlentities($_field['value'], ENT_COMPAT, 'UTF-8', false);
							} else {
								echo $_field['formcode'];
							}
							?>
						</div>
					</div>
				<?php } ?>
			</div>

		</div>
		<div class="uk-card-footer uk-text-center">
			<button class="uk-button uk-button-small uk-button-primary">
				<?php echo vmText::_('COM_VIRTUEMART_SAVE'); ?>
			</button>

			<a href="#" onClick="javascript:Virtuemart.resetOrderHead(event);"
					class="uk-button uk-button-small uk-button-default">
				<?php echo vmText::_('COM_VIRTUEMART_CANCEL'); ?>
			</a>

		</div>
	</div>
</div>
<!-- /BT -->
<!-- ST -->
<div class="">
	<div class="uk-card   uk-card-small uk-card-vm">
		<div class="uk-card-header">
			<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: location; ratio: 1.2"></span><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_SHIP_TO_LBL') ?>
			</div>
		</div>
		<div class="uk-card-body">
			<div class="uk-grid-collapse " uk-grid>
				<?php
				if ($this->orderdetails['details']['has_ST'] == false) {
					?>

					<div class="uk-width-1-3@m uk-margin-small-bottom">
						<div class="">
							<label for="STsameAsBT"><?php echo vmText::_('COM_VM_ST_SAME_AS_BT') ?></label>
						</div>
					</div>
					<div class="uk-width-2-3@m uk-margin-small-bottom">
						<div class="">
							<input id="STsameAsBT" type="checkbox" checked name="STsameAsBT"
									value="1"/>
						</div>
					</div>


					<?php

				}
				?>
				<?php foreach ($this->shipmentfields['fields'] as $_field) { ?>
					<div class="uk-width-1-3@m">
						<div class="">
							<label for="<?php echo $_field['name'] . '_field' ?>">
								<?php echo $_field['title'] ?>
							</label>
						</div>
					</div>
					<div class="uk-width-2-3@m  order-st">
						<div class="">
							<?php
							if ($_field['type'] === 'hidden') {
								echo htmlentities($_field['value'], ENT_COMPAT, 'UTF-8', false);
							} else {
								echo $_field['formcode'];
							}
							?>
						</div>
					</div>
				<?php } ?>
			</div>

		</div>
		<div class="uk-card-footer uk-text-center">
			<button class="uk-button uk-button-small uk-button-primary">
				<?php echo vmText::_('COM_VIRTUEMART_SAVE'); ?>
			</button>
			<a href="#" onClick="javascript:Virtuemart.resetOrderHead(event);"
					class="uk-button uk-button-small uk-button-default"
			>
				<?php echo vmText::_('COM_VIRTUEMART_CANCEL'); ?>
			</a>
		</div>
	</div>
</div>
<!-- /ST -->


<div class="uk-width-1-3@l uk-width-1-1@m">
	<div>
		<div class="uk-child-width-1-1 uk-grid-small" uk-grid>
			<div>
				<div class="uk-card   uk-card-small uk-card-vm" id="vm-order-note">
					<div class="uk-card-header">

						<div class="uk-card-title">
							<span class="md-color-cyan-600 uk-margin-small-right"
									uk-icon="icon: lock; ratio: 1.2"></span>
							<?php echo vmText::_('COM_VIRTUEMART_ORDER_NOTE') ?>
						</div>
					</div>
					<div class="uk-card-body">
								<textarea class="uk-textarea" name="order_note" cols="60" rows="2"><?php echo $this->orderbt->order_note ?></textarea>
					</div>
					<div class="uk-card-footer uk-text-center">
						<button class="uk-button uk-button-small uk-button-primary">
							<?php echo vmText::_('COM_VIRTUEMART_SAVE'); ?>
						</button>
						<a href="#" onClick="javascript:Virtuemart.resetOrderHead(event);"
								class="uk-button uk-button-small uk-button-default"
						>
							<?php echo vmText::_('COM_VIRTUEMART_CANCEL'); ?>
						</a>
					</div>
				</div>
			</div>

			<!-- Order status -->
			<div>
				<div class="uk-card   uk-card-small uk-card-vm" id="vm-order-history">
					<div class="uk-card-header">

						<div class="uk-card-title">
							<span class="md-color-cyan-600 uk-margin-small-right"
									uk-icon="icon: commenting; ratio: 1.2"></span>
							<?php echo vmText::_('COM_VIRTUEMART_ORDER_HISTORY') ?>
						</div>
					</div>
					<div class="uk-card-body">
						<table class="uk-table uk-table-small uk-table-stripped">
							<thead>
							<tr>
								<th><?php echo vmText::_('COM_VIRTUEMART_ORDER_HISTORY_DATE_ADDED') ?></th>
								<th><?php echo vmText::_('COM_VIRTUEMART_ORDER_HISTORY_CUSTOMER_NOTIFIED') ?></th>
								<th><?php echo vmText::_('COM_VIRTUEMART_ORDER_LIST_STATUS') ?></th>
								<th><?php echo vmText::_('COM_VIRTUEMART_COMMENT') ?></th>
							</tr>
							</thead>
							<?php
							foreach ($this->orderdetails['history'] as $this->orderbt_event) {
								?>
								<tr>
									<td>
										<?php echo vmJsApi::date($this->orderbt_event->created_on, 'LC2', true); ?>
									</td>
									<?php
									if ($this->orderbt_event->customer_notified == 1) {
										?>
										<td class="uk-text-center">
											<span class="uk-text-success" uk-icon="icon: check"></span>
										</td>
										<?php
									} else {
										?>
										<td class="uk-text-center">
											<span uk-icon="icon: close"></span>
										</td>
										<?php
									}
									if (!isset($this->orderstatuslist[$this->orderbt_event->order_status_code])) {
										if (empty($this->orderbt_event->order_status_code)) {
											$this->orderbt_event->order_status_code = 'unknown';
										}
										$this->orderstatuslist[$this->orderbt_event->order_status_code] = vmText::sprintf('COM_VIRTUEMART_UNKNOWN_ORDER_STATUS', $this->orderbt_event->order_status_code);
									}
									?>
									<td align="center">
										<?php echo $this->orderstatuslist[$this->orderbt_event->order_status_code]; ?>
									</td>
									<td align="center">
										<?php echo $this->orderbt_event->comments; ?>
									</td>
								</tr>
								<?php

							}
							?>
							<?php
							// Load additional plugins
							$_dispatcher = JDispatcher::getInstance();
							$_returnValues1 = $_dispatcher->trigger('plgVmOnUpdateOrderBEPayment', array($this->orderID));
							$_returnValues2 = $_dispatcher->trigger('plgVmOnUpdateOrderBEShipment', array($this->orderID));
							$_returnValues = array_merge($_returnValues1, $_returnValues2);
							$_plg = '';
							foreach ($_returnValues as $_returnValue) {
								if ($_returnValue !== null) {
									?>
									<tr>
										<td colspan="4">
											<?php echo $_returnValue; ?>
										</td>
									</tr>
									<?php
								}
							}
							?>
						</table>

					</div>
					<div class="uk-card-footer uk-text-center">
						<div class="uk-inline">
							<button id="update-status-button"
									class="uk-button uk-button-small uk-button-primary"
									type="button">
								<?php echo vmText::_('COM_VIRTUEMART_ORDER_UPDATE_STATUS') ?>
							</button>
						</div>
					</div>
				</div>
			</div>
			<!-- /Order status -->
		</div>
	</div>


</div>



