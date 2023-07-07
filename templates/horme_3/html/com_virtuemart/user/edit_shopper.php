<?php
/**
 *
 * Modify user form view, User info
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
 * @version $Id: edit_shopper.php 8565 2014-11-12 18:26:14Z Milbo $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

/*if( $this->userDetails->virtuemart_user_id!=0) {
    echo $this->loadTemplate('vmshopper');
}*/

echo '<div class="userfields-wrap margin-top row">' . $this->loadTemplate('address_userfields') . '</div>';

if ( $this->userDetails->virtuemart_user_id ) {
  echo $this->loadTemplate('address_addshipto');
}

if(!empty($this->virtuemart_userinfo_id)){
	echo '<input type="hidden" name="virtuemart_userinfo_id" value="'.(int)$this->virtuemart_userinfo_id.'" />';
}
?>
<input type="hidden" name="task" value="saveUser" />
<input type="hidden" name="address_type" value="<?php echo $this->address_type; ?>"/>
<?php // captcha addition
if(VmConfig::get ('reg_captcha') && JFactory::getUser()->guest == 1) : ?>
  <hr>
	<?php echo $this->captcha; ?>
<?php endif; ?>

<?php if (!$this->userDetails->user_is_vendor) { ?>
<hr>
<div class="row">
  <div class="col-md-12 text-center">
  	<button class="btn btn-primary" type="submit" onclick="javascript:return myValidator(userForm, true);" >
      <span class="glyphicon glyphicon-ok"></span>
      <?php echo $this->button_lbl ?>
    </button>
  	&nbsp;
  	<button class="btn" type="reset" onclick="window.location.href='<?php echo JRoute::_('index.php?option=com_virtuemart&view=user', FALSE); ?>'" >
      <span class="glyphicon glyphicon-remove"></span>
      <?php echo vmText::_('COM_VIRTUEMART_CANCEL'); ?>
    </button>
  </div>
</div>
<?php } ?>