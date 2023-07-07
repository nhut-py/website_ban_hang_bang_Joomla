<?php
/**
 *
 * Description
 *
 * @package    VirtueMart
 * @subpackage Paymentmethod
 * @author Max Milbers
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: edit_edit.php 10438 2021-01-22 07:18:16Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
?>

<div class="uk-card   uk-card-small uk-card-vm ">
	<div class="uk-card-header">
		<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: credit-card; ratio: 1.2"></span>
			<?php echo vmText::_('COM_VIRTUEMART_ADMIN_PAYMENT_FORM') ?>
		</div>
	</div>
	<div class="uk-card-body">

		<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_PAYMENTMETHOD_FORM_NAME', 'payment_name', $this->payment->payment_name, 'class="required"'); ?>
		<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_SLUG', 'slug', $this->payment->slug); ?>
		<?php echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_PUBLISHED', 'published', $this->payment->published); ?>
		<?php echo VmuikitHtml::row('textarea', 'COM_VIRTUEMART_PAYMENT_FORM_DESCRIPTION', 'payment_desc', $this->payment->payment_desc,'class="uk-textarea"', 80); ?>
		<?php echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_PAYMENT_CLASS_NAME', $this->vmPPaymentList);

		if ($this->checkConditionsCore) {
			echo VmuikitHtml::row('input', 'COM_VM_METHD_MIN_AMOUNT', 'min_amount', $this->payment->min_amount);
			echo VmuikitHtml::row('input', 'COM_VM_METHD_MAX_AMOUNT', 'max_amount', $this->payment->max_amount);
		}

		echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_SHIPPING_FORM_SHOPPER_GROUP', $this->shopperGroupList);


		if ($this->checkConditionsCore) {

			$raw = '<select class="inputbox multiple" id="categories" name="categories[]" multiple="multiple" size="10">
                ' . ShopFunctions::categoryListTree($this->payment->categories) . '
            </select>';
			echo VmuikitHtml::row('raw', 'COM_VM_CATEGORIES', $raw);

			$raw = '<select class="inputbox multiple" id="blocking_categories" name="blocking_categories[]" multiple="multiple" size="10">
                ' . ShopFunctions::categoryListTree($this->payment->blocking_categories) . '
            </select>';

			echo VmuikitHtml::row('raw', 'COM_VM_CATEGORIES_BLOCKING', $raw);

			echo VmuikitHtml::row('raw', 'COM_VM_COUNTRIES', ShopFunctionsF::renderCountryList($this->payment->countries, True, array(), '', 0, 'countries', 'countries'));
			echo VmuikitHtml::row('raw', 'COM_VM_COUNTRIES_BLOCKING', ShopFunctionsF::renderCountryList($this->payment->blocking_countries, True, array(), '', 0, 'blocking_countries', 'blocking_countries'));
			echo VmuikitHtml::row('raw', 'COM_VM_SHIPMENTS', $this->shipmentList);
			echo VmuikitHtml::row('checkbox', 'COM_VM_ENABLE_BY_COUPON', 'byCoupon', $this->payment->byCoupon);
			echo VmuikitHtml::row('input', 'COM_VM_ENABLE_BY_COUPON_BY_CODE', 'couponCode', $this->payment->couponCode);
		}

		echo VmuikitHtml::row('input', 'COM_VIRTUEMART_LIST_ORDER', 'ordering', $this->payment->ordering, 'class="inputbox"', '', 4, 4); ?>
		<?php echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_CURRENCY', $this->currencyList); ?>
		<?php
		if ($this->showVendors()) {
			echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_VENDOR', $this->vendorList);
		}
		if ($this->showVendors) {
			echo VmuikitHtml::row('checkbox', 'COM_VIRTUEMART_SHARED', 'shared', $this->payment->shared);
		}
		?>

	</div>
</div>