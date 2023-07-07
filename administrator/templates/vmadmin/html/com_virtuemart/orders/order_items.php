<?php
/**
 *
 * Display Order items
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
 * @version $Id: order_items.php 10451 2021-01-27 08:16:53Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
?>


<div class="uk-width-1-1">
	<div class="uk-card   uk-card-small uk-card-vm">
		<div class="uk-card-header">
			<div class="uk-grid uk-grid-small" id="vm-order-items">
				<div class="uk-width-auto">

					<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: cart; ratio: 1.2"></span>
						<?php echo vmText::_('COM_VIRTUEMART_ORDER_ITEMS') ?>
					</div>
				</div>
				<div class="uk-width-expand">
					<?php if (vmAccess::manager('orders.edit')) { ?>

						<a href="#"
								class="uk-button uk-button-small uk-button-primary uk-margin-small-right enableEdit">
							<span uk-icon="icon: pencil"></span>
							<?php echo vmText::_('COM_VIRTUEMART_ORDER_ITEMS_EDIT'); ?>
						</a>
						<a href="#" id="add-order-item"
								class="uk-button uk-button-small uk-button-primary uk-margin-small-right  orderEdit">
							<span uk-icon="icon: plus-circle"></span>
							<?php echo vmText::_('COM_VIRTUEMART_ORDER_ITEM_NEW'); ?>
						</a>
						<a href="#"
								class="uk-button uk-button-small uk-button-default  uk-margin-small-right cancelEdit orderEdit">
							<span uk-icon="icon: trash"></span>
							<?php echo vmText::_('COM_VIRTUEMART_ORDER_ITEMS_EDIT_CANCEL'); ?>
						</a>
					<?php } ?>

					<?php if (vmAccess::manager('orders.status') or vmAccess::manager('orders.edit')) { ?>
						<a class="uk-button uk-button-small uk-button-primary  updateOrderItemStatus orderEdit"
								href="#">
							<span uk-icon="icon: check"></span>
							<?php echo vmText::_('COM_VIRTUEMART_ORDER_ITEMS_SAVE'); ?></a>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="uk-card-body">
			<div class="">
				<table  id="order-items-table" class="uk-table uk-table-small uk-table-responsive">
					<tr>
						<td colspan="2">
							<form action="index.php" method="post" name="orderItemForm"
									id="orderItemForm"><!-- Update linestatus form -->
								<table  id="itemTable" class="uk-table  uk-table-small uk-table-striped uk-table-responsive">
									<thead>
									<tr>
										<!--<th class="title" width="5%" align="left"><?php echo vmText::_('COM_VIRTUEMART_ORDER_EDIT_ACTIONS') ?></th> -->
										<th class="uk-table-shrink" >#</th>
										<th class="uk-table-shrink"><?php echo "Qty"; //vmText::_('COM_VIRTUEMART_ORDER_PRINT_QUANTITY') ?></th>
										<th ><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_NAME') ?></th>
										<th ><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_SKU') ?></th>
										<th ><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_ITEM_STATUS') ?></th>
										<th class="uk-text-right@m"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_PRICE_NET') ?></th>
										<th class="uk-text-right@m"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_PRICE_BASEWITHTAX') ?></th>
										<th class="uk-text-right@m"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_PRICE_GROSS') ?></th>
										<th class="uk-text-right@m"><?php
											if (is_array($this->taxBill) and count($this->taxBill) == 1) {
												reset($this->taxBill);
												$t = current($this->taxBill);
												echo shopFunctionsF::getTaxNameWithValue($t->calc_rule_name, $t->calc_value);
											} else {
												echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_PRODUCT_TAX');
											}
											//echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_PRICE_TAX') ?></th>
										<th class="uk-text-right@m"> <?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_PRICE_DISCOUNT') ?></th>
										<th class="uk-text-right@m"><?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_TOTAL') ?></th>
									</tr>
									</thead>
									<?php
									$i = 1;
									$rowColor = 0;
									$nbItems = count($this->orderdetails['items']);
									$this->itemsCounter = 0;


									foreach ($this->orderdetails['items'] as $index => $item) { ?>
										<?php
										$this->item = $item;
										$tmpl = "add-tmpl-" . $index;

										?>
										<tr id="<?php echo $tmpl ?>"
												class="order-item <?php echo $rowColor ?> ">
											<?php //echo vmText::_ ('COM_VIRTUEMART_PRODUCT_PRICE_ORDER');
											echo $this->loadTemplate('item'); ?>
										</tr>

										<?php
									}
									// TODO move that to fillVoidOrderItem, from the table ?
									$emptyItem = new stdClass();
									$emptyItem->product_quantity = 0;
									$emptyItem->virtuemart_order_item_id = 0; // 0-xx-yy : cloned or new order tiem
									$emptyItem->virtuemart_product_id = '';
									$emptyItem->order_item_sku = '';
									$emptyItem->order_item_name = '';
									$emptyItem->order_status = '';
									$emptyItem->product_discountedPriceWithoutTax = '';
									$emptyItem->product_item_price = '';
									$emptyItem->product_basePriceWithTax = '';
									$emptyItem->product_final_price = '';
									$emptyItem->product_tax = '';
									$emptyItem->product_subtotal_discount = '';
									$emptyItem->product_subtotal_with_tax = '';
									$emptyItem->order_status = 'P';
									$emptyItem->linkedit = '';
									$emptyItem->tax_rule = 0;
									$emptyItem->tax_rule_id = array();
									$this->item = $emptyItem;
									?>
									<tr id="add-tmpl" class="removable row<?php echo $rowColor ?>">
										<?php echo $this->loadTemplate('item'); ?>
									</tr>
									<!--/table -->
									<input type="hidden" name="task" value=""/>
									<input type="hidden" name="option" value="com_virtuemart"/>
									<input type="hidden" name="view" value="orders"/>
									<input type="hidden" name="virtuemart_order_id"
											value="<?php echo $this->orderID; ?>"/>
									<input type="hidden" name="virtuemart_paymentmethod_id"
											value="<?php echo $this->orderbt->virtuemart_paymentmethod_id; ?>"/>
									<input type="hidden" name="virtuemart_shipmentmethod_id"
											value="<?php echo $this->orderbt->virtuemart_shipmentmethod_id; ?>"/>
									<input type="hidden" name="order_total"
											value="<?php echo $this->orderbt->order_total; ?>"/>
									<?php echo JHtml::_('form.token'); ?>
							</form> <!-- Update linestatus form -->
									<!--table class="adminlist" cellspacing="0" cellpadding="0" -->
							<tr>
						<td >
							<?php $editLineLink = JRoute::_('index.php?option=com_virtuemart&view=orders&orderId=' . $this->orderbt->virtuemart_order_id . '&orderLineId=0&tmpl=component&task=editOrderItem'); ?>
							<!-- <a href="<?php echo $editLineLink; ?>" class="modal">
							<?php echo JHtml::_('image', 'administrator/components/com_virtuemart/assets/images/icon_16/icon-16-editadd.png', "New Item"); ?>
				New Item </a>-->
						</td>
						<td class="uk-text-right@m" colspan="4">
							<div class=" uk-text-bold">
								<?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_SUBTOTAL') ?>:
							</div>
						</td>
						<td class="uk-text-right@m" ><?php echo $this->currency->priceDisplay($this->orderbt->order_subtotal); ?></td>
						<td class="uk-text-right@m" >&nbsp;</td>
						<td class="uk-text-right@m">&nbsp;</td>
						<td class="uk-text-right@m"><?php echo $this->currency->priceDisplay($this->orderbt->order_tax); ?></td>
						<td class="uk-text-right@m"> <?php echo $this->currency->priceDisplay($this->orderbt->order_discountAmount); ?></td>
						<td class="uk-text-right@m"><?php echo $this->currency->priceDisplay($this->orderbt->order_salesPrice); ?></td>
					</tr>
					<?php
					/* COUPON DISCOUNT */
					//if (VmConfig::get('coupons_enable') == '1') {
// 13 columns
					if ($this->orderbt->coupon_discount > 0 || $this->orderbt->coupon_discount < 0) {
						?>
						<tr>
							<td class="uk-text-bold" colspan="5"><?php echo vmText::_('COM_VIRTUEMART_COUPON_DISCOUNT') ?></td>
							<td class="">&nbsp;</td>
							<td class="">&nbsp;</td>
							<td class="">&nbsp;</td>
							<td class="">&nbsp;</td>
							<td class="">&nbsp;</td>
							<td class="uk-text-right@m">
								<?php
								echo $this->currency->priceDisplay($this->orderbt->coupon_discount); ?>
								<input class='orderEdit' type="text" size="8" name="coupon_discount"
										value="<?php echo $this->orderbt->coupon_discount; ?>"/>
							</td>
						</tr>
						<?php
						//}
					} ?>



					<?php
					foreach ($this->orderdetails['calc_rules'] as $rule) {
						if ($rule->calc_kind == 'DBTaxRulesBill') { ?>
							<tr>
								<td colspan="5" class=""><?php echo $rule->calc_rule_name ?> </td>
								<td class="" colspan="3"></td>

								<td class="">
									<!--
					<?php echo $this->currency->priceDisplay($rule->calc_amount); ?>
					<input class='orderEdit' type="text" size="8" name="calc_rules[<?php echo $rule->calc_kind ?>][<?php echo $rule->virtuemart_order_calc_rule_id ?>][calc_tax]" value="<?php echo $rule->calc_amount; ?>"/>
				-->
								</td>
								<td class="uk-text-right@m"><?php echo $this->currency->priceDisplay($rule->calc_amount); ?></td>
								<td class="uk-text-right@m">
									<?php echo $this->currency->priceDisplay($rule->calc_amount); ?>
									<input class='orderEdit' type="text" size="8"
											name="calc_rules[<?php echo $rule->calc_kind ?>][<?php echo $rule->virtuemart_order_calc_rule_id ?>]"
											value="<?php echo $rule->calc_amount; ?>"/>
								</td>
							</tr>
							<?php
						} elseif ($rule->calc_kind == 'taxRulesBill') { ?>
							<tr>
								<td colspan="5" class=""><?php echo $rule->calc_rule_name ?> </td>
								<td class="" colspan="3"></td>
								<td class="uk-text-right@m"><?php echo $this->currency->priceDisplay($rule->calc_amount); ?></td>
								<td class="uk-text-right@m"></td>
								<td class="uk-text-right@m">
									<?php echo $this->currency->priceDisplay($rule->calc_amount); ?>
									<input class='orderEdit' type="text" size="8"
											name="calc_rules[<?php echo $rule->calc_kind ?>][<?php echo $rule->virtuemart_order_calc_rule_id ?>]"
											value="<?php echo $rule->calc_amount; ?>"/>
								</td>
							</tr>
							<?php
						} elseif ($rule->calc_kind == 'DATaxRulesBill') { ?>
							<tr>
								<td colspan="5" class=""><?php echo $rule->calc_rule_name ?> </td>
								<td class="" colspan="3"></td>

								<td class=""></td>
								<td class="uk-text-right@m"><?php echo $this->currency->priceDisplay($rule->calc_amount); ?></td>
								<td class="uk-text-right@m">
									<?php echo $this->currency->priceDisplay($rule->calc_amount); ?>
									<input class='orderEdit' type="text" size="8"
											name="calc_rules[<?php echo $rule->calc_kind ?>][<?php echo $rule->virtuemart_order_calc_rule_id ?>]"
											value="<?php echo $rule->calc_amount; ?>"/>
								</td>
							</tr>

							<?php
						}

					}
					?>

					<tr>
						<td class="uk-text-bold" colspan="5">
							<?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_SHIPPING') ?>:
						</td>
						<td class="uk-text-right@m"><?php echo $this->currency->priceDisplay($this->orderbt->order_shipment); ?>
							<input class='orderEdit' type="text" size="8" name="order_shipment"
									value="<?php echo $this->orderbt->order_shipment; ?>"/>
						</td>
						<td class="">&nbsp;</td>
						<td class="">&nbsp;</td>
						<td class="uk-text-right@m"><?php echo $this->currency->priceDisplay($this->orderbt->order_shipment_tax); ?>
							<input class='orderEdit' type="text" size="12" name="order_shipment_tax"
									value="<?php echo $this->orderbt->order_shipment_tax; ?>"/>
						</td>
						<td class="">&nbsp;</td>
						<td class="uk-text-right@m"><?php echo $this->currency->priceDisplay($this->orderbt->order_shipment + $this->orderbt->order_shipment_tax); ?></td>

					</tr>
					<tr>
						<td class="uk-text-bold" colspan="5">
							<?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_PAYMENT') ?>:
						</td>
						<td class="uk-text-right@m">
							<?php echo $this->currency->priceDisplay($this->orderbt->order_payment); ?>
							<input class='orderEdit' type="text" size="8" name="order_payment"
									value="<?php echo $this->orderbt->order_payment; ?>"/>
						</td>
						<td class="">&nbsp;</td>
						<td class="">&nbsp;</td>
						<td class="uk-text-right@m">
							<?php echo $this->currency->priceDisplay($this->orderbt->order_payment_tax); ?>
							<input class='orderEdit' type="text" size="12" name="order_payment_tax"
									value="<?php echo $this->orderbt->order_payment_tax; ?>"/>
						</td>
						<td class="">&nbsp;</td>
						<td class="uk-text-right@m">
							<?php echo $this->currency->priceDisplay($this->orderbt->order_payment + $this->orderbt->order_payment_tax); ?>
						</td>

					</tr>
					<?php
					if (is_array($this->taxBill) and count($this->taxBill) != 1) {
						reset($this->taxBill);
						foreach ($this->taxBill as $rule) {
							if ($rule->calc_kind != 'taxRulesBill' and $rule->calc_kind != 'VatTax') {
								continue;
							}
							?>
							<tr>
							<td colspan="5" class=""><?php echo $rule->calc_rule_name ?> </td>
							<td class="" colspan="3"></td>
							<td class="uk-text-right@m">
								<?php echo $this->currency->priceDisplay($rule->calc_amount);
								/* <input class='orderEdit' type="text" size="8"
										name="calc_rules[<?php echo $rule->calc_kind ?>][<?php echo $rule->virtuemart_calc_id ?>]"
										value="<?php echo $rule->calc_amount; ?>"/>*/
								?>
							</td>
							<td class="" colspan="2"></td>
							</tr><?php
						}
					}

					?>
					<tr>
						<td class="uk-text-bold" colspan="5">
							<?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_TOTAL') ?>:
						</td>
						<td class="">&nbsp;</td>
						<td class="">&nbsp;</td>
						<td class="">&nbsp;</td>
						<td class="uk-text-right@m">
							<?php echo $this->currency->priceDisplay($this->orderbt->order_billTaxAmount); ?>
							<input class='orderEdit' type="text" size="12" name="order_billTaxAmount"
									value="<?php echo $this->orderbt->order_billTaxAmount; ?>"/>
							<span style="display: block; font-size: 80%;"
									title="<?php echo vmText::_('COM_VIRTUEMART_ORDER_EDIT_CALCULATE_DESC'); ?>">
								<input class='orderEdit' type="checkbox" name="calculate_billTaxAmount" value="1" checked/>
								<label class='orderEdit'
										for="calculate_billTaxAmount"><?php echo vmText::_('COM_VIRTUEMART_ORDER_EDIT_CALCULATE'); ?>
								</label>
							</span>
						</td>
						<td class="uk-text-bold uk-text-right@m">
							<?php echo $this->currency->priceDisplay($this->orderbt->order_billDiscountAmount); ?>
						</td>
						<td class="uk-text-bold uk-text-right@m">
							<?php echo $this->currency->priceDisplay($this->orderbt->order_total); ?>
						</td>
					</tr>

					<tr class="md-color-cyan-600">
						<td colspan="3" class="uk-text-left uk-text-bold">
							<?php echo vmText::_('COM_VM_ORDER_BALANCE') ?></td>

						<?php

						$tp = '';
						$detail = false;
						if (empty($this->orderbt->paid)) {
							$t = vmText::_('COM_VM_ORDER_UNPAID');
							/*echo '<td colspan="1"></td>';
							echo '<td align="left" colspan="2" >'.$t.'</td>';
							echo '<td><input class="orderEdit" type="text" size="8" name="paid" value="'.$this->orderbt->paid.'"/></td>';*/
							//echo '</tr>';
						} else {

							if (!$this->unequal) {
								$t = vmText::_('COM_VM_ORDER_PAID');
							} else {
								if ($this->unequal > 0.0) {
									$t = vmText::sprintf('COM_VM_ORDER_PARTIAL_PAID', $this->orderbt->paid);
									$detail = true;
								} else {
									$t = vmText::sprintf('COM_VM_ORDER_CREDIT_BALANCE', $this->orderbt->paid);
									$detail = true;
								}
							}
						}
						$trOpen = true;
						$colspan = '5';
						if (empty($this->toRefund) and !$detail) {
							echo '<td class="uk-text-left" colspan="2" >' . $t . '</td>';
							echo '<td class="uk-text-left" >' . $this->orderbt->paid_on . '</td>';
							echo '<td><input class="orderEdit" type="text" size="8" name="paid" value="' . $this->orderbt->paid . '"/></td>';
							echo '</tr>';
							$trOpen = false;
						}

						if (!empty($this->toRefund)) {
							echo '<td colspan="8">' . vmText::_('COM_VM_ORDER_PRODUCTS_TO_REFUND') . '</td>';
							if ($trOpen) {
								echo '</tr>';
								$trOpen = false;
							}
							foreach ($this->toRefund as $index => $item) {

								$tmpl = "refund-tmpl-" . $index;

								echo '<tr id="' . $tmpl . '" class="order-item ' . $rowColor . ' ">';
								echo '<td colspan="3"></td>';
								echo '<td colspan="3">' . $item->order_item_name . '</td>';
								echo '<td colspan="2">' . $item->order_item_sku . '</td>';
								echo '<td>' . $this->currency->priceDisplay($item->product_tax) . '</td>';
								echo '<td></td>';
								echo '<td>' . $this->currency->priceDisplay($item->product_subtotal_with_tax) . '</td>';
								echo '</tr>';
								$this->orderbt->order_total -= $item->product_subtotal_with_tax;
								$colspan1 = '5';
								$colspan2 = '5';
							}
						} else {
							$colspan1 = '3';
							$colspan2 = '4';
						}
						//$colspan = '3';
						if (!empty($this->toRefund) or $detail) {

							if ($this->unequal > 0.0) {

								if (empty($this->orderbt->paid)) {
									$t = vmText::_('COM_VM_ORDER_UNPAID');
								} else {
									$t = vmText::_('COM_VM_ORDER_PARTIAL_PAID');
								}
								$l = vmText::_('COM_VM_ORDER_OUTSTANDING_AMOUNT');

							} else {
								$t = vmText::_('COM_VM_ORDER_PAID');
								$l = vmText::_('COM_VM_ORDER_BALANCE');
							}
							$totalDiff = (int)$this->currency->truncate($this->orderbt->toPay - $this->orderbt->order_total);

							$tp .= '';
							if ($totalDiff) {
								if (!$trOpen) {
									$tp .= '<tr>';
									$trOpen = true;
								}
								$tp .= '<td colspan="' . $colspan1 . '"></td>';
								$tp .= '<td class="uk-text-left" colspan="' . $colspan2 . '" >' . vmText::_('COM_VM_ORDER_NEW_TOTAL') . '</td>';
								$tp .= '<td>' . $this->currency->priceDisplay($this->orderbt->toPay) . '</td>';

								if ($trOpen) {
									$tp .= '</tr>';
									$trOpen = false;
								}
							}

							if (!$trOpen) {
								$tp .= '<tr>';
								$trOpen = true;
							}
							$tp .= '<td colspan="' . $colspan1 . '"></td>';
							$tp .= '<td class="uk-text-left" colspan="' . $colspan2 . '" >' . $t . '</td>';

							$tp .= '<td>' . $this->currency->priceDisplay($this->orderbt->paid) . '<input class="orderEdit" type="text" size="8" name="paid" value="' . $this->orderbt->paid . '"/></td>';
							//$tp .= '<td align="left" >'.$this->orderbt->paid_on.'</td>';
							$tp .= '</tr>';

							$tp .= '<tr>';
							$tp .= '<td colspan="5"></td>';
							$tp .= '<td class="" colspan="5" >' . $l . '</td>';
							$tp .= '<td class="" >' . $this->currency->priceDisplay(abs($this->orderbt->order_total - $this->orderbt->paid)) . '</td>';
							echo $tp;
						}
						if ($trOpen) {
							echo '</tr>';
							$trOpen = false;
						}

						if ($this->orderbt->user_currency_rate != 1.0) { ?>
					<tr>
						<td class="" colspan="5">
							<em><?php echo vmText::_('COM_VIRTUEMART_ORDER_USER_CURRENCY_RATE') ?>:</em>
						</td>
						<td class="">&nbsp;</td>
						<td class="">&nbsp;</td>
						<td class="">&nbsp;</td>
						<td class="">&nbsp;</td>
						<td class="">&nbsp;</td>
						<td class="">
							<em><?php echo $this->orderbt->user_currency_rate ?></em>
						</td>
					</tr>
				<?php }
				?>
				</table>
				</td>
				</tr>
				</table>

			</div>
		</div>
	</div>
</div>

