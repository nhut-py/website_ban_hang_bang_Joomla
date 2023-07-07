<?php
/**
 *
 * Description
 *
 * @package    VirtueMart
 * @subpackage Config
 * @author Max Milbers
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_priceconfig.php 10451 2021-01-27 08:16:53Z alatak $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
/** @var TYPE_NAME $showPricesLine */
/** @var TYPE_NAME $params */
/** @var TYPE_NAME $show_prices */

?>

<table class="uk-table uk-table-small uk-table-striped uk-table-responsive" id="show_hide_prices">

	<thead>
	<tr>
		<th></th>
		<th><?php echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_PRICES_LABEL'); ?></th>
		<th><?php echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_PRICES_TEXT'); ?></th>
		<th><?php echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_PRICES_ROUNDING'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php
	if ($this->shopgrp_price) {
		?>
		<caption>
			<?php
			echo vmText::sprintf('COM_VM_PRICEDISPLAY_CONFIGURED_BY_SHOPPERGRPS', implode(',', $this->shopgrp_price));
			?>
		</caption>
		<?php
	}

	if ($showPricesLine) {
		?>

		<tr>
			<td><?php echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_SHOW_PRICES'); ?></td>
			<td><?php echo VmHTML::checkbox('show_prices', $show_prices); ?></td>
			<td></td>
			<td></td>
		</tr>
		<?php
	}
	?>


	<?php
	echo VirtuemartViewConfig::writePriceConfigLine($params, 'basePrice', 'COM_VIRTUEMART_ADMIN_CFG_PRICE_BASEPRICE');
	echo VirtuemartViewConfig::writePriceConfigLine($params, 'variantModification', 'COM_VIRTUEMART_ADMIN_CFG_PRICE_VARMOD');
	echo VirtuemartViewConfig::writePriceConfigLine($params, 'basePriceVariant', 'COM_VIRTUEMART_ADMIN_CFG_PRICE_BASEPRICE_VAR');
	echo VirtuemartViewConfig::writePriceConfigLine($params, 'discountedPriceWithoutTax', 'COM_VIRTUEMART_ADMIN_CFG_PRICE_DISCPRICE_WOTAX', 0);
	echo VirtuemartViewConfig::writePriceConfigLine($params, 'discountedPriceWithoutTaxTt', 'COM_VIRTUEMART_ADMIN_CFG_PRICE_DISCPRICE_WOTAX_TT', 0);
	echo VirtuemartViewConfig::writePriceConfigLine($params, 'priceWithoutTax', 'COM_VIRTUEMART_ADMIN_CFG_PRICE_SALESPRICE_WOTAX', 0);
	echo VirtuemartViewConfig::writePriceConfigLine($params, 'priceWithoutTaxTt', 'COM_VIRTUEMART_ADMIN_CFG_PRICE_SALESPRICE_WOTAX_TT', 0);
	echo VirtuemartViewConfig::writePriceConfigLine($params, 'taxAmount', 'COM_VIRTUEMART_ADMIN_CFG_PRICE_TAX_AMOUNT', 0);
	echo VirtuemartViewConfig::writePriceConfigLine($params, 'taxAmountTt', 'COM_VIRTUEMART_ADMIN_CFG_PRICE_TAX_AMOUNT_TT', 0);
	echo VirtuemartViewConfig::writePriceConfigLine($params, 'basePriceWithTax', 'COM_VIRTUEMART_ADMIN_CFG_PRICE_BASEPRICE_WTAX');
	echo VirtuemartViewConfig::writePriceConfigLine($params, 'salesPrice', 'COM_VIRTUEMART_ADMIN_CFG_PRICE_SALESPRICE');
	echo VirtuemartViewConfig::writePriceConfigLine($params, 'salesPriceTt', 'COM_VIRTUEMART_ADMIN_CFG_PRICE_SALESPRICE_TT');
	echo VirtuemartViewConfig::writePriceConfigLine($params, 'salesPriceWithDiscount', 'COM_VIRTUEMART_ADMIN_CFG_PRICE_SALESPRICE_WD');
	echo VirtuemartViewConfig::writePriceConfigLine($params, 'discountAmount', 'COM_VIRTUEMART_ADMIN_CFG_PRICE_DISC_AMOUNT');
	echo VirtuemartViewConfig::writePriceConfigLine($params, 'discountAmountTt', 'COM_VIRTUEMART_ADMIN_CFG_PRICE_DISC_AMOUNT_TT');
	echo VirtuemartViewConfig::writePriceConfigLine($params, 'unitPrice', 'COM_VIRTUEMART_ADMIN_CFG_PRICE_UNITPRICE');
	?>
	</tbody>

</table>
		