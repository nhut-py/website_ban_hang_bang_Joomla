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
 * @version $Id: default_email.php 10425 2021-01-19 07:08:40Z alatak $
 */
defined('_JEXEC') or die('Restricted access');
?>
<div class="uk-child-width-1-2@m uk-grid-match uk-grid-small" uk-grid>
	<div>
		<?php echo $this->loadTemplate('email_emails') ?>
	</div>
	<?php if (VmConfig::get('ordersAddOnly', false)) { ?>
	<div>
		<?php echo $this->loadTemplate('email_addordersonly') ?>
	</div>
	<?php } ?>
	<div>
		<?php echo $this->loadTemplate('email_invoices') ?>
	</div>
</div>





