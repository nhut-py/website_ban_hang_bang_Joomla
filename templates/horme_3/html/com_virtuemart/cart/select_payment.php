<?php
/**
 *
 * Layout for the payment selection
 *
 * @package	VirtueMart
 * @subpackage Cart
 * @author Max Milbers
 *
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: select_payment.php 8686 2015-02-05 19:43:41Z Milbo $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

$addClass="";

if ($this->layoutName!=$this->cart->layout) { ?>
<h1 class="page-header"><?php echo vmText::_('COM_VIRTUEMART_CART_SELECT_PAYMENT') ?></h1>
<?php }

if (VmConfig::get('oncheckout_show_steps', 1)) { ?>
<div class="checkoutStep alert alert-info" id="checkoutStep3"><?php echo vmText::_('COM_VIRTUEMART_USER_FORM_CART_STEP3'); ?></div>
<?php }

if ($this->layoutName!=$this->cart->layout) {
	$headerLevel = 1;
	if($this->cart->getInCheckOut()){
		$buttonclass = 'button vm-button-correct';
	} else {
		$buttonclass = 'default';
	}
?>

<form method="post" id="paymentForm" name="choosePaymentRate" action="<?php echo JRoute::_('index.php'); ?>" class="form-validate <?php echo $addClass ?>">
<?php
	} else {
		$headerLevel = 3;
		$buttonclass = 'vm-button-correct';
	}
?>

<?php
	if ($this->found_payment_method ) { ?>

  <fieldset class="vm-payment-shipment-select vm-payment-select">
  <?php
		foreach ($this->paymentplugins_payments as $paymentplugin_payments) {

			if (is_array($paymentplugin_payments)) {
				foreach ($paymentplugin_payments as $paymentplugin_payment) { ?>
					<div class="vm-payment-plugin-single"><?php echo $paymentplugin_payment ?></div>
			<?php	}
			}

		}
  ?>
  </fieldset>

  <?php
  } else {
  ?>

 	<h1 class="page-header"><?php echo $this->payment_not_found_text ?></h1>

	<?php
 	}

if(VmConfig::get('cart_extraSafeBtn',false) or $this->layoutName!=$this->cart->layout){
?>
<div class="well margin-top-15">
		<?php
		$dynUpdate = '';
		if( VmConfig::get('oncheckout_ajax',false)) {
			$dynUpdate=' data-dynamic-update="1" ';
		} ?>
	<button name="updatecart" class="<?php echo $buttonclass ?> btn btn-primary" type="submit" <?php echo $dynUpdate ?>>
		<span class="glyphicon glyphicon-ok"></span>	<?php echo vmText::_('COM_VIRTUEMART_SAVE'); ?>
	</button>
	&nbsp;
	<?php if ($this->layoutName!=$this->cart->layout) { ?>
	<button class="<?php echo $buttonclass ?> btn btn-default" type="reset" onClick="window.location.href='<?php echo JRoute::_('index.php?option=com_virtuemart&view=cart&task=cancel'); ?>'" >
		<span class="glyphicon glyphicon-remove"></span>	<?php echo vmText::_('COM_VIRTUEMART_CANCEL'); ?>
	</button>
	<?php  } ?>

</div>
<?php
}
if ($this->layoutName!=$this->cart->layout) {
?>
	<input type="hidden" name="option" value="com_virtuemart" />
	<input type="hidden" name="view" value="cart" />
	<input type="hidden" name="task" value="updatecart" />
	<input type="hidden" name="controller" value="cart" />
</form>
<?php
}
?>