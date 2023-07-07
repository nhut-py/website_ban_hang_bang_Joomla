<?php // no direct access
defined('_JEXEC') or die('Restricted access');
vmJsApi::jPrice();
echo shopFunctionsF::renderVmSubLayout('askrecomjs');
?>
<div class="vm-group">

	<?php if ($headerText) { ?>
	<div class="vmheader well well-sm"><?php echo $headerText ?></div>
	<?php } ?>

	<div class="product-container product productdetails">
		<?php foreach ($products as $product) { ?>
		<div class="thumbnail">
		<?php
		if (!empty($product->images[0]) ) {
			$image = $product->images[0]->displayMediaThumb('class="featuredProductImage" ',false) ;
		} else {
			$image = '';
    }
		echo JHTML::_('link', JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$product->virtuemart_product_id.'&virtuemart_category_id='.$product->virtuemart_category_id),$image,array('title' => $product->product_name) );
		?>

		<a href="<?php echo $product->link ?>">
			<h5 class="text-center"><?php echo $product->product_name ?></h5>
		</a>

		<?php
		// $product->prices is not set when show_prices in config is unchecked
		if ($show_price and isset($product->prices)) { ?>
    <div class="small">
		<?php	echo shopFunctionsF::renderVmSubLayout('prices_module',array('product'=>$product,'currency'=>$currency)); ?>
    </div>
		<?php }

		if ($show_addtocart && empty($product->customfieldsSorted['addtocart'])) {
      echo shopFunctionsF::renderVmSubLayout('addtocart',array('product'=>$product,'position' => array('ontop', 'addtocart')));
		} else {
			echo '<hr>';
			echo JHtml::link($product->link,vmText::_ ( 'COM_VIRTUEMART_PRODUCT_DETAILS' ), array ('title' => $product->product_name, 'class' => 'product-details btn btn-default btn-block margin-top-15' ) );
		}

		?>
		</div>
		<?php } ?>
	</div>

	<?php if ($footerText) { ?>
	<div class="vmfooter well well-sm"><?php echo $footerText ?></div>
	<?php } ?>

</div>