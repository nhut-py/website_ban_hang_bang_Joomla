<?php // no direct access
defined ('_JEXEC') or die('Restricted access');
// add javascript for price and cart, need even for quantity buttons, so we need it almost anywhere
vmJsApi::jPrice();
echo shopFunctionsF::renderVmSubLayout('askrecomjs');
$pwidth = ' col-sm-' . floor (12 / $products_per_row);
?>
<div class="vm-group">

	<?php if ($headerText) { ?>
	<div class="vmheader well well-sm"><?php echo $headerText ?></div>
	<?php } ?>

	<div class="vm-product row">

		<?php
		foreach ($products as $product) {
		?>
		<div class="product-container product <?php echo $pwidth ?>">
			<div class="thumbnail">
			  <div class="product-img-wrapper" data-mh="product-img-wrapper">
				<?php
				if (!empty($product->images[0])) {
					$image = $product->images[0]->displayMediaThumb ('class="featuredProductImage"', FALSE);
				} else {
					$image = '';
				}
				echo JHTML::_ ('link', JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id), $image, array('title' => $product->product_name));
				?>
        </div>
				<a href="<?php echo $product->link ?>"><h5 data-mh="vm-product-h5"><?php echo $product->product_name ?></h5></a>

				<?php
				if ($show_price) { ?>
        <div class="small" data-mh="vm-product-price">
					<?php	echo shopFunctionsF::renderVmSubLayout('prices_module',array('product'=>$product,'currency'=>$currency)); ?>
        </div>
				<?php }
				if ($show_addtocart && empty($product->customfieldsSorted['addtocart'])) {
          echo shopFunctionsF::renderVmSubLayout('addtocart',array('product'=>$product,'position' => array('ontop', 'addtocart')));
				} else {
					echo '<hr>';
          echo '<div class="addtocart-bar" data-mh="addtocart">';
					echo JHtml::link($product->link,vmText::_ ( 'COM_VIRTUEMART_PRODUCT_DETAILS' ), array ('title' => $product->product_name, 'class' => 'product-details btn btn-default btn-block' ) );
          echo '</div>';
        }
				?>
			</div>
		</div>
		<?php
		} // End foreach
		?>

	</div>

	<?php if ($footerText) { ?>
	<div class="vmfooter well well-sm"><?php echo $footerText ?></div>
	<?php } ?>

</div>