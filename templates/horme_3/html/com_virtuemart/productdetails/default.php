<?php
/**
 *
 * Show the product details page
 *
 * @package	VirtueMart
 * @subpackage
 * @author Max Milbers, Eugen Stranz, Max Galt
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2014 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default.php 8811 2015-03-30 23:11:08Z Milbo $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

/* Let's see if we found the product */
if (empty($this->product)) {
	echo vmText::_('COM_VIRTUEMART_PRODUCT_NOT_FOUND');
	echo '<br /><br />  ' . $this->continue_link_html;
	return;
}

// Get stock indicators
$productmodel = VmModel::getModel('product');
$product = $productmodel->getProduct($this->product->virtuemart_product_id);
$stockinfo = $productmodel->getStockIndicator($product);

echo shopFunctionsF::renderVmSubLayout('askrecomjs',array('product'=>$this->product));

if(vRequest::getInt('print',false)){ ?>
<body onload="javascript:print();">
<?php } ?>

<div id="productdetails-view" class="product-container productdetails-view productdetails row product">

  <div class="vm-product-container col-md-12">

    <h1 class="page-header product-name"><?php echo $this->product->product_name ?></h1>

    <?php // afterDisplayTitle Event

    echo $this->product->event->afterDisplayTitle;

    // Product Edit Link
    echo $this->edit_link;

    if (!empty($this->product->customfieldsSorted['ontop'])) { ?>
    <div class="row">
      <div class="col-md-12">
        <?php echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'ontop')); ?>
      </div>
    </div>
    <hr>
    <?php } ?>

    <div class="row">
    	<div class="vm-product-media-container col-md-7 text-center">
      <?php

      echo $this->loadTemplate('images');
    	$count_images = count ($this->product->images);
    	if ($count_images > 1) {
    		echo $this->loadTemplate('images_additional');
    	}

      ?>
    	</div>

      <div class="vm-product-details-container col-md-5">

        <div class="spacer-buy-area">
          <div class="row">
            <?php

            echo shopFunctionsF::renderVmSubLayout('rating',array('showRating'=>$this->showRating,'product'=>$this->product));

            if ( VmConfig::get ('display_stock', 1)) { ?>
            <div class="text-right col-md-4 col-xs-4 pull-right">
    					<span class="vmicon vm2-<?php echo $stockinfo->stock_level; ?> glyphicon glyphicon-signal hasTooltip" title="<?php echo $stockinfo->stock_tip; ?>"></span>
            </div>
    				<?php } ?>
          </div>
          <?php
          // Manufacturer of the Product
          if (VmConfig::get('show_manufacturers', 1) && !empty($this->product->virtuemart_manufacturer_id)) {
            echo $this->loadTemplate('manufacturer');
          }
          ?>
          <hr>
          <?php
          // Product Short Description
          if (!empty($this->product->product_s_desc)) {
          ?>
          <div class="product-short-description small well well-sm">
          <?php
          echo nl2br($this->product->product_s_desc);
          ?>
          </div>
          <?php
          } // Product Short Description END

          echo shopFunctionsF::renderVmSubLayout('prices',array('product'=>$this->product,'currency'=>$this->currency));

          echo shopFunctionsF::renderVmSubLayout('addtocart',array('product'=>$this->product));

          echo shopFunctionsF::renderVmSubLayout('stockhandle',array('product'=>$this->product));

          if (!empty($this->productDisplayTypes)) {
            echo '<hr>';
          }

					foreach ($this->productDisplayTypes as $type=>$productDisplayType) {

						foreach ($productDisplayType as $productDisplay) {

							foreach ($productDisplay as $virtuemart_method_id =>$productDisplayHtml) {
								?>
								<div class="<?php echo substr($type, 0, -1) ?> <?php echo substr($type, 0, -1).'-'.$virtuemart_method_id ?> small text-muted">
									<?php
									echo $productDisplayHtml;
									?>
								</div>
								<?php
							}
						}
					}

          // PDF - Print - Email Icon
          $askquestion_url = JRoute::_('index.php?option=com_virtuemart&view=productdetails&task=askquestion&virtuemart_product_id=' . $this->product->virtuemart_product_id . '&virtuemart_category_id=' . $this->product->virtuemart_category_id . '&tmpl=component', FALSE);
          if ( VmConfig::get('show_emailfriend') || VmConfig::get('show_printicon') || VmConfig::get('pdf_icon') || VmConfig::get('ask_question') ) {
          ?>
          <hr>
          <div class="icons btn-group btn-group-xs btn-group-justified">
	          <?php
	          $link = 'index.php?tmpl=component&option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->virtuemart_product_id;
	          $MailLink = 'index.php?option=com_virtuemart&view=productdetails&task=recommend&virtuemart_product_id=' . $this->product->virtuemart_product_id . '&virtuemart_category_id=' . $this->product->virtuemart_category_id . '&tmpl=component';
	          if (VmConfig::get('pdf_icon')) {
	          ?>
	          <a class="btn btn-default hasTooltip" href="<?php echo $link . '&format=pdf';?>" title="<?php echo vmText::_('COM_VIRTUEMART_PDF')?>">
	            <span class="glyphicon glyphicon-file"></span>
	          </a>
	          <?php
	          }

	          if (VmConfig::get('show_printicon')) {
	          ?>
	          <a class="btn btn-default printModal hasTooltip" href="<?php echo $link . '&print=1';?>" title="<?php echo vmText::_('COM_VIRTUEMART_PRINT')?>">
	            <span class="glyphicon glyphicon-print"></span>
	          </a>
	          <?php
	          }

	          if (VmConfig::get('show_emailfriend')) {
	          ?>
	          <a class="iframe-src btn btn-default hasTooltip" href="#form-collapse-anchor" data-href="<?php echo $MailLink;?>" title="<?php echo vmText::_('COM_VIRTUEMART_EMAIL')?>">
	            <span class="glyphicon glyphicon-envelope"></span>
	          </a>
	          <?php
	          }

	          if (VmConfig::get('ask_question')) {
	          ?>
	          <a class="iframe-src btn btn-default hasTooltip" href="#form-collapse-anchor" data-href="<?php echo $askquestion_url ?>" title="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_ENQUIRY_LBL') ?>">
	            <span class="glyphicon glyphicon-question-sign"></span>
	          </a>
	          <?php
	          }
	          ?>
					</div>
        <?php
				}
				?>
    	</div>

    </div>
  </div>
  <a id="form-collapse-anchor"></a>
  <div class="collapse margin-top-15" id="form-collapse">
    <iframe class="well well-sm" scrolling="no" style="width: 100%; border:0; min-height: 550px; transition: height ease-in-out 200ms; overflow: hidden"></iframe>
    <div class="vm-preloader">
      <img src="<?php echo JURI::root(); ?>/components/com_virtuemart/assets/images/vm-preloader.gif" alt="Preloader" />
    </div>
  </div>
  <?php
	// event onContentBeforeDisplay
	echo $this->product->event->beforeDisplayContent; ?>

	<?php
  // Product Description
  if (!empty($this->product->product_desc)) {
  ?>
  <div class="row">
    <div class="product-description col-md-12">
      <?php /** @todo Test if content plugins modify the product description */ ?>
      <h2 class="page-header"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_DESC_TITLE') ?></h2>
      <?php echo $this->product->product_desc; ?>
    </div>
  </div>
  <?php
  } // Product Description END

  if ( !empty($this->product->customfieldsSorted['normal']) ) { ?>
  <div class="row">
    <div class="col-md-12 text-left">
	    <?php echo shopFunctionsF::renderVmSubLayout('customfields_normal',array('product'=>$this->product,'position'=>'normal')); ?>
    </div>
  </div>
  <?php }
  if ( !empty($this->product->customfieldsSorted['onbot']) ) { ?>
  <div class="row">
    <div class="col-md-12 text-left">
      <?php echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'onbot')); ?>
    </div>
  </div>
  <?php }

  echo $this->loadTemplate('reviews');
  echo shopFunctionsF::renderVmSubLayout('customfields_related',array('product'=>$this->product,'position'=>'related_products','class'=> 'product-related-products','customTitle' => true ));
	echo shopFunctionsF::renderVmSubLayout('customfields_related',array('product'=>$this->product,'position'=>'related_categories','class'=> 'product-related-categories'));

  ?>

<?php // onContentAfterDisplay event
echo $this->product->event->afterDisplayContent;

// Show child categories
if ($this->cat_productdetails) {
	echo $this->loadTemplate('showcategory');
}
?>

  <hr>

  <div class="btn-group btn-group-sm btn-group-justified">
    <?php
    // Product Navigation
    if (VmConfig::get('product_navigation', 1)) {
    ?>
    <?php
    if (!empty($this->product->neighbours ['previous'][0])) {
      $prev_link = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->neighbours ['previous'][0] ['virtuemart_product_id'] . '&virtuemart_category_id=' . $this->product->virtuemart_category_id, FALSE);
      echo JHtml::_('link', $prev_link, '<span class="glyphicon glyphicon-chevron-left"></span>', array('rel'=>'prev', 'class' => 'previous-page btn btn-default hasTooltip','data-dynamic-update' => '1', 'title' => $this->product->neighbours ['previous'][0]['product_name']));
    }
    ?>
    <?php
    } // Product Navigation END

     // Back To Category Button
    if ($this->product->virtuemart_category_id) {
    $catURL =  JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$this->product->virtuemart_category_id, FALSE);
    $categoryName = vmText::_($this->product->category_name) ;
    } else {
    $catURL =  JRoute::_('index.php?option=com_virtuemart');
    $categoryName = vmText::_('COM_VIRTUEMART_SHOP_HOME') ;
    }
    ?>
    <a href="<?php echo $catURL ?>" class="btn btn-default hasTooltip" title="<?php echo $categoryName ?>"><span class="glyphicon glyphicon-step-backward"></span> <span class="hidden-xs"><?php echo vmText::sprintf('COM_VIRTUEMART_CATEGORY_BACK_TO',$categoryName) ?></span></a>
    <?php
    if (!empty($this->product->neighbours ['next'][0])) {
      $next_link = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->neighbours ['next'][0] ['virtuemart_product_id'] . '&virtuemart_category_id=' . $this->product->virtuemart_category_id, FALSE);
      echo JHtml::_('link', $next_link, '<span class="glyphicon glyphicon-chevron-right"></span>', array('rel'=>'next','class' => 'next-page btn btn-default hasTooltip','data-dynamic-update' => '1', 'title' => $this->product->neighbours ['next'][0] ['product_name']));
    }
    ?>
  </div>

<?php
$j = 'jQuery(document).ready(function($) {
	Virtuemart.product(jQuery("form.product"));

	$("form.js-recalculate").each(function(){
		if ($(this).find(".product-fields").length && !$(this).find(".no-vm-bind").length) {
			var id= $(this).find(\'input[name="virtuemart_product_id[]"]\').val();
			Virtuemart.setproducttype($(this),id);

		}
	});
});';
//vmJsApi::addJScript('recalcReady',$j);

if(VmConfig::get ('jdynupdate', TRUE)){
/** GALT
	 * Notice for Template Developers!
	 * Templates must set a Virtuemart.container variable as it takes part in
	 * dynamic content update.
	 * This variable points to a topmost element that holds other content.
	 */
$j = "Virtuemart.container = jQuery('.productdetails-view');
Virtuemart.containerSelector = '.productdetails-view';
//Virtuemart.recalculate = true;	//Activate this line to recalculate your product after ajax
";

vmJsApi::addJScript('ajaxContent',$j);
}

$j ='
jQuery("#productdetails-view .hasTooltip").tooltip({"html": true,"container": ".productdetails-view"});
';
vmJsApi::addJScript('tooltip',$j);

$j ='jQuery(document).ready(function($) {
  // Collapse behavior for the ask question and recommend form
  $("a.iframe-src").click(function(event){
    $("html, body").animate({
      scrollTop: jQuery( jQuery.attr(this, "href") ).offset().top -20
    }, 500);
    var src = $(this).attr("data-href");
    if ($("#form-collapse").hasClass("in")){
      $("#form-collapse").find("iframe").attr("src", src);
    } else {
      $("#form-collapse").collapse("toggle").find("iframe").attr("src", src);
    }
    $("#form-collapse").find("div.vm-preloader").removeClass("hide");
    event.preventDefault();
  });
});';
vmJsApi::addJScript('collapse',$j);

$j ='jQuery(document).ready(function($) {
  // Preloader
  if ($("select[data-dynamic-update=\'1\']").length) {
      $("select[data-dynamic-update=\'1\']").change(function(){
      $("#productdetails-view").find(".vm-preloader").removeClass("hidden");
    });
  }
	$("select").addClass("form-control");

	$("a.next-page, a.previous-page").click(function(){
  	$("#productdetails-view").find(".vm-preloader").removeClass("hidden");
    $("html, body").animate({
        scrollTop: $("#productdetails-view").offset().top
    }, 800);
	});
});';

vmJsApi::addJScript('ajaxpreloader',$j);

echo vmJsApi::writeJS();

if ($this->product->prices['salesPrice'] > 0) {
  echo shopFunctionsF::renderVmSubLayout('snippets',array('product'=>$this->product, 'currency'=>$this->currency, 'showRating'=>$this->showRating));
}
?>
    <div class="vm-preloader hidden">
      <img src="<?php echo JURI::root(); ?>/components/com_virtuemart/assets/images/vm-preloader.gif" alt="Preloader" />
    </div>
  </div>
<script>
// Tooltip  Mootools fix
if (typeof jQuery != 'undefined' && typeof MooTools != 'undefined' ) {

(function($) {
  $('[data-toggle="tooltip"], .hasTooltip, #myTab a, div.btn-group, [data-toggle="tab"], .hasPopover, .hasTooltip').each(function(){this.show = null; this.hide = null});
})(jQuery);

}
</script>
</div>