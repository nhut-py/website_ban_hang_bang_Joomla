<fieldset class="vm-fieldset-pricelist margin-top">
	<table class="cart-summary table table-bordered">
		<tr class="vm-head-row">
			<th class="text-left"><?php echo vmText::_ ('COM_VIRTUEMART_CART_NAME') ?></th>
			<th class="text-left vm-cart-hide"><?php echo vmText::_ ('COM_VIRTUEMART_CART_SKU') ?></th>
			<th><?php echo vmText::_ ('COM_VIRTUEMART_CART_PRICE') ?></th>
			<th class="text-center">
			<?php echo vmText::_ ('COM_VIRTUEMART_CART_QUANTITY') ?>
			/ <?php echo vmText::_ ('COM_VIRTUEMART_CART_ACTION') ?>
			</th>
			<?php if (VmConfig::get ('show_tax')) { ?>
			<th class="text-center vm-cart-hide"><span class="priceColor2"><?php echo vmText::_ ('COM_VIRTUEMART_CART_SUBTOTAL_TAX_AMOUNT'); ?></span></th>
			<?php } ?>
			<th class="text-center vm-cart-hide">
				<span class="priceColor2"><?php echo vmText::_ ('COM_VIRTUEMART_CART_SUBTOTAL_DISCOUNT_AMOUNT'); ?></span>
			</th>
			<th class="text-right"><?php echo vmText::_ ('COM_VIRTUEMART_CART_TOTAL') ?></th>
		</tr>

		<?php
		$i = 1;

		foreach ($this->cart->products as $pkey => $prow) { ?>
    <input type="hidden" name="cartpos[]" value="<?php echo $pkey ?>" />
		<tr valign="top" class="sectiontableentry<?php echo $i; if(!empty($prow->class)) echo ' '.$prow->class ?>">
			<td class="text-left">
				<?php if ($prow->virtuemart_media_id) { ?>
				<span class="cart-images">
				<?php
					if (!empty($prow->images[0])) {
						echo $prow->images[0]->displayMediaThumb ('width="60px"', FALSE);
					}
				?>
				</span>
				<?php } ?>
				<?php echo JHtml::link ($prow->url, $prow->product_name); ?>
				<div class="small">
	      	<?php	echo $this->customfieldsModel->CustomsFieldCartDisplay ($prow);	?>
				</div>
			</td>
			<td class="text-left vm-cart-hide"><?php echo $prow->product_sku ?></td>
			<td class="text-right priceCol">
				<?php
				if ($prow->prices['discountAmount'] != -0) {
				?>
				<div class="line-through text-muted"><?php echo $this->currencyDisplay->createPriceDiv ('basePriceWithTax', '', $prow->prices, TRUE, FALSE); ?></div>
	      <?php
				}
				echo $this->currencyDisplay->createPriceDiv ('salesPrice', '', $prow->prices, TRUE);
				?>
			</td>
			<td class="text-center">
			<?php
				if ($prow->step_order_level) {
					$step=$prow->step_order_level;
				} else {
					$step=1;
				}
				if ($step==0) {
					$step=1;
				}
			?>
				<input class="form-control" type="text"
				onblur="Virtuemart.checkQuantity(this,<?php echo $step?>,'<?php echo vmText::_ ('COM_VIRTUEMART_WRONG_AMOUNT_ADDED',true)?>');"
				onclick="Virtuemart.checkQuantity(this,<?php echo $step?>,'<?php echo vmText::_ ('COM_VIRTUEMART_WRONG_AMOUNT_ADDED',true)?>');"
				onchange="Virtuemart.checkQuantity(this,<?php echo $step?>,'<?php echo vmText::_ ('COM_VIRTUEMART_WRONG_AMOUNT_ADDED',true)?>');"
				onsubmit="Virtuemart.checkQuantity(this,<?php echo $step?>,'<?php echo vmText::_ ('COM_VIRTUEMART_WRONG_AMOUNT_ADDED',true)?>');"
			  title="<?php echo  vmText::_('COM_VIRTUEMART_CART_UPDATE') ?>" class="quantity-input js-recalculate" size="3" maxlength="4" name="quantity[<?php echo $pkey; ?>]" value="<?php echo $prow->quantity ?>" />

				<div class="margin-top-15">
					<button type="submit" class="vmicon vm2-add_quantity_cart btn btn-primary btn-sm" name="updatecart.<?php echo $pkey ?>" title="<?php echo  vmText::_ ('COM_VIRTUEMART_CART_UPDATE') ?>" data-dynamic-update="1">
          	<span class="glyphicon glyphicon-refresh"></span>
					</button>
					<button type="submit" class="vmicon vm2-remove_from_cart btn btn-default btn-sm" name="delete.<?php echo $pkey ?>" title="<?php echo vmText::_ ('COM_VIRTUEMART_CART_DELETE') ?>">
          	<span class="glyphicon glyphicon-remove"></span>
					</button>
        </div>
			</td>

			<?php if (VmConfig::get ('show_tax')) { ?>
			<td class="text-right priceCol vm-cart-hide">
				<div class="priceColor2"><?php echo $this->currencyDisplay->createPriceDiv ('taxAmount', '', $prow->prices, TRUE, FALSE, $prow->quantity); ?></div>
			</td>
			<?php } ?>
			<td class="text-right priceCol vm-cart-hide">
				<div class="priceColor2"><?php echo $this->currencyDisplay->createPriceDiv ('discountAmount', '', $prow->prices, TRUE, FALSE, $prow->quantity) ?></div>
			</td>
			<td class="text-right priceCol">
				<?php
				if ($prow->prices['discountAmount'] != -0) {
	      ?>
				  <div class="line-through text-muted"><?php echo $this->currencyDisplay->createPriceDiv ('basePriceWithTax', '', $prow->prices, TRUE, FALSE, $prow->quantity); ?></div>
	      <?php }
				echo $this->currencyDisplay->createPriceDiv ('salesPrice', '', $prow->prices, TRUE, FALSE, $prow->quantity);
				?>
			</td>
		</tr>
		<!-- End Products -->
			<?php
			$i = ($i==1) ? 2 : 1;
		} ?>
		<!--Begin of SubTotal, Tax, Shipment, Coupon Discount and Total listing -->
		<?php if (VmConfig::get ('show_tax')) {
			$colspan = 3;
		} else {
			$colspan = 2;
		} ?>

		<tr class="sectiontableentry1 vm-pricetotal-row vm-cart-hide">
			<td colspan="4" class="text-right bold"><?php echo vmText::_ ('COM_VIRTUEMART_ORDER_PRINT_PRODUCT_PRICES_TOTAL'); ?></td>
			<?php if (VmConfig::get ('show_tax')) { ?>
			<td class="text-right priceCol">
				<div class="priceColor2"><?php echo $this->currencyDisplay->createPriceDiv ('taxAmount', '', $this->cart->cartPrices, TRUE); ?></div>
			</td>
			<?php } ?>
			<td class="text-right priceCol">
				<div class="priceColor2"><?php echo $this->currencyDisplay->createPriceDiv ('discountAmount', '', $this->cart->cartPrices, TRUE); ?></div>
			</td>
			<td class="text-right priceCol"><?php echo $this->currencyDisplay->createPriceDiv ('salesPrice', '', $this->cart->cartPrices, TRUE) ?></td>
		</tr>

		<?php
		if (VmConfig::get ('coupons_enable')) {
		?>

		<tr class="sectiontableentry2 vm-coupon-row">
			<td colspan="4" class="text-center">
			  <div class="col-xs-8">
				<?php if (!empty($this->layoutName) && $this->layoutName == $this->cart->layout) {
					echo $this->loadTemplate ('coupon');
				}	?>
	      </div>
				<div class="col-xs-4 text-right">
				<?php if (!empty($this->cart->cartData['couponCode'])) { ?>
	      	<span class="label label-success">
					<?php
					echo $this->cart->cartData['couponCode'];
					echo $this->cart->cartData['couponDescr'] ? (' (' . $this->cart->cartData['couponDescr'] . ')') : '';
				}	?>
					</span>
				</div>
			</td>
      <?php if (!empty($this->cart->cartData['couponCode'])) { ?>
			<?php if (VmConfig::get ('show_tax')) {	?>
			<td class="text-right priceCol vm-cart-hide"><?php echo $this->currencyDisplay->createPriceDiv ('couponTax', '', $this->cart->cartPrices['couponTax'], TRUE); ?></td>
			<?php } ?>
			<td class="vm-cart-hide"></td>
			<td class="text-right priceCol vm-cart-hide"><?php echo $this->currencyDisplay->createPriceDiv ('salesPriceCoupon', '', $this->cart->cartPrices['salesPriceCoupon'], TRUE); ?></td>
			<?php } else { ?>
			<td colspan="<?php if (VmConfig::get ('show_tax')) echo '3'; else echo '2'; ?>" class="vm-cart-hide">&nbsp;</td>
			<?php	} ?>
		</tr>

		<?php }
		foreach ($this->cart->cartData['DBTaxRulesBill'] as $rule) {
		?>

		<tr class="sectiontableentry<?php echo $i ?> vm-cart-hide">
			<td colspan="4" class="text-right"><?php echo vmText::_($rule['calc_name']) ?></td>
			<?php if (VmConfig::get ('show_tax')) { ?>
			<td class="text-right"></td>
			<?php } ?>
			<td class="text-right priceCol"><?php echo $this->currencyDisplay->createPriceDiv ($rule['virtuemart_calc_id'] . 'Diff', '', $this->cart->cartPrices[$rule['virtuemart_calc_id'] . 'Diff'], TRUE); ?></td>
			<td class="text-right priceCol"><?php echo $this->currencyDisplay->createPriceDiv ($rule['virtuemart_calc_id'] . 'Diff', '', $this->cart->cartPrices[$rule['virtuemart_calc_id'] . 'Diff'], TRUE); ?></td>
		</tr>
			<?php
			if ($i) {
				$i = 1;
			} else {
				$i = 0;
			}
		} ?>

		<?php
		foreach ($this->cart->cartData['taxRulesBill'] as $rule) {
			if($rule['calc_value_mathop']=='avalara') continue;
		?>

		<tr class="sectiontableentry<?php echo $i ?> vm-cart-hide">
			<td colspan="4" class="text-right"><?php echo vmText::_($rule['calc_name']) ?></td>
			<?php if (VmConfig::get ('show_tax')) { ?>
			<td class="text-right priceCol"><?php echo $this->currencyDisplay->createPriceDiv ($rule['virtuemart_calc_id'] . 'Diff', '', $this->cart->cartPrices[$rule['virtuemart_calc_id'] . 'Diff'], TRUE); ?></td>
			<?php } ?>
			<td class="text-right"></td>
			<td class="text-right priceCol"><?php echo $this->currencyDisplay->createPriceDiv ($rule['virtuemart_calc_id'] . 'Diff', '', $this->cart->cartPrices[$rule['virtuemart_calc_id'] . 'Diff'], TRUE); ?></td>
		</tr>
			<?php
			if ($i) {
				$i = 1;
			} else {
				$i = 0;
			}
		}

		foreach ($this->cart->cartData['DATaxRulesBill'] as $rule) {

		?>

		<tr class="sectiontableentry<?php echo $i ?> vm-cart-hide">
			<td colspan="4" class="text-right"><?php echo   vmText::_($rule['calc_name']) ?></td>
			<?php if (VmConfig::get ('show_tax')) { ?>
			<td class="text-right"></td>
			<?php } ?>
			<td class="text-right priceCol"><?php echo $this->currencyDisplay->createPriceDiv ($rule['virtuemart_calc_id'] . 'Diff', '', $this->cart->cartPrices[$rule['virtuemart_calc_id'] . 'Diff'], TRUE); ?></td>
			<td class="text-right priceCol"><?php echo $this->currencyDisplay->createPriceDiv ($rule['virtuemart_calc_id'] . 'Diff', '', $this->cart->cartPrices[$rule['virtuemart_calc_id'] . 'Diff'], TRUE); ?></td>
		</tr>
			<?php
			if ($i) {
				$i = 1;
			} else {
				$i = 0;
			}
		} ?>

		<?php
		if ( 	VmConfig::get('oncheckout_opc',true) or
			!VmConfig::get('oncheckout_show_steps',false) or
			(!VmConfig::get('oncheckout_opc',true) and VmConfig::get('oncheckout_show_steps',false) and
				!empty($this->cart->virtuemart_shipmentmethod_id) )
			)
		{ ?>
		<tr class="sectiontableentry1 vm-shipment-row">
			<?php if (!$this->cart->automaticSelectedShipment) { ?>
				<td colspan="4">
	        <span class="bold"><?php	echo vmText::_ ('COM_VIRTUEMART_CART_SELECTED_SHIPMENT'); ?> :</span>
	        <?php
						echo '<span class="label label-success bold">' . $this->cart->cartData['shipmentName'] . '</span>';
	          echo '<hr>';
						if (!empty($this->layoutName) and $this->layoutName == $this->cart->layout) {
							if (VmConfig::get('oncheckout_opc', 0)) {
								$previouslayout = $this->setLayout('select');
								echo $this->loadTemplate('shipment');
								$this->setLayout($previouslayout);
							} else {
								echo JHtml::_('link', JRoute::_('index.php?option=com_virtuemart&view=cart&task=edit_shipment', $this->useXHTML, $this->useSSL), '<span class="glyphicon glyphicon-arrow-right"></span> ' . $this->select_shipment_text, 'class="btn btn-primary btn-block btn-xs"');
							}
						} else {
							echo vmText::_ ('COM_VIRTUEMART_CART_SHIPPING');
						}
          ?>
				</td>
			<?php } else { ?>
			<td colspan="4">
			 <span class="bold"><?php echo vmText::_ ('COM_VIRTUEMART_CART_SELECTED_SHIPMENT'); ?> :</span>
				<?php echo $this->cart->cartData['shipmentName']; ?>
			</td>
			<?php } ?>

			<?php if (VmConfig::get ('show_tax')) { ?>
			<td class="text-right priceCol vm-cart-hide">
				<div class="priceColor2"><?php echo $this->currencyDisplay->createPriceDiv ('shipmentTax', '', $this->cart->cartPrices['shipmentTax'], TRUE); ?></div>
			</td>
			<?php } ?>
			<td class="text-right priceCol vm-cart-hide"><?php if($this->cart->cartPrices['salesPriceShipment'] < 0) echo $this->currencyDisplay->createPriceDiv ('salesPriceShipment', '', $this->cart->cartPrices['salesPriceShipment'], TRUE); ?></td>
			<td class="text-right priceCol vm-cart-hide"><?php echo $this->currencyDisplay->createPriceDiv ('salesPriceShipment', '', $this->cart->cartPrices['salesPriceShipment'], TRUE); ?></td>
		</tr>

		<?php } ?>

		<?php
		if ($this->cart->pricesUnformatted['salesPrice']>0.0 and
			( 	VmConfig::get('oncheckout_opc',true) or
				!VmConfig::get('oncheckout_show_steps',false) or
				( (!VmConfig::get('oncheckout_opc',true) and VmConfig::get('oncheckout_show_steps',false) ) and !empty($this->cart->virtuemart_paymentmethod_id))
			)
			)
		{ ?>
		<tr class="sectiontableentry1 vm-payment-row">
			<?php if (!$this->cart->automaticSelectedPayment) { ?>
			<td colspan="4">
				<span class="bold"><?php echo vmText::_ ('COM_VIRTUEMART_CART_SELECTED_PAYMENT'); ?> :</span>

				<?php
				echo '<span class="label label-success bold">' . $this->cart->cartData['paymentName'] . '</span>';
	      echo '<hr>';
				if (!empty($this->layoutName) && $this->layoutName == $this->cart->layout) {
					if (VmConfig::get('oncheckout_opc', 0)) {
						$previouslayout = $this->setLayout('select');
						echo $this->loadTemplate('payment');
						$this->setLayout($previouslayout);
					} else {
						echo JHtml::_('link', JRoute::_('index.php?option=com_virtuemart&view=cart&task=editpayment', $this->useXHTML, $this->useSSL), '<span class="glyphicon glyphicon-arrow-right"></span> ' .$this->select_payment_text, 'class="btn btn-primary btn-block btn-xs"');
					}
				} else {
				echo vmText::_ ('COM_VIRTUEMART_CART_PAYMENT');
				} ?>
			</td>

			<?php } else { ?>

			<td colspan="4">
				<span class="bold"><?php echo vmText::_ ('COM_VIRTUEMART_CART_SELECTED_PAYMENT'); ?> :</span>
				<?php echo $this->cart->cartData['paymentName']; ?>
			</td>
			<?php } ?>
			<?php if (VmConfig::get ('show_tax')) { ?>
			<td class="text-right priceCol vm-cart-hide">
				<div class="priceColor2"><?php echo $this->currencyDisplay->createPriceDiv ('paymentTax', '', $this->cart->cartPrices['paymentTax'], TRUE); ?></div>
			</td>
			<?php } ?>
			<td class="text-right priceCol vm-cart-hide"><?php if($this->cart->cartPrices['salesPricePayment'] < 0) echo $this->currencyDisplay->createPriceDiv ('salesPricePayment', '', $this->cart->cartPrices['salesPricePayment'], TRUE); ?></td>
			<td class="text-right priceCol vm-cart-hide"><?php echo $this->currencyDisplay->createPriceDiv ('salesPricePayment', '', $this->cart->cartPrices['salesPricePayment'], TRUE); ?></td>
		</tr>
		<?php  } ?>

		<tr class="sectiontableentry2 vm-carttotal-row vm-cart-hide">
			<td colspan="4" class="text-right"><strong><?php echo vmText::_ ('COM_VIRTUEMART_CART_TOTAL') ?>:</strong></td>
			<?php if (VmConfig::get ('show_tax')) { ?>
			<td class="text-right priceCol">
				<div class="priceColor2"><?php echo $this->currencyDisplay->createPriceDiv ('billTaxAmount', '', $this->cart->cartPrices['billTaxAmount'], TRUE); ?></div>
			</td>
			<?php } ?>
			<td class="text-right priceCol">
				<div class="priceColor2"><?php echo $this->currencyDisplay->createPriceDiv ('billDiscountAmount', '', $this->cart->cartPrices['billDiscountAmount'], TRUE); ?></div>
			</td>
			<td class="text-right priceCol bold"><?php echo $this->currencyDisplay->createPriceDiv ('billTotal', '', $this->cart->cartPrices['billTotal'], TRUE); ?></td>
		</tr>

		<?php
		if ($this->totalInPaymentCurrency) {
		?>

		<tr class="sectiontableentry2 vm-carttotalpayment-row vm-cart-hide">
			<td colspan="4" class="text-right"><?php echo vmText::_ ('COM_VIRTUEMART_CART_TOTAL_PAYMENT') ?>:</td>
			<?php if (VmConfig::get ('show_tax')) { ?>
			<td class="text-right"></td>
			<?php } ?>
			<td class="text-right"></td>
			<td class="text-right priceCol bold"><?php echo $this->totalInPaymentCurrency; ?></td>
		</tr>

		<?php }	?>
	</table>

	<table class="vm-mobile-total table table-striped">
    	<!-- COUPON -->
		<tr>
			<td class="vm-mobile-td text-right"><?php echo vmText::_ ('COM_VIRTUEMART_COUPON_DISCOUNT'); ?>:</td>
			<td class="priceCol text-right">
      	<?php echo $this->currencyDisplay->createPriceDiv ('salesPriceCoupon', '', $this->cart->cartPrices['salesPriceCoupon'], TRUE); ?>
			</td>
		</tr>
			<!--SHIPMENT-->
		<tr>
			<td class="vm-mobile-td text-right"><?php echo vmText::_ ('COM_VIRTUEMART_CART_SHIPPING'); ?>:</td>
			<td class="priceCol text-right"><?php echo $this->currencyDisplay->createPriceDiv ('salesPriceShipment', '', $this->cart->cartPrices['salesPriceShipment'], TRUE); ?></td>
		</tr>
			<!--PAYMENT-->
		<tr>
			<td class="vm-mobile-td text-right"><?php echo vmText::_ ('COM_VIRTUEMART_CART_PAYMENT'); ?>:</td>
			<td class="priceCol text-right"><?php echo $this->currencyDisplay->createPriceDiv ('salesPricePayment', '', $this->cart->cartPrices['salesPricePayment'], TRUE); ?></td>
    </tr>
			<!--DISCOUNT-->
		<?php if (!empty($this->cart->cartPrices['billDiscountAmount'])) { ?>
    <tr>
			<td class="vm-mobile-td text-right"><?php echo vmText::_ ('COM_VIRTUEMART_CART_SUBTOTAL_DISCOUNT_AMOUNT'); ?>:</td>
			<td class="priceCol text-right">
				<div class="priceColor2"><?php echo $this->currencyDisplay->createPriceDiv ('billDiscountAmount', '', $this->cart->cartPrices['billDiscountAmount'], TRUE); ?></div>
			</td>
    </tr>
		<?php } ?>
		  <!--TAX-->
		<?php if (VmConfig::get ('show_tax')) { ?>
    <tr>
			<td class="vm-mobile-td text-right"><?php echo vmText::_ ('COM_VIRTUEMART_CART_SUBTOTAL_TAX_AMOUNT'); ?>:</td>
			<td class="priceCol text-right">
				<div class="priceColor2"><?php echo $this->currencyDisplay->createPriceDiv ('billTaxAmount', '', $this->cart->cartPrices['billTaxAmount'], TRUE); ?></div>
			</td>
    </tr>
		<?php } ?>
      <!--TOTAL-->
		<tr>
			<td class="vm-mobile-td text-right bold"><?php echo vmText::_ ('COM_VIRTUEMART_CART_TOTAL') ?>:</td>
			<td class="priceCol text-right bold"><?php echo $this->currencyDisplay->createPriceDiv ('billTotal', '', $this->cart->cartPrices['billTotal'], TRUE); ?></td>
    </tr>
	</table>
</fieldset>