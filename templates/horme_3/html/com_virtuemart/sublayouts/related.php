<?php defined('_JEXEC') or die('Restricted access');

$related = $viewData['related'];
$customfield = $viewData['customfield'];
$thumb = $viewData['thumb'];
?>
<div class="product-container" data-mh="related">
<a href="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $related->virtuemart_product_id . '&virtuemart_category_id=' . $related->virtuemart_category_id)?>">
  <?php
  echo $thumb;
  ?>
  <div class="caption text-center">
  <hr>
  <?php
  echo $related->product_name;
  ?>
  </div>
</a>
<?php
if($customfield->wDescr){
  echo '<p class="product_s_desc small text-muted" data-mh="psd">'.$related->product_s_desc.'</p>';
}
?>
<?php if($customfield->wPrice) : ?>
<div class="product-price small form-group" id="productPrice<?php echo $related->virtuemart_product_id ?>">
  <?php
  $currency = calculationHelper::getInstance()->_currencyDisplay;
  echo $currency->createPriceDiv ('salesPrice', '', $related->prices);
  ?>
</div>
<?php endif; ?>
<?php if($customfield->waddtocart) : ?>
  <div class="vm3pr-related" >
  <?php	echo shopFunctionsF::renderVmSubLayout('addtocart',array('product'=>$related, 'position' => array('ontop', 'addtocart')));	?>
  </div>
<?php endif; ?>
</div>