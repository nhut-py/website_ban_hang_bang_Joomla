<?php
/**
*
* Layout for the add to cart popup
*
* @package	VirtueMart
* @subpackage Cart
* @author Max Milbers
*
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2013 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: cart.php 2551 2010-09-30 18:52:40Z milbo $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
?>
<div class="vm-padded">
<?php

if($this->products){
	foreach($this->products as $product){
		if($product->quantity>0){
			echo '<h4 class="page-header">'.vmText::sprintf('COM_VIRTUEMART_CART_PRODUCT_ADDED',$product->product_name,$product->quantity).'</h4>';
		} else {
			if(!empty($product->errorMsg)){
				echo '<div class="alert alert-danger">'.$product->errorMsg.'</div>';
			}
		}

	}
}


if(VmConfig::get('popup_rel',1)){
	//VmConfig::$echoDebug=true;
	if ($this->products and is_array($this->products) and count($this->products)>0 ) {

		$product = reset($this->products);
		$customFieldsModel = VmModel::getModel('customfields');
		$product->customfields = $customFieldsModel->getCustomEmbeddedProductCustomFields($product->allIds,'R');
		$customFieldsModel->displayProductCustomfieldFE($product,$product->customfields);

		if(!empty($product->customfields)){
		?>
		  <div class="well well-sm">
			<h5 class="text-center"><?php echo vmText::_('COM_VIRTUEMART_RELATED_PRODUCTS'); ?></h5>
			</div>
			<div class="product-related-products row text-center">
		<?php
			foreach($product->customfields as $rFields){
				if(!empty($rFields->display)){
			?>
				<div class="product-field product-field-type-<?php echo $rFields->field_type ?> col-md-4">
					<div class="product-field-display"><?php echo $rFields->display ?></div>
				</div>
			<?php }
			} ?>
			</div>
			<hr>
	<?php }
	}
}
?>
  <div>
		<a class="continue_link btn btn-block btn-default" href="<?php echo $this->continue_link; ?>">
			<?php echo vmText::_('COM_VIRTUEMART_CONTINUE_SHOPPING'); ?>
		</a>
		<a class="showcart btn btn-block btn-primary" href="<?php echo $this->cart_link; ?>">
			<span class="glyphicon glyphicon-shopping-cart"></span> <?php echo vmText::_('COM_VIRTUEMART_CART_SHOW'); ?>
		</a>
  </div>
</div>