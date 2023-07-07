<?php
/**
 *
 * Enter address data for the cart, when anonymous users checkout
 *
 * @package    VirtueMart
 * @subpackage User
 * @author Oscar van Eijk, Max Milbers
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: edit_address.php 8768 2015-03-02 12:22:14Z Milbo $
 */
// Check to ensure this file is included in Joomla!
defined ('_JEXEC') or die('Restricted access');

vmJsApi::css('vmpanels');
$layout = vRequest::getCmd('layout');
$thistask = vRequest::getCmd('task');
$addrtype = vRequest::getCmd('addrtype');
$this->cart = VirtueMartCart::getCart();
$url = 0;
if ($this->cart->_fromCart or $this->cart->getInCheckOut()) {
	$rview = 'cart';
}
else {
	$rview = 'user';
}

function renderControlButtons($view,$rview){
	?>
<div class="text-center">
	<?php

	if ($view->cart->getInCheckOut() || $view->address_type == 'ST') {
		$buttonclass = 'btn btn-primary';
	}
	else {
		$buttonclass = 'btn btn-primary';
	}

	if (VmConfig::get ('oncheckout_show_register', 1) && $view->userDetails->JUser->id == 0 && $view->address_type == 'BT' and $rview == 'cart') {
	?>
    <hr>
		<button name="register" class="<?php echo $buttonclass ?>" type="submit" onclick="javascript:return myValidator(userForm,true);" title="<?php echo vmText::_ ('COM_VIRTUEMART_REGISTER_AND_CHECKOUT'); ?>"><?php echo vmText::_ ('COM_VIRTUEMART_REGISTER_AND_CHECKOUT'); ?></button>
		<?php if (!VmConfig::get ('oncheckout_only_registered', 0)) { ?>
		<button name="save" class="<?php echo $buttonclass ?>" title="<?php echo vmText::_ ('COM_VIRTUEMART_CHECKOUT_AS_GUEST'); ?>" type="submit" onclick="javascript:return myValidator(userForm, false);"><?php echo vmText::_ ('COM_VIRTUEMART_CHECKOUT_AS_GUEST'); ?></button>
		<?php } ?>
		<button class="default" type="reset" onclick="window.location.href='<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=' . $rview.'&task=cancel'); ?>'"><?php echo vmText::_ ('COM_VIRTUEMART_CANCEL'); ?></button>

  <?php
	}	else {
  ?>
    <hr>
		<button class="<?php echo $buttonclass ?>" type="submit" onclick="javascript:return myValidator(userForm,true);"><?php echo vmText::_ ('COM_VIRTUEMART_SAVE'); ?></button>
		<button class="default" type="reset" onclick="window.location.href='<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=' . $rview.'&task=cancel'); ?>'"><?php echo vmText::_ ('COM_VIRTUEMART_CANCEL'); ?></button>

	<?php } ?>
</div>
<?php
}

?>
<h1 class="page-header"><?php echo $this->page_title ?></h1>
<?php
$task = '';
if ($this->cart->getInCheckOut()){
	$task = '&task=checkout';
}

$url = 'index.php?option=com_virtuemart&view='.$rview.$task;
?>
<div class="width30 floatleft vm-cart-header">
    <div class="payments-signin-button" ></div>
</div>
<?php
echo shopFunctionsF::getLoginForm (TRUE, FALSE, $url);

//if ($layout != 'editaddress' && $addrtype != 'ST' || $layout != 'editaddress' && $addrtype != 'BT') {
if ($rview == 'cart' && $addrtype == 'BT' && $this->userDetails->JUser->get ('id') == 0) {
?>

<div class="row text-center small margin-top-15">

<?php
if ( VmConfig::get ('oncheckout_show_register', 1) && !VmConfig::get ('oncheckout_only_registered', 0) ) {
	$collapse = 'collapse';
	$col_sm = 'col-sm-6';
} else {
  $collapse = '';
	$col_sm = 'col-sm-12';
}
?>

  <div class="col-md-12 text-center">
    <?php
  	if (VmConfig::get ('oncheckout_show_register', 1) && !VmConfig::get ('oncheckout_only_registered',0) ) {
  		echo '<p class="reg_text" class="well">'.vmText::sprintf ('COM_VIRTUEMART_ONCHECKOUT_DEFAULT_TEXT_REGISTER', vmText::_ ('COM_VIRTUEMART_REGISTER_AND_CHECKOUT'), vmText::_ ('COM_VIRTUEMART_CHECKOUT_AS_GUEST')).'</p>';
  	}
    ?>
		<div class="row">
	    <?php if (VmConfig::get ('oncheckout_show_register', 1) && !VmConfig::get ('oncheckout_only_registered', 0)) { ?>
			<div class="<?php echo $col_sm; ?>">
		    <button class="btn btn-primary btn-block btn-lg userForm vm-registeruser" type="button">
		      <span class="glyphicon glyphicon-edit"></span>
		      <?php echo vmText::_ ('COM_VIRTUEMART_REGISTER_AND_CHECKOUT'); ?>
		    </button>
			</div>
	    <?php } ?>
	    <?php if (!VmConfig::get ('oncheckout_only_registered', 0) && VmConfig::get ('oncheckout_show_register', 0)) { ?>
			<div class="<?php echo $col_sm; ?>">
		    <button class="btn btn-warning btn-block btn-lg userForm vm-questscheckout" type="button">
		      <?php echo vmText::_ ('COM_VIRTUEMART_CHECKOUT_AS_GUEST'); ?>
		    </button>
			</div>
	    <?php } ?>
		</div>
  </div>
</div>

<?php if ( VmConfig::get ('oncheckout_show_register', 1) && !VmConfig::get ('oncheckout_only_registered', 0) ) { ?>
<hr>
<?php } ?>

<?php } else {
	$collapse = '';
}?>

<form method="post" id="userForm" name="userForm" class="form-validate <?php echo $collapse ?>" action="<?php echo JRoute::_('index.php?option=com_virtuemart&view=user',$this->useXHTML,$this->useSSL) ?>" >

  	<?php
  	if (!class_exists ('VirtueMartCart')) {
  		require(VMPATH_SITE . DS . 'helpers' . DS . 'cart.php');
  	}

  	if (count ($this->userFields['functions']) > 0) {
  		echo '<script language="javascript">' . "\n";
  		echo join ("\n", $this->userFields['functions']);
  		echo '</script>' . "\n";
  	}

  	echo '<div class="userfields-wrap margin-top row">' . $this->loadTemplate ('userfields') . '</div>';

   // captcha addition
  	if(VmConfig::get ('reg_captcha') && JFactory::getUser()->guest == 1) : ?>
      <hr>
  		<fieldset id="recaptcha_wrapper">
  		  <p class="text-center"><?php echo vmText::_ ('COM_VIRTUEMART_USER_FORM_CAPTCHA'); ?></p>
  			<?php echo $this->captcha; ?>
  		</fieldset>
    <?php endif;	// end of captcha addition ?>

  	<?php
    renderControlButtons($this,$rview);
    if ($this->userDetails->virtuemart_user_id) {
  		echo $this->loadTemplate ('addshipto');
  	} ?>

  	<input type="hidden" name="option" value="com_virtuemart"/>
  	<input type="hidden" name="view" value="user"/>
  	<input type="hidden" name="controller" value="user"/>
  	<input type="hidden" name="task" value="saveUser"/>
  	<input type="hidden" name="layout" value="<?php echo $this->getLayout (); ?>"/>
  	<input type="hidden" name="address_type" value="<?php echo $this->address_type; ?>"/>

  	<?php if (!empty($this->virtuemart_userinfo_id)) {
  		echo '<input type="hidden" name="shipto_virtuemart_userinfo_id" value="' . (int)$this->virtuemart_userinfo_id . '" />';
  	}
  	echo JHtml::_ ('form.token');
  	?>

</form>
<?php
//if ($layout != 'editaddress') {
if ($rview == 'cart' && $addrtype != 'ST') {
?>
<script>
var vmlogin = jQuery('#vm-login');
var vmloginbutton = jQuery('button.vm-login');
var userform = jQuery('#userForm');
var userfileds = jQuery('#username_field,#name_field,#password_field,#password2_field');
var oldoverride = jQuery('div.userfields-wrap').find('.form-group');
// Toggle the display of required form fields, submit buttons, login form
jQuery('button.userForm').click(function(){
  if (vmlogin.hasClass('in')) {
    vmlogin.collapse('toggle');
  }
  if (!userform.hasClass('in')){
  	userform.collapse('toggle');
  }
	if (vmloginbutton.children('span.glyphicon-log-in').hasClass('hide')){
     vmloginbutton.find('span').toggleClass('hide');
	}
  if (jQuery(this).hasClass('vm-questscheckout')) {
    if (oldoverride.length) {
      userfileds.parents('div.form-group').slideUp();
    } else {
      userfileds.parents('tr').slideUp();
    }
    jQuery('button[name="register"]').hide();
    jQuery('button[name="save"]').show();

  } else {
    if (oldoverride.length) {
      userfileds.parents('div.form-group').slideDown();
    } else {
      userfileds.parents('tr').slideDown();
    }
    jQuery('button[name="save"]').hide();
    jQuery('button[name="register"]').show();
  }
  jQuery('html, body').animate({
      scrollTop: jQuery('#reg_text').offset().top
  }, 800);
});

jQuery('button.vm-login').click(function(){
  if (userform.hasClass('in')) {
  	userform.collapse('toggle');
  }
});
</script>
<?php } ?>