<?php
/**
 *
 * Template for the shipment selection
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
 * @version $Id: cart.php 2400 2010-05-11 19:30:47Z milbo $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

if ($this->layoutName!=$this->cart->layout) { ?>
<h1 class="page-header"><?php echo vmText::_('COM_VIRTUEMART_CART_SELECT_SHIPMENT') ?></h1>
<?php }

if (VmConfig::get('oncheckout_show_steps', 1)) { ?>
<div class="checkoutStep alert alert-info" id="checkoutStep2"><?php echo vmText::_('COM_VIRTUEMART_USER_FORM_CART_STEP2'); ?></div>
<?php }

if ($this->layoutName!=$this->cart->layout) {
	$headerLevel = 1;
	if($this->cart->getInCheckOut()){
		$buttonclass = 'button vm-button-correct';
	} else {
		$buttonclass = 'default';
	}
?>

<form method="post" id="shipmentForm" name="chooseShipmentRate" action="<?php echo JRoute::_('index.php'); ?>" class="form-validate">
	<?php
	} else {
		$headerLevel = 3;
		$buttonclass = 'vm-button-correct';
	}
	?>

<?php
  if ($this->found_shipment_method ) { ?>

  <fieldset class="vm-payment-shipment-select vm-shipment-select">
	<?php
	// if only one Shipment , should be checked by default
  foreach ($this->shipments_shipment_rates as $shipment_shipment_rates) {
		if (is_array($shipment_shipment_rates)) {
	    foreach ($shipment_shipment_rates as $shipment_shipment_rate) { ?>
			<div class="vm-shipment-plugin-single"><?php echo $shipment_shipment_rate ?></div>
			<?php
	    }
		}
  } ?>

  </fieldset>

  <?php
  } else {

	echo "<h".$headerLevel.">".$this->shipment_not_found_text."</h".$headerLevel.">";

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
			<span class="glyphicon glyphicon-remove"></span> <?php echo vmText::_('COM_VIRTUEMART_CANCEL'); ?>
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