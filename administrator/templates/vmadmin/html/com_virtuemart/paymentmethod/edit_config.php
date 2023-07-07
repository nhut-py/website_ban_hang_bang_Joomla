<?php
/**
 *
 * Description
 *
 * @package    VirtueMart
 * @subpackage Paymentmethod
 * @author Max Milbers
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: edit_config.php 10396 2021-01-11 11:35:30Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

if ($this->payment->payment_jplugin_id) {
	?>
	<div class="uk-card   uk-card-small uk-card-vm ">
		<div class="uk-card-header">
			<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: cog; ratio: 1.2"></span>
				<?php echo $this->payment->payment_name ?>
				<div class="uk-text-meta"><?php echo VmText::_('COM_VIRTUEMART_PAYMENT_CLASS_NAME') . ": " . $this->payment->payment_element ?></div>
			</div>
		</div>
		<div class="uk-card-body">
			<?php
			if ($this->payment->form) {
				$form = $this->payment->form;
				include(VMPATH_ADMIN . '/fields/formrenderer.php');
			}
			?>
		</div>
	</div>
	<?php
} else {
	echo vmText::_('COM_VIRTUEMART_SELECT_PAYMENT_METHOD_VM3');
}




