<?php // no direct access
defined('_JEXEC') or die('Restricted access');
$class = "";
$data = $cart->prepareAjaxData(true);
//var_dump($data->products);
//var_dump($cart->products);
// Ajax is displayed in vm_cart_products
// ALL THE DISPLAY IS Done by Ajax using "hiddencontainer" ?>

<!-- Virtuemart 2 Ajax Card -->
<div class="vmCartModule <?php echo $params->get('moduleclass_sfx'); ?> btn-group" id="vmCartModule<?php echo $params->get('moduleid_sfx'); ?>">

  <button class="total_wrapper btn btn-default dropdown-toggle" data-toggle="dropdown">
    <span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;
    <span class="total_products small"><?php echo  $data->totalProductTxt ?></span>

    <?php //if ($data->totalProduct and $show_price and $currencyDisplay->_priceConfig['salesPrice'][0]) { ?>
    	<span class="total small">
    		<?php if (!empty($data->products)) {
              echo '- ' . $data->billTotal;
       } ?>
    	</span>
    <?php //} ?>
  </button>
  <?php
  if ($show_product_list) { ?>
    	<div id="hiddencontainer" class="hiddencontainer" style="display: none;">
    		<div class="vmcontainer">
    			<div class="product_row row">
            <div class="product_image col-md-3 col-xs-3">
              <span class="image"></span>
            </div>
            <div class="col-md-6 col-xs-6 text-center">
              <span class="quantity"></span>&nbsp;x&nbsp;<span class="product_name"></span>
            </div>
    			  <?php if ($show_price and $currencyDisplay->_priceConfig['salesPrice'][0]) : ?>
            <div class="col-md-3 col-xs-3">
    				  <span class="subtotal_with_tax" style="float: right;"></span>
            </div>
    			  <?php endif; ?>
    			  <div class="customProductData col-xs-12 margin-top-15"></div>
            <hr style="clear: both">
    			</div>
    		</div>
    	</div>

      <div class="dd_cart_wrapper dropdown-menu">

          <div class="vm_cart_products clear">
            <div class="vmcontainer">
          	  <?php foreach ($data->products as $product){
          	    if ( VmConfig::get('oncheckout_show_images') ) {
                  foreach ($cart->products as $cartproduct) {
                    if (strip_tags($product['product_name']) == $cartproduct->product_name ) {
                      $image = $cartproduct->images[0];
                    }
                  }
                } ?>
                <div class="product_row row">
                  <div class="product_image col-md-3 col-xs-3">
                  <?php if ( VmConfig::get('oncheckout_show_images')) {
                    $class = 'margin-top';
                   ?>
                    <span class="img-thumbnail"><?php echo $image->displayMediaThumb ('', FALSE, '', TRUE, FALSE); ?></span>
                  <?php } ?>
                  </div>
                  <div class="col-md-6 col-xs-6 text-center">
                    <span class="quantity"><?php echo  $product['quantity'] ?></span>&nbsp;x&nbsp;<span class="product_name"><?php echo  $product['product_name'] ?></span>
                  </div>

                  <?php if ($show_price and $currencyDisplay->_priceConfig['salesPrice'][0]) { ?>
                  <div class="col-md-3 col-xs-3">
                    <span class="subtotal_with_tax floatright priceCol"><?php echo $product['subtotal_with_tax'] ?></span>
                  </div>
                  <?php } ?>

          				<?php if ( !empty($product['customProductData']) ) { ?>
          				<div class="customProductData col-xs-12 margin-top-15"><?php echo $product['customProductData'] ?></div>
          				<?php } ?>
                  <hr style="clear: both">
            		</div>

          	  <?php } ?>
            </div>
      	</div>
			  <!--<hr style="clear: both">-->
        <div class="show_cart_m clearfix">
          <?php //echo  $data->cart_show;
          $carturl = JRoute::_('index.php?option=com_virtuemart&amp;view=cart');
          ?>
          <a rel="nofollow" href="<?php echo $carturl ?>" class="btn btn-primary btn-xs show-cart pull-right"><?php echo vmText::_('COM_VIRTUEMART_CART_SHOW'); ?></a>
        </div>
        <?php if(vRequest::getCmd('view')!='cart') : ?>
        <div class="payments-signin-button"></div>
        <?php endif; ?>

      </div>

  <?php } ?>
  <noscript>
  <?php echo JText::_('MOD_VIRTUEMART_CART_AJAX_CART_PLZ_JAVASCRIPT') ?>
  </noscript>
</div>

<script>
jQuery(document).ready(function($){
  // Style the show cart link
  $('.show_cart_m > a').addClass('btn btn-default btn-xs').before('<a id="hide_cart" href="#" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove"></span></a>');

  // Stop click propagation so the dropdown is not closing
  $('a.show-cart').click(function(e){
    e.stopPropagation();
  });

});
</script>