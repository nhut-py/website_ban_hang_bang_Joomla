<?php
/**
 *
 * @package    VirtueMart
 * @subpackage Currency
 * @author Max Milbers, RickG
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
vmuikitAdminUIHelper::imitateTabs('start', 'COM_VIRTUEMART_CURRENCY_DETAILS');
?>
	<div class="uk-card   uk-card-small uk-card-vm ">
		<div class="uk-card-header">
			<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: currencies; ratio: 1.2"></span>
				<?php echo vmText::_('COM_VIRTUEMART_CURRENCY_DETAILS') ?>
			</div>
		</div>
		<div class="uk-card-body">
			<form action="index.php" method="post" name="adminForm" id="adminForm" class="uk-form-horizontal">


				<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_CURRENCY_NAME', 'currency_name', vRequest::vmSpecialChars($this->currency->currency_name), 'class="required"'); ?>
				<?php echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_PUBLISHED', 'published', $this->currency->published); ?>
				<?php if ($this->showVendors()) {
					echo VmuikitHtml::row('checkbox', 'COM_VIRTUEMART_SHARED', 'shared', $this->currency->shared);
				} ?>
				<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_CURRENCY_EXCHANGE_RATE', 'currency_exchange_rate', $this->currency->currency_exchange_rate, 'class="inputbox"', '', 6); ?>
				<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_CURRENCY_CODE_2', 'currency_code_2', $this->currency->currency_code_2, 'class="inputbox"', '', 2, 2); ?>
				<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_CURRENCY_CODE_3', 'currency_code_3', $this->currency->currency_code_3, 'class="required"', '', 3, 3); ?>
				<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_CURRENCY_NUMERIC_CODE', 'currency_numeric_code', $this->currency->currency_numeric_code, 'class="inputbox"', '', 3, 3); ?>
				<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_CURRENCY_SYMBOL', 'currency_symbol', vRequest::vmSpecialChars($this->currency->currency_symbol), 'class="required"', '', 20, 20); ?>
				<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_CURRENCY_DECIMALS', 'currency_decimal_place', vRequest::vmSpecialChars($this->currency->currency_decimal_place), 'class="inputbox"', '', 20, 20); ?>
				<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_CURRENCY_DECIMALSYMBOL', 'currency_decimal_symbol', vRequest::vmSpecialChars($this->currency->currency_decimal_symbol), 'class="inputbox"', '', 10, 10); ?>
				<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_CURRENCY_THOUSANDS', 'currency_thousands', vRequest::vmSpecialChars($this->currency->currency_thousands), 'class="inputbox"', '', 10, 10); ?>
				<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_CURRENCY_POSITIVE_DISPLAY', 'currency_positive_style', vRequest::vmSpecialChars($this->currency->currency_positive_style), 'class="inputbox"', '', 50, 50); ?>
				<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_CURRENCY_NEGATIVE_DISPLAY', 'currency_negative_style', vRequest::vmSpecialChars($this->currency->currency_negative_style), 'class="inputbox"', '', 50, 50);

				if ($this->showVendors()) {
					echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_VENDOR', $this->vendorList);
				}
				?>

				<?php echo vmText::_('COM_VIRTUEMART_CURRENCY_DISPLAY_EXPL'); ?>


				<input type="hidden" name="virtuemart_currency_id"
						value="<?php echo $this->currency->virtuemart_currency_id; ?>"/>
				<?php echo $this->addStandardHiddenToForm(); ?>
			</form>
		</div>

	</div>


<?php
AdminUIHelper::imitateTabs('end');
AdminUIHelper::endAdminArea(); ?>