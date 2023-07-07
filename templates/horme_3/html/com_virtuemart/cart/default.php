<?php
/**
 *
 * Layout for the shopping cart
 *
 * @package    VirtueMart
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
 * @version $Id: cart.php 2551 2010-09-30 18:52:40Z milbo $
 */

// Check to ensure this file is included in Joomla!
defined ('_JEXEC') or die('Restricted access');
if (!empty ($this->cart->products)) {
vmJsApi::vmValidator();
?>

<div id="cart-view" class="cart-view">

	<div class="vm-cart-header-container">
		<div class="vm-continue-shopping pull-right margin-top-15">
			<?php // Continue Shopping Button
			if (!empty($this->continue_link_html)) { ?>
				<a class="continue_link btn btn-default btn-xs" href="<?php echo $this->continue_link; ?>"><?php echo vmText::_ ('COM_VIRTUEMART_CONTINUE_SHOPPING'); ?></a>
			<?php } ?>
		</div>
		<h1 class="page-header"><?php echo vmText::_ ('COM_VIRTUEMART_CART_TITLE'); ?></h1>
    <div class="payments-signin-button"></div>
  	<?php if (VmConfig::get ('oncheckout_show_steps', 1) ){
  		if($this->checkout_task == 'checkout') {
  			echo '<div class="checkoutStep alert alert-info" id="checkoutStep1">' . vmText::_ ('COM_VIRTUEMART_USER_FORM_CART_STEP1') . '</div>';
  		} else { //if($this->checkout_task == 'confirm') {
  			echo '<div class="checkoutStep alert alert-info" id="checkoutStep4">' . vmText::_ ('COM_VIRTUEMART_USER_FORM_CART_STEP4') . '</div>';
  		}
  	}  ?>
	</div>

	<?php

	$uri = vmUri::getCurrentUrlBy('get');
	$uri = str_replace(array('?tmpl=component','&tmpl=component'),'',$uri);
	echo shopFunctionsF::getLoginForm ($this->cart, FALSE,$uri);

	// This displays the form to change the current shopper
	if ($this->allowChangeShopper and !$this->isPdf){
		echo $this->loadTemplate ('shopperform');
	}

	$taskRoute = '';
	?>

	<form method="post" id="checkoutForm" name="checkoutForm" action="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=cart' . $taskRoute, $this->useXHTML, $this->useSSL); ?>">
		<?php
		if(!$this->isPdf and VmConfig::get('multixcart')=='byselection'){
			echo shopFunctions::renderVendorFullVendorList($this->cart->vendorId);
			?>
			<input type="submit" name="updatecart" title="<?php echo vmText::_('COM_VIRTUEMART_SAVE'); ?>" value="<?php echo vmText::_('COM_VIRTUEMART_SAVE'); ?>" class="btn btn-default"/>
			<?php
		}

		if ( VmConfig::get('oncheckout_opc',true) ){
			echo $this->loadTemplate ('address');
    }

		// This displays the pricelist MUST be done with tables, because it is also used for the emails
		echo $this->loadTemplate ('pricelist');

		if ( !VmConfig::get('oncheckout_opc',true) ){
			echo $this->loadTemplate ('address');
    }

    ?>
    <hr>
		<?php
		if (!empty($this->checkoutAdvertise)) {
		?>
			<div id="checkout-advertise-box" class="clearfix form-group">
			<?php
			foreach ($this->checkoutAdvertise as $checkoutAdvertise) {
			?>
				<div class="checkout-advertise">
					<?php echo $checkoutAdvertise; ?>
				</div>
			<?php
			}
			?>
			</div>
		<?php
		}

		echo $this->loadTemplate ('cartfields');

		?>
    <hr>
		<div class="checkout-button-top text-right">
		<?php
			echo $this->checkout_link_html;
		?>
		</div>

		<?php // Continue and Checkout Button END ?>
		<input type='hidden' name='virtuemart_vendor_id' value='<?php echo $this->cart->vendorId; ?>'/>
		<input type='hidden' name='order_language' value='<?php echo $this->order_language; ?>'/>
		<input type='hidden' name='task' value='updatecart'/>
		<input type='hidden' name='option' value='com_virtuemart'/>
		<input type='hidden' name='view' value='cart'/>
	</form>
<script>
jQuery('#checkoutFormSubmit').addClass('btn btn-success btn-lg btn-block');
jQuery('[data-dynamic-update="1"], .vm-payment-row button, .vm-shipment-row button').click(function(){
	jQuery('div.vm-preloader').removeClass('hidden');
});
</script>

<?php
if(VmConfig::get('oncheckout_ajax',false)){
	vmJsApi::addJScript('updDynamicListeners',"
if (typeof Virtuemart.containerSelector === 'undefined') { Virtuemart.containerSelector = '#cart-view'; }
if (typeof Virtuemart.container === 'undefined') { Virtuemart.container = jQuery(Virtuemart.containerSelector); }

jQuery(document).ready(function() {
	if (Virtuemart.container)
		Virtuemart.updDynFormListeners();
}); ");
}

vmJsApi::addJScript('vm-checkoutFormSubmit',"
Virtuemart.bCheckoutButton = function(e) {
	e.preventDefault();
	jQuery(this).vm2front('startVmLoading');
	jQuery(this).attr('disabled', 'true');
	jQuery(this).removeClass( 'vm-button-correct' );
	jQuery(this).addClass( 'vm-button' );
	jQuery(this).fadeIn( 400 );
	var name = jQuery(this).attr('name');
	var div = '<input name=\"'+name+'\" value=\"1\" type=\"hidden\">';
  if(name=='confirm'){
      jQuery('#checkoutForm').attr('action','".$this->orderDoneLink."');
  }
	jQuery('#checkoutForm').append(div);
	//Virtuemart.updForm();
	jQuery('#checkoutForm').submit();
}
jQuery(document).ready(function($) {
	jQuery(this).vm2front('stopVmLoading');
	var el = jQuery('#checkoutFormSubmit');
	el.unbind('click dblclick');
	el.on('click dblclick',Virtuemart.bCheckoutButton);
});
	");

if( !VmConfig::get('oncheckout_ajax',false)) {
	vmJsApi::addJScript('vm-STisBT',"
		jQuery(document).ready(function($) {

			if ( $('#STsameAsBTjs').is(':checked') ) {
				$('#output-shipto-display').hide();
			} else {
				$('#output-shipto-display').show();
			}
			$('#STsameAsBTjs').click(function(event) {
				if($(this).is(':checked')){
					$('#STsameAsBT').val('1') ;
					$('#output-shipto-display').hide();
				} else {
					$('#STsameAsBT').val('0') ;
					$('#output-shipto-display').show();
				}
				var form = jQuery('#checkoutFormSubmit');
				form.submit();
			});
		});
	");
}

$this->addCheckRequiredJs();
vmJsApi::addJScript( 'vmprices',false,false);
?>
<div style="display:none;" id="cart-js">
<?php echo vmJsApi::writeJS(); ?>
</div>
	<div class="vm-preloader hidden">
	  <img src="<?php echo JURI::root(); ?>/components/com_virtuemart/assets/images/vm-preloader.gif" alt="Preloader" />
	</div>
</div>

<?php } else { ?>

<div class="cart-view text-center">
	<h1 class="page-header"><?php echo vmText::_ ('COM_VIRTUEMART_EMPTY_CART'); ?></h1>
	<?php
	// Continue Shopping Button
	if (!empty($this->continue_link_html)) { ?>
		<a class="continue_link btn btn-primary" href="<?php echo $this->continue_link; ?>"><?php echo vmText::_ ('COM_VIRTUEMART_CONTINUE_SHOPPING'); ?></a>
	<?php } ?>
</div>

<?php } ?>