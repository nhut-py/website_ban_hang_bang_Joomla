<?php
/**
 *
 * @package    VirtueMart
 * @subpackage coupon
 * @author RickG, Max Milbers
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
vmuikitAdminUIHelper::imitateTabs('start', 'COM_VIRTUEMART_COUPON_DETAILS');
?>

	<div class="uk-card   uk-card-small uk-card-vm ">
		<div class="uk-card-header">
			<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: gift-box; ratio: 1.2"></span>
				<?php echo vmText::_('COM_VIRTUEMART_COUPON_DETAILS') ?>
			</div>
		</div>
		<div class="uk-card-body">

				<form action="index.php" method="post" name="adminForm" id="adminForm" class="uk-form-horizontal">


					<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_COUPON', 'coupon_code', $this->coupon->coupon_code, 'class="required"', '', 20, 32); ?>
					<?php echo VmuikitHtml::row('checkbox', 'COM_VIRTUEMART_PUBLISHED', 'published', $this->coupon->published); ?>
					<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_VALUE', 'coupon_value', $this->coupon->coupon_value, 'class="required"', '', 10, 32); ?>

					<?php
					$radioOptions = array();
					$radioOptions[] = JHtml::_('select.option', 'percent', vmText::_('COM_VIRTUEMART_COUPON_PERCENT'));
					$radioOptions[] = JHtml::_('select.option', 'total', vmText::_('COM_VIRTUEMART_COUPON_TOTAL'));
					echo VmuikitHtml::row('radio', 'COM_VIRTUEMART_COUPON_PERCENT_TOTAL', 'percent_or_total', $radioOptions, $this->coupon->percent_or_total); ?>
					<?php
					$listOptions = array();
					$listOptions[] = JHtml::_('select.option', 'permanent', vmText::_('COM_VIRTUEMART_COUPON_TYPE_PERMANENT'));
					$listOptions[] = JHtml::_('select.option', 'gift', vmText::_('COM_VIRTUEMART_COUPON_TYPE_GIFT'));
					echo VmuikitHtml::row('select', 'COM_VIRTUEMART_COUPON_TYPE', 'coupon_type', $listOptions, $this->coupon->coupon_type, '', 'value', 'text', false); ?>
					<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_COUPON_VALUE_VALID_AT', 'coupon_value_valid', $this->coupon->coupon_value_valid, 'class="inputbox"', '', 10, 255, ' ' . $this->vendor_currency); ?>

					<?php /* Malik Coupon */
					echo VmuikitHtml::row('input', 'Maximum Discount Threshold', 'coupon_value_max', $this->coupon->coupon_value_max, 'class="inputbox"', '', 10, 255, ' ' . $this->vendor_currency);
					?>
					<?php
					echo VmuikitHtml::row('input', 'Maximum Allowable Coupon Usage per User', 'virtuemart_coupon_max_attempt_per_user', $this->coupon->virtuemart_coupon_max_attempt_per_user, 'class="inputbox"', '', 10, 255, ' ');
					?>

					<div class="uk-clearfix">
						<label class="uk-form-label" for="virtuemart_shoppergroup_id">
							<?php echo "Allowed Shoppers"; ?>
						</label>
						<div class="uk-form-controls">

							<?php echo $this->lists['vmusers']; ?>
						</div>
					</div>

					<div class="uk-clearfix">
						<label class="uk-form-label" for="virtuemart_shoppergroup_id">
							<?php echo "Exclude Shopper Groups"; ?>
						</label>
						<div class="uk-form-controls">
							<?php echo $this->lists['shoppergroups']; ?>
						</div>
					</div>

					<div class="uk-clearfix">
						<label class="uk-form-label" for="virtuemart_shoppergroup_id">
							<?php echo "Allowed Products"; ?>
						</label>
						<div class="uk-form-controls">
							<?php echo $this->lists['products']; ?>
						</div>
					</div>

					<div class="uk-clearfix">
						<label class="uk-form-label" for="virtuemart_shoppergroup_id">
							<?php echo "Allowed Product Categories"; ?>
						</label>
						<div class="uk-form-controls">
							<?php echo $this->lists['productcategories']; ?>
						</div>
					</div>

					<?php echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_COUPON_START', vmJsApi::jDate($this->coupon->coupon_start_date, 'coupon_start_date')); ?>
					<?php echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_COUPON_EXPIRY', vmJsApi::jDate($this->coupon->coupon_expiry_date, 'coupon_expiry_date')); ?>
					<?php if ($this->showVendors()) {
						echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_VENDOR', $this->vendorList);
					}
					?>


					<input type="hidden" name="virtuemart_coupon_id"
							value="<?php echo $this->coupon->virtuemart_coupon_id; ?>"/>

					<?php echo $this->addStandardHiddenToForm(); ?>
				</form>


		</div>

	</div>


<?php
vmuikitAdminUIHelper::imitateTabs('end');
vmuikitAdminUIHelper::endAdminArea();
?>