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
 * @version $Id: default_email_addordersonly.php 10393 2021-01-11 11:23:39Z alatak $
 */
defined('_JEXEC') or die('Restricted access');

$attrlist = 'class="inputbox" multiple="multiple" ';
?>

<div class="uk-card uk-card-small uk-card-vm">
	<div class="uk-card-header">
		<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: cart; ratio: 1.2"></span>
			<?php echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_SHOP_ORDERS'); ?>
		</div>
	</div>
	<div class="uk-card-body">

		<?php /*?>		<!-- NOT YET -->
 		echo VmuikitHtml::row('checkbox','COM_VIRTUEMART_ADMIN_CFG_MAIL_FROM_RECIPIENT','mail_from_recipient',VmConfig::get('mail_from_recipient',0));
 		echo VmuikitHtml::row('checkbox','COM_VIRTUEMART_ADMIN_CFG_MAIL_FROM_SETSENDER','mail_from_setsender',VmConfig::get('mail_from_setsender',0));
<?php */

		/* Should remove none ??? */

		echo VmuikitHtml::row('genericlist', 'COM_VIRTUEMART_ADMIN_CFG_STATUS_ORDER_ALLOWEDIT_OS', $this->os_Options, 'order_allowedit_os[]', $attrlist, 'order_status_code', 'order_status_name', VmConfig::get('order_allowedit_os', array('P', 'U')), 'order_allowedit_os', true);


		?>
	</div>
</div>





