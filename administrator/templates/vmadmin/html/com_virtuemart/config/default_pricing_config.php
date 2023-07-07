<?php
/**
 *
 * Description
 *
 * @package    VirtueMart
 * @subpackage Config
 * @author RickG
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_pricing_config.php 10393 2021-01-11 11:23:39Z alatak $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

$js = 'Virtuemart.showprices;';
vmJsApi::addJScript('show_prices', $js, true);

?>

<div class="uk-card uk-card-small uk-card-vm">
	<div class="uk-card-header">
		<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: tag; ratio: 1.2"></span>
			<?php echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_PRICE_CONFIGURATION'); ?>
		</div>
	</div>
	<div class="uk-card-body">
		<?php
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_ADMIN_CFG_PRICE_SHOW_TAX', 'show_tax', VmConfig::get('show_tax', 1));
		echo VmuikitHtml::row('booleanlist', 'COM_VM_CFG_PRICE_SHOW_INFO_TAX', 'vm_prices_info_tax', VmConfig::get('vm_prices_info_tax', 0));
		echo VmuikitHtml::row('booleanlist', 'COM_VM_CFG_PRICE_SHOW_INFO_DELIVERY', 'vm_prices_info_delivery', VmConfig::get('vm_prices_info_delivery', 0));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_ADMIN_CFG_PRICE_ASKPRICE', 'askprice', VmConfig::get('askprice', 1));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_ADMIN_CFG_PRICE_RAPPENRUNDUNG', 'rappenrundung', VmConfig::get('rappenrundung', 0));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_ADMIN_CFG_PRICE_ROUNDINDIG', 'roundindig', VmConfig::get('roundindig', 1));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_ADMIN_CFG_PRICE_CVARSWT', 'cVarswT', VmConfig::get('cVarswT', 1));

		$opt = array(
			'0' => vmText::_('JNONE'),
			'1' => vmText::_('COM_VM_PRICES_BY_CURRENCY'),
			'2' => vmText::_('COM_VM_PRICES_BY_CURRENCY_RESTRICTIV')
		);
		echo VmuikitHtml::row('genericlist', 'COM_VM_CFG_PRICES_BY_CURRENCY', $opt, 'pricesbyCurrency', '', 'value', 'text', VmConfig::get('pricesbyCurrency', 0));
		echo VmuikitHtml::row('genericlist', 'COM_VIRTUEMART_ADMIN_CFG_PRICE_ORDERBY', $this->orderDirs, 'price_orderby', '', 'value', 'text', VmConfig::get('price_orderby', 'DESC'));
		?>

	</div>
</div>
