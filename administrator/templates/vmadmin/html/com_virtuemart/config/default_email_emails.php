<?php
/**
 * Admin form for the email configuration settings
 *
 * @package    VirtueMart
 * @subpackage Config
 * @author Oscar van Eijk
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2015 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_email_emails.php 10393 2021-01-11 11:23:39Z alatak $
 */
defined('_JEXEC') or die('Restricted access');
?>

<div class="uk-card uk-card-small uk-card-vm">
	<div class="uk-card-header">
		<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: mail; ratio: 1.2"></span>
			<?php echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_SHOP_EMAILS'); ?>
		</div>
	</div>
	<div class="uk-card-body">
		<?php
		$optOrderMail = array(
			'0' => vmText::_('COM_VIRTUEMART_ADMIN_CFG_MAIL_FORMAT_TEXT'),
			'1' => vmText::_('COM_VIRTUEMART_ADMIN_CFG_MAIL_FORMAT_HTML'),
		);
		echo VmuikitHtml::row('genericlist', 'COM_VIRTUEMART_ADMIN_CFG_MAIL_FORMAT', $optOrderMail, 'order_mail_html', '', 'value', 'text', VmConfig::get('order_mail_html', 0));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_ADMIN_CFG_MAIL_USEVENDOR', 'useVendorEmail', VmConfig::get('useVendorEmail', 0));
		echo VmuikitHtml::row('booleanlist', 'COM_VM_CFG_INVOICE_IN_USER_LANG', 'invoiceInUserLang', VmConfig::get('invoiceInUserLang', 0));
		$optDebugEmail = array(
			'0' => vmText::_('COM_VIRTUEMART_NO'),
			'debug_email' => vmText::_('COM_VM_CFG_DEBUG_MAIL_YES'),
			'debug_email_send' => vmText::_('COM_VM_CFG_DEBUG_MAIL_SEND'),
		);
		echo VmuikitHtml::row('genericlist', 'COM_VM_CFG_DEBUG_MAIL', $optDebugEmail, 'debug_mail', '', 'value', 'text', VmConfig::get('debug_mail', 0));
		echo VmuikitHtml::row('input', 'COM_VM_CFG_EMAIL_ADDITIONAL_VENDOR_MAIL', 'addVendorEmail', VmConfig::get('addVendorEmail', ''));
		$attrlist = 'class="inputbox" multiple="multiple" ';
		echo VmuikitHtml::row('genericlist', 'COM_VM_CFG_EMAIL_FIELDS_SHOPPER', $this->emailSf_Options, 'email_sf_s[]', $attrlist, 'name', 'title', VmConfig::get('email_sf_s', array('email')), 'email_sf_s', true);

		echo VmuikitHtml::row('genericlist', 'COM_VIRTUEMART_CFG_OSTATUS_EMAILS_SHOPPER', $this->osWoP_Options, 'email_os_s[]', $attrlist, 'order_status_code', 'order_status_name', VmConfig::get('email_os_s', array('U', 'C', 'S', 'R', 'X')), 'email_os_s', true);
		echo VmuikitHtml::row('genericlist', 'COM_VIRTUEMART_CFG_OSTATUS_EMAILS_VENDOR', $this->os_Options, 'email_os_v[]', $attrlist, 'order_status_code', 'order_status_name', VmConfig::get('email_os_v', array('U', 'C', 'R', 'X')), 'email_os_v', true);

		echo VmuikitHtml::row('input', 'COM_VIRTUEMART_CFG_ATTACH', 'attach', VmConfig::get('attach', ''));
		echo VmuikitHtml::row('genericlist', 'COM_VIRTUEMART_CFG_ATTACH_OS', $this->osWoP_Options, 'attach_os[]', $attrlist, 'order_status_code', 'order_status_name', VmConfig::get('attach_os', array('U', 'C', 'R', 'X')), 'attach_os', true);
		?>

	</div>
</div>





