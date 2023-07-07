<?php
/**
*
* Modify user form view
*
* @package	VirtueMart
* @subpackage User
* @author Oscar van Eijk
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: edit.php 8768 2015-03-02 12:22:14Z Milbo $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

vmJsApi::css('vmpanels');
$url = vmURI::getCurrentUrlBy('request');
$cancelUrl = JRoute::_($url.'&task=cancel');
?>

<?php //vmJsApi::vmValidator(); ?>

<h1 class="page-header"><?php echo $this->page_title ?></h1>

<?php echo shopFunctionsF::getLoginForm(false,false); ?>

<?php if($this->userDetails->virtuemart_user_id==0) { ?>
	<h2 class="page-header"><?php echo vmText::_('COM_VIRTUEMART_YOUR_ACCOUNT_REG'); ?></h2>
<?php }?>

<form method="post" id="adminForm" name="userForm" action="<?php echo JRoute::_($url) ?>" class="form-validate" >

  <?php // Loading Templates in Tabs for logged in users
  if($this->userDetails->virtuemart_user_id!=0) {
      $tabarray = array();

      $tabarray['shopper'] = 'COM_VIRTUEMART_SHOPPER_FORM_LBL';

    // Create tab list
  	if($this->userDetails->user_is_vendor){
			echo '<div class="btn-group btn-group-justified" role="group">';
			if(!empty($this->manage_link)) {
				echo $this->manage_link;
			}
  		if(!empty($this->add_product_link)) {
  			echo $this->add_product_link;
  		}
      echo '</div>';
      echo '<hr>';
  		$tabarray['vendor'] = 'COM_VIRTUEMART_VENDOR';
  	}

      //$tabarray['user'] = 'COM_VIRTUEMART_USER_FORM_TAB_GENERALINFO';
      if (!empty($this->shipto)) {
  	    $tabarray['shipto'] = 'COM_VIRTUEMART_USER_FORM_ADD_SHIPTO_LBL';
      }
      if (($_ordcnt = count($this->orderlist)) > 0) {
  	    $tabarray['orderlist'] = 'COM_VIRTUEMART_YOUR_ORDERS';
      }

      shopFunctionsF::buildTabs ( $this, $tabarray);

   } else {

      echo $this->loadTemplate ( 'shopper' );

   }
  ?>
  <?php // For vendors
  if($this->userDetails->user_is_vendor){ ?>
  <hr>
  <div class="form-group text-center">
  	<button class="button btn btn-primary" type="submit" onclick="javascript:return myValidator(userForm, true);" >
      <span class="glyphicon glyphicon-ok"></span>
      <?php echo $this->button_lbl ?>
    </button>
  	&nbsp;
    <button class="button" type="reset" onclick="window.location.href='<?php echo $cancelUrl ?>'" >
      <span class="glyphicon glyphicon-remove"></span>
      <?php echo vmText::_('COM_VIRTUEMART_CANCEL'); ?>
    </button>
  </div>
  <?php }
	//stAn - with hidden config of reg_captcha_logged=1 we can trigger captcha for logged in if needed as well, or add user input filter plugin for antispam
	echo $this->captcha;
  ?>
  <input type="hidden" name="option" value="com_virtuemart" />
  <input type="hidden" name="controller" value="user" />
  <?php echo JHtml::_( 'form.token' ); ?>
</form>
<script>
// Form Styling
jQuery('#adminForm').find('.btn-group a').addClass('btn btn-warning').end().find('br.clear').remove();
jQuery('.fg-button').removeAttr('style').addClass('btn');
jQuery('#searchMedia').removeAttr('style');
jQuery('.checkboxes div.controls').addClass('radio');
jQuery('div.vmquote').removeAttr('style').addClass('well small');
jQuery('div.vm__img_autocrop').addClass('form-group');
</script>