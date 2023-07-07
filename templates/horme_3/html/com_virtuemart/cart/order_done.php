<?php
defined('_JEXEC') or die('');

/**
*
* Template for the shopping cart
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
*/
echo '<div class="vm-wrap vm-order-done">';
if (vRequest::getBool('display_title',true)) { ?>
	<h1 class="page-header"><?php echo vmText::_('COM_VIRTUEMART_CART_ORDERDONE_THANK_YOU'); ?></h1>
<?php } ?>

<div class="orderdone well">
<?php
echo $this->html;
?>
</div>

<?php
if (vRequest::getBool('display_loginform',true)) {
	$cuser = JFactory::getUser();
	if (!$cuser->guest) echo shopFunctionsF::getLoginForm();
}
?>
<script>
jQuery('a.vm-button-correct').addClass('btn btn-primary');
</script>
<?php echo '</div>'; ?>