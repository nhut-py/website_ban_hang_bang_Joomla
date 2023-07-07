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
 * @version $Id: default_shop_advanced.php 10471 2021-01-29 13:07:45Z Milbo $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access'); ?>


<div class="uk-card uk-card-small uk-card-vm">
	<div class="uk-card-header">
		<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: cog; ratio: 1.2"></span>
			<?php echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_SHOP_ADVANCED'); ?>
		</div>
	</div>
	<div class="uk-card-body">
		<?php
		echo VmuikitHtml::row('booleanlist', 'COM_VM_CFG_ADMINTEMPLATE', 'backendTemplate', VmConfig::get('backendTemplate', 1));
		$optDebug = array(
			'none' => vmText::_('COM_VIRTUEMART_ADMIN_CFG_ENABLE_DEBUG_NONE'),
			'admin' => vmText::_('COM_VIRTUEMART_ADMIN_CFG_ENABLE_DEBUG_ADMIN'),
			'all' => vmText::_('COM_VIRTUEMART_ADMIN_CFG_ENABLE_DEBUG_ALL')
		);

		echo VmuikitHtml::row('radiolist', 'COM_VIRTUEMART_ADMIN_CFG_ENABLE_DEBUG', 'debug_enable', VmConfig::get('debug_enable', 'none'), $optDebug);
		echo VmuikitHtml::row('booleanlist', 'COM_VM_CFG_ENABLE_DEBUG_METHODS', 'debug_enable_methods', VmConfig::get('debug_enable_methods', 0));
		echo VmuikitHtml::row('booleanlist', 'COM_VM_CFG_ENABLE_DEBUG_ROUTER', 'debug_enable_router', VmConfig::get('debug_enable_router', 0));
		echo VmuikitHtml::row('radiolist', 'COM_VIRTUEMART_CFG_DEV', 'vmdev', VmConfig::get('vmdev', 0), $optDebug);
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_ADMIN_CFG_DANGEROUS_TOOLS', 'dangeroustools', VmConfig::get('dangeroustools', 0));
		echo VmuikitHtml::row('input', 'COM_VIRTUEMART_REV_PROXY_VAR', 'revproxvar', VmConfig::get('revproxvar', ''));
		$optMultiX = array(
			'none' => vmText::_('COM_VIRTUEMART_ADMIN_CFG_ENABLE_MULTIX_NONE'),
			'admin' => vmText::_('COM_VIRTUEMART_ADMIN_CFG_ENABLE_MULTIX_ADMIN')

			// 				'all'	=> vmText::_('COM_VIRTUEMART_ADMIN_CFG_ENABLE_DEBUG_ALL')
		);
		echo VmuikitHtml::row('radiolist', 'COM_VIRTUEMART_ADMIN_CFG_ENABLE_MULTIX', 'multix', VmConfig::get('multix', 'none'), $optMultiX);
		$optMultiX = array(
			'0' => vmText::_('COM_VIRTUEMART_CFG_MULTIX_CART_NONE'),
			'byproduct' => vmText::_('COM_VIRTUEMART_CFG_MULTIX_CART_BYPRODUCT'),
			'byvendor' => vmText::_('COM_VIRTUEMART_CFG_MULTIX_CART_BYVENDOR'),
			'byselection' => vmText::_('COM_VIRTUEMART_CFG_MULTIX_CART_BYSELECTION')
			// 				'all'	=> vmText::_('COM_VIRTUEMART_ADMIN_CFG_ENABLE_DEBUG_ALL')
		);
		echo VmuikitHtml::row('radiolist', 'COM_VIRTUEMART_CFG_MULTIX_CART', 'multixcart', VmConfig::get('multixcart', 0), $optMultiX);
		echo VmuikitHtml::row('booleanlist', 'COM_VM_USE_OPTIMISED_PRODUCT_SQL', 'optimisedProductSql', VmConfig::get('optimisedProductSql', 1));
		echo VmuikitHtml::row('booleanlist', 'COM_VM_USE_OPTIMISED_CALC_SQL', 'optimisedCalcSql', VmConfig::get('optimisedCalcSql', 1));
		echo VmuikitHtml::row('booleanlist', 'COM_VM_USE_OPTIMISED_CAT_SQL', 'optimisedCatSql', VmConfig::get('optimisedCatSql', 1));
		?>
	</div>
</div>











