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
 * @version $Id: default_shop_settings.php 10448 2021-01-24 08:54:37Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access'); ?>


<div class="uk-card uk-card-small uk-card-vm">
	<div class="uk-card-header">
		<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: shop; ratio: 1.2"></span>
			<?php echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_SHOP_SETTINGS'); ?>
		</div>
	</div>
	<div class="uk-card-body">
		<div class="uk-clearfix">
			<div class="uk-form-label"><?php echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_SHOP_OFFLINE'); ?></div>
			<div class="uk-form-controls uk-margin-small-top">
				<a class="uk-margin-small-top" target="_blank" href="https://docs.virtuemart.net/faqs/245-how-to-set-the-shop-in-maintenance-mode.html">How To Set The Shop In Maintenance Mode</a>
			</div>
		</div>
		<?php
		//echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_ADMIN_CFG_SHOP_OFFLINE', 'shop_is_offline', VmConfig::get('shop_is_offline', 0));
		//echo VmuikitHtml::row('textarea', 'COM_VIRTUEMART_ADMIN_CFG_SHOP_OFFLINE_MSG', 'offline_message', VmConfig::get('offline_message', 'Our Shop is currently down for maintenance. Please check back again soon.'),'class="uk-textarea"');
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_ADMIN_CFG_USE_ONLY_AS_CATALOGUE', 'use_as_catalog', VmConfig::get('use_as_catalog', 0));
		echo VmuikitHtml::row('genericlist', 'COM_VIRTUEMART_CFG_CURRENCY_MODULE', $this->currConverterList, 'currency_converter_module', 'size=1', 'value', 'text', VmConfig::get('currency_converter_module', 'convertECB.php'));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_ADMIN_CFG_ENABLE_CONTENT_PLUGIN', 'enable_content_plugin', VmConfig::get('enable_content_plugin', 0));

		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_ADMIN_CFG_SSL', 'useSSL', VmConfig::get('useSSL', 0));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_REGISTRATION_CAPTCHA', 'reg_captcha', VmConfig::get('reg_captcha', 0));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_VM_ERROR_HANDLING_ENABLE', 'handle_404', VmConfig::get('handle_404', 1));

		$host = JUri::getInstance()->getHost();
		?>
		<div class="uk-clearfix">
			<div class="uk-form-label"><?php echo vmText::_('COM_VM_EXTSUBSCR_HOST'); ?></div>
			<div class="uk-form-controls">
				<?php echo $host ?>
			</div>
		</div>

		<div class="uk-clearfix">
			<div class="uk-form-label">
				<span uk-tooltip="<?php echo htmlentities(vmText::_('COM_VM_MEMBER_ACCESSNBR_TIP')) ?>"><?php echo vmText::_('COM_VM_MEMBER_ACCESSNBR'); ?></span>
			</div>
			<div class="uk-form-controls">
				<?php echo VmuikitHtml::input('member_access_number', VmConfig::get('member_access_number', ''), '', '', 55); ?>
			</div>
		</div>
		<div class="uk-clearfix">
			<div class="uk-form-label">

			</div>
			<div class="uk-form-controls">
				<div class="alert">
					<div
							uk-tooltip="<?php echo htmlentities(vmText::sprintf($host, 'COM_VM_MEMBER_AGREEMENT_TIP', VmConfig::$vmlangTag, vmVersion::$RELEASE)) ?>'">
						<?php echo vmText::_('COM_VM_MEMBER_AGREEMENT') ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>










