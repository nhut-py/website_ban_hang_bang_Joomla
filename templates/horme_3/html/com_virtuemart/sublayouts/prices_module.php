<?php
/**
 *
 * Show the product prices
 *
 * @package    VirtueMart
 * @subpackage
 * @author Max Milbers, Valerie Isaksen
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2014 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_showprices.php 8024 2014-06-12 15:08:59Z Milbo $
 */
// Check to ensure this file is included in Joomla!
defined ('_JEXEC') or die('Restricted access');
$product = $viewData['product'];
$currency = $viewData['currency'];
$view = vRequest::getCmd('view');
?>
<div class="product-price">
	<?php
	if (!empty($product->prices['salesPrice'])) {
		//echo '<div class="vm-cart-price">' . vmText::_ ('COM_VIRTUEMART_CART_PRICE') . '</div>';
	}

	if ($product->prices['salesPrice']<=0 and VmConfig::get ('askprice', 1) and isset($product->images[0]) and !$product->images[0]->file_is_downloadable) {
		$askquestion_url = JRoute::_('index.php?option=com_virtuemart&view=productdetails&task=askquestion&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id . '&tmpl=component', FALSE);
    ?>
		<a class="ask-a-question btn btn-link btn-block" href="<?php echo $askquestion_url ?>" rel="nofollow" >
      <?php echo vmText::_ ('COM_VIRTUEMART_PRODUCT_ASKPRICE') ?>
    </a>
	<?php
	} else {
    echo '<div class="vm-basic-prices clearfix">';
    echo $currency->createPriceDiv ('salesPrice', 'COM_VIRTUEMART_PRODUCT_SALESPRICE', $product->prices);
    if ($product->prices['discountAmount'] != -0) {
  		echo $currency->createPriceDiv ('basePriceWithTax', 'COM_VIRTUEMART_PRODUCT_BASEPRICE_WITHTAX', $product->prices);
  	}
    echo '</div>';
	}
	?>
</div>