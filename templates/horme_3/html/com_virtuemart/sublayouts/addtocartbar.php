<?php
/**
 *
 * Show the product details page
 *
 * @package    VirtueMart
 * @subpackage
 * @author Max Milbers
 * @todo handle child products
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2015 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_addtocart.php 7833 2014-04-09 15:04:59Z Milbo $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$product = $viewData['product'];

if(isset($viewData['rowHeights'])){
	$rowHeights = $viewData['rowHeights'];
} else {
	$rowHeights['customfields'] = TRUE;
}

$init = 1;
if(isset($viewData['init'])){
	$init = $viewData['init'];
}

if(!empty($product->min_order_level) and $init<$product->min_order_level){
	$init = $product->min_order_level;
}

$step=1;
if (!empty($product->step_order_level)){
	$step=$product->step_order_level;
	if(!empty($init)){
		if($init<$step){
			$init = $step;
		} else {
			$init = ceil($init/$step) * $step;
		}
	}
	if(empty($product->min_order_level) and !isset($viewData['init'])){
		$init = $step;
	}
}

$maxOrder= '';
if (!empty($product->max_order_level)){
	$maxOrder = ' max="'.$product->max_order_level.'" ';
}

$addtoCartButton = '';
if(!VmConfig::get('use_as_catalog', 0)){
	if(!$product->addToCartButton and $product->addToCartButton!==''){
		$addtoCartButton = self::renderVmSubLayout('addtocartbtn',array('orderable'=>$product->orderable)); //shopFunctionsF::getAddToCartButton ($product->orderable);
	} else {
		$addtoCartButton = $product->addToCartButton;
	}

}
$position = 'addtocart';

if ($product->min_order_level > 0) {
	$minOrderLevel = $product->min_order_level;
}
else {
	$minOrderLevel = 1;
}


if (!VmConfig::get('use_as_catalog', 0)  ) { ?>

	<div class="addtocart-bar text-center" data-mh="addtocart">
	<?php
	// Display the quantity box
  $stockhandle = VmConfig::get('stockhandle_products', false) && $product->product_stockhandle ? $product->product_stockhandle : VmConfig::get('stockhandle','none');
	if ($product->show_notify) { ?>
		<a class="notify btn btn-primary btn-block" href="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&layout=notify&virtuemart_product_id=' . $product->virtuemart_product_id); ?>"><?php echo vmText::_ ('COM_VIRTUEMART_CART_NOTIFY') ?></a><?php
	} else {
		$tmpPrice = (float) $product->prices['costPrice'];
		if (!( VmConfig::get('askprice', true) and empty($tmpPrice) ) ) { ?>
			<?php
			$editable = 'hidden';
			if ($product->orderable) {
				$editable = 'text';
			} ?>
			<?php if ($product->orderable) { ?>
				<!-- <label for="quantity<?php echo $product->virtuemart_product_id; ?>" class="quantity_box"><?php echo vmText::_ ('COM_VIRTUEMART_CART_QUANTITY'); ?>: </label> -->
        <div class="quantity-controls js-recalculate input-group margin-top-15">
          <span class="input-group-btn">
  				  <button type="button" class="quantity-controls quantity-minus btn btn-default">
              <span class="glyphicon glyphicon-minus"></span>
            </button>
          </span>
          <!--<span class="quantity-box">-->
  				<input type="text" class="quantity-input js-recalculate text-center form-control" name="quantity[]"
						data-errStr="<?php echo vmText::_ ('COM_VIRTUEMART_WRONG_AMOUNT_ADDED')?>"
            value="<?php echo $init; ?>" data-init="<?php echo $init; ?>" data-step="<?php echo $step; ?>" <?php echo $maxOrder; ?> />
  			  <!--</span>-->
          <span class="input-group-btn">
  				  <button type="button" class="quantity-controls quantity-plus btn btn-default">
              <span class="glyphicon glyphicon-plus"></span>
            </button>
          </span>
          <input type="hidden" name="virtuemart_product_id[]" value="<?php echo $product->virtuemart_product_id ?>"/>
			  </div>
			<?php }

			if(!empty($addtoCartButton)){
				?><div class="addtocart-button margin-top-15">
				<?php //echo $addtoCartButton
          if($product->orderable) {
            echo '<input type="submit" name="addtocart" class="addtocart-button btn btn-primary btn-block" value="'.vmText::_( 'COM_VIRTUEMART_CART_ADD_TO' ).'" title="'.vmText::_( 'COM_VIRTUEMART_CART_ADD_TO' ).'" />';
          } else {
            echo '<button type="button" class="addtocart-button-disabled btn btn-block disabled" title="'.vmText::_( 'COM_VIRTUEMART_ADDTOCART_CHOOSE_VARIANT' ).'">'. vmText::_( 'COM_VIRTUEMART_ADDTOCART_CHOOSE_VARIANT' ) .'</button>';
          }
        ?>
				</div> <?php
			} ?>
			<input type="hidden" name="virtuemart_product_id[]" value="<?php echo $product->virtuemart_product_id ?>"/>
			<noscript><input type="hidden" name="task" value="add"/></noscript> <?php
		}
	} ?>

	</div><?php
} ?>
