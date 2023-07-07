<?php
/**
 *
 * Modify user form view, User info
 *
 * @package    VirtueMart
 * @subpackage User
 * @author Oscar van Eijk
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: edit_vendor.php 10396 2021-01-11 11:35:30Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
if (!vmAccess::manager('user.editshop')) {
	?>
	<div><?php echo vmText::_('COM_VM_PERM_MISSING_VENDOR'); ?></div> <?php
}
?>
<div class="uk-grid-match uk-grid-small uk-child-width-1-1" uk-grid>
	<div>
		<div class="uk-card   uk-card-small uk-card-vm ">
			<div class="uk-card-header">
				<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: shop; ratio: 1.2"></span>
					<?php echo vmText::_('COM_VIRTUEMART_VENDOR_FORM_INFO_LBL') ?>
				</div>
			</div>
			<div class="uk-card-body">
				<?php
				echo VmuikitHtml::row('input', 'COM_VIRTUEMART_STORE_FORM_COMPANY_NAME', 'vendor_name', $this->vendor->vendor_name);
				echo VmuikitHtml::row('input', 'COM_VIRTUEMART_STORE_FORM_STORE_NAME', 'vendor_store_name', $this->vendor->vendor_store_name);
				echo VmuikitHtml::row('input', 'COM_VIRTUEMART_PRODUCT_FORM_URL', 'vendor_url', $this->vendor->vendor_url);
				echo VmuikitHtml::row('input', 'COM_VIRTUEMART_STORE_FORM_MPOV', 'vendor_min_pov', $this->vendor->vendor_min_pov);
				if (VmConfig::get('multix', 'none') != 'none' and vmAccess::manager('managevendors')) {
					echo VmuikitHtml::row('input', 'COM_VIRTUEMART_MAX_CATS_PER_PRODUCT', 'max_cats_per_product', $this->vendor->max_cats_per_product);
					echo VmuikitHtml::row('input', 'COM_VIRTUEMART_MAX_PRODUCTS', 'max_products', $this->vendor->max_products);
					echo VmuikitHtml::row('input', 'COM_VIRTUEMART_MAX_CUSTOMERS', 'max_customers', $this->vendor->max_customers);
					echo VmuikitHtml::row('input', 'COM_VIRTUEMART_FORCE_PRODUCT_PATTERN', 'force_product_pattern', $this->vendor->force_product_pattern);
				}
				?>
			</div>
		</div>
	</div>

	<div>
		<div class="uk-card   uk-card-small uk-card-vm">
			<div class="uk-card-header">
				<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: currencies; ratio: 1.2"></span>
					<?php echo vmText::_('COM_VIRTUEMART_STORE_CURRENCY_DISPLAY'); ?>
				</div>
			</div>
			<div class="uk-card-body">

				<?php
				echo VmuikitHtml::row('genericlist', 'COM_VIRTUEMART_CURRENCY', $this->currencies, 'vendor_currency', '', 'virtuemart_currency_id', 'currency_name', $this->vendor->vendor_currency, 'vendor_currency', true);
				echo VmuikitHtml::row('genericlist', 'COM_VIRTUEMART_STORE_FORM_ACCEPTED_CURRENCIES', $this->currencies, 'vendor_accepted_currencies[]', 'size=10 multiple="multiple" data-placeholder="' . vmText::_('COM_VIRTUEMART_DRDOWN_SELECT_SOME_OPTIONS') . '"', 'virtuemart_currency_id', 'currency_name', $this->vendor->vendor_accepted_currencies, 'vendor_accepted_currencies', true);
				?>


			</div>
		</div>
	</div>
	<div>
		<?php
		echo VmuikitMediaHandler::displayFilesHandler($this->vendor->images[0], $this->vendor->virtuemart_media_id, 'vendor', $this->vendor->virtuemart_vendor_id);
		?>
	</div>

	<div>
		<div class="uk-card   uk-card-small uk-card-vm">
			<div class="uk-card-header">
				<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: info; ratio: 1.2"></span>
					<?php echo vmText::_('COM_VIRTUEMART_STORE_FORM_DESCRIPTION'); ?>
				</div>
			</div>
			<div class="uk-card-body">
				<?php echo $this->editor->display('vendor_store_desc', $this->vendor->vendor_store_desc, '100%', 200, 70, 15) ?>
			</div>
		</div>
	</div>
	<div>
		<div class="uk-card   uk-card-small uk-card-vm">
			<div class="uk-card-header">
				<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: home; ratio: 1.2"></span>
					<?php echo vmText::_('COM_VIRTUEMART_STORE_FORM_TOS'); ?>
				</div>
			</div>
			<div class="uk-card-body">

				<?php echo $this->editor->display('vendor_terms_of_service', $this->vendor->vendor_terms_of_service, '100%', 200, 70, 15) ?>
			</div>
		</div>
	</div>
	<div>
		<div class="uk-card   uk-card-small uk-card-vm">
			<div class="uk-card-header">
				<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: home; ratio: 1.2"></span>
					<?php echo vmText::_('COM_VIRTUEMART_STORE_FORM_LEGAL'); ?>
				</div>
			</div>
			<div class="uk-card-body">
				<?php echo $this->editor->display('vendor_legal_info', $this->vendor->vendor_legal_info, '100%', 200, 70, 15) ?>
			</div>
		</div>
	</div>
	<div>

		<?php
		echo adminSublayouts::renderAdminVmSubLayout('metaedit',
			array(
				'obj' => $this->vendor,
			)
		);
		?>
	</div>
</div>


<input type="hidden" name="user_is_vendor" value="1"/>
<input type="hidden" name="virtuemart_vendor_id" value="<?php echo $this->vendor->virtuemart_vendor_id; ?>"/>
<input type="hidden" name="last_task" value="<?php echo vRequest::getCmd('task'); ?>"/>
