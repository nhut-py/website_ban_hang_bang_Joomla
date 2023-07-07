<?php
/**
 *
 * Show the products in a category
 *
 * @package    VirtueMart
 * @subpackage
 * @author RolandD
 * @author Max Milbers
 * @todo add pagination
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default.php 8811 2015-03-30 23:11:08Z Milbo $
 */

defined ('_JEXEC') or die('Restricted access');
$doc = JFactory::getDocument();
$category_id  = vRequest::getInt ('virtuemart_category_id', 0);
$manufacturer_id  = vRequest::getInt ('virtuemart_manufacturer_id', 0);
$sort_dir = vRequest::getInt ('dir');
$doc->addScriptDeclaration("
jQuery(document).ready(function(){
	// Create the sorting layout. See vm-ltr-site.css also
	var prodActiveOrder = jQuery('.orderby-product div.activeOrder').text();
	jQuery('#product-orderby').append('<option>'+ prodActiveOrder +'</option>');
	jQuery('.orderby-product .orderlist a').each(function(){
	  href = jQuery(this).attr('href');
	  name = jQuery(this).text();
	  jQuery('#product-orderby').append('<option value=\"'+ href +'\">'+ name +'</option>');
	});

	var manActiveOrder = jQuery('.orderby-manufacturer div.activeOrder').text();
	if (manActiveOrder.length) {
		jQuery('#manuf-orderby').append('<option>'+ manActiveOrder +'</option>');
	}
	jQuery('.orderby-manufacturer a, div.Order').each(function(){
		if (!jQuery(this).hasClass('Order')) {
		  href = jQuery(this).attr('href');
		  name = jQuery(this).text();
		  jQuery('#manuf-orderby').append('<option value=\"'+ href +'\">'+ name +'</option>');
		} else {
			jQuery('#manuf-orderby').append('<option>'+ jQuery(this).text() +'</option>');
		}
	});

	var sort_href = jQuery('.orderby-product .activeOrder a').attr('href');
	jQuery('#sorting').attr('href', sort_href);
});
");
if (vRequest::getInt('dynamic',false) and vRequest::getInt('virtuemart_product_id',false)) {
	if (!empty($this->products)) {
		if($this->fallback){
			$p = $this->products;
			$this->products = array();
			$this->products[0] = $p;
			vmdebug('Refallback');
		}

		echo shopFunctionsF::renderVmSubLayout($this->productsLayout,array('products'=>$this->products,'currency'=>$this->currency,'products_per_row'=>$this->perRow,'showRating'=>$this->showRating));

	}

	return ;
}
?>
<div class="category-view">
	<h1 class="page-header"><?php echo vmText::_($this->category->category_name); ?></h1>
	<?php if ($this->show_store_desc and !empty($this->vendor->vendor_store_desc)) : ?>
 	<div class="vendor-store-desc">
 		<?php echo $this->vendor->vendor_store_desc; ?>
 	</div>
  <?php endif; ?>

	<?php if (!empty($this->showcategory_desc) and empty($this->keyword)) : ?>
		<?php if (!empty($this->category->category_description)) : ?>
		<div class="category_description">
			<?php echo $this->category->category_description; ?>
		</div>
		<hr>
		<?php endif; ?>
	<?php endif; ?>

	<?php	if(!empty($this->manu_descr)) :	?>
	<div class="manufacturer-description">
		<?php echo $this->manu_descr; ?>
	</div>
	<?php endif;?>

	<?php	// Show child categories
	if ($this->showcategory and empty($this->keyword) and $manufacturer_id == 0) {
		if (!empty($this->category->haschildren)) {
			echo ShopFunctionsF::renderVmSubLayout('categories',array('categories'=>$this->category->children, 'categories_per_row'=>$this->categories_per_row));
	    echo '<hr>';
		}
	}

	if (!empty($this->products) or ($this->showsearch or $this->keyword !== false)) {
	?>
	<div class="browse-view">
	<?php

	if ($this->showsearch or $this->keyword !== false) {
		//id taken in the view.html.php could be modified
		$category_id  = vRequest::getInt ('virtuemart_category_id', 0); ?>
  	<!--BEGIN Search Box -->
  	<div class="virtuemart_search">
  		<form action="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=category&limitstart=0', FALSE); ?>" method="get">
  			<?php if(!empty($this->searchCustomList)) { ?>
  			<div class="vm-search-custom-list">
  				<?php echo $this->searchCustomList ?>
  			</div>
  			<?php } ?>

  			<?php if(!empty($this->searchCustomValuesAr)) { ?>
  			<div class="vm-search-custom-values">
        <?php
        echo ShopFunctionsF::renderVmSubLayoutAsGrid(
            'searchcustomvalues',
            array (
                'searchcustomvalues' => $this->searchCustomValuesAr,
                'options' => array (
                    'items_per_row' => array (
                        'xs' => 2,
                        'sm' => 2,
                        'md' => 2,
                        'lg' => 2,
                        'xl' => 2,
                    ),
                ),
            )
        );
        ?>
  			</div>
  			<?php } ?>
  			<div class="vm-search-custom-search-input input-group form-group">
  				<input name="keyword" class="inputbox" type="text" size="40" value="<?php echo $this->keyword ?>"/>
          <span class="input-group-btn">
  				  <button type="submit" class="button btn-primary"><?php echo vmText::_ ('COM_VIRTUEMART_SEARCH') ?></button>
          </span>
  				<?php //echo VmHtml::checkbox ('searchAllCats', (int)$this->searchAllCats, 1, 0, 'class="changeSendForm"'); ?>
  			</div>
        <div class="vm-search-descr text-warning">
          <p><?php echo vmText::_('COM_VM_SEARCH_DESC') ?></p>
        </div>
  			<!-- input type="hidden" name="showsearch" value="true"/ -->
  			<input type="hidden" name="view" value="category"/>
  			<input type="hidden" name="option" value="com_virtuemart"/>
  			<input type="hidden" name="virtuemart_category_id" value="<?php echo $category_id; ?>"/>
  			<input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>"/>
  		</form>
  	</div>
  	<!-- End Search Box -->
  	<?php  } ?>

  <?php
  	$j = 'jQuery(document).ready(function() {

    jQuery(".changeSendForm")
    	.off("change",Virtuemart.sendCurrForm)
        .on("change",Virtuemart.sendCurrForm);
    })';

  	vmJsApi::addJScript('sendFormChange',$j);
  ?>

    <?php if (!empty($this->products) && $this->showproducts) : ?>
    <hr>
  	<div class="orderby-displaynumber row">
      <div class="orderlistcontainer col-sm-4">
        <div class="title"><?php echo vmText::_('COM_VIRTUEMART_ORDERBY'); ?></div>
        <div id="vm-orderby" class="hidden"><?php echo $this->orderByList['orderby']; ?></div>
    		<?php
        $orderBy = strip_tags($this->orderByList['orderby'],'<a><script>');
        $orderBy = explode('</a>',$orderBy);
        $orderBy = str_replace(['<a','</a','-/+','+/-','href', vmText::_('COM_VIRTUEMART_ORDERBY')], ['<option','</option','','','value',''], $orderBy);
        ?>
        <select onchange="window.location.href=this.value" style="width: calc(100% - 50px); display: inline-block">
        <?php foreach ($orderBy as $option) : ?>
        <?php echo $option ?>
        <?php endforeach; ?>
        </select>
        <button id="orderDir" class="btn btn-default" type="button" onclick="window.location.href=jQuery('#vm-orderby').find('.activeOrder').children('a').attr('href');" style="vertical-align:bottom;"><span class="glyphicon glyphicon-sort"></span></button>
      </div>
      <div class="orderlistcontainer col-sm-4">
        <?php if (!empty($this->orderByList['manufacturer'])) :?>
        <?php //echo $this->orderByList['manufacturer']; ?>
        <div class="title"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_DETAILS_MANUFACTURER_LBL'); ?></div>
    		<?php
        $orderMf = strip_tags($this->orderByList['manufacturer'],'<a><script>');
        $orderMf = explode('</a>', $orderMf);
        $orderMf = str_replace(['<a','</a','-/+','+/-','href',vmText::_('COM_VIRTUEMART_PRODUCT_DETAILS_MANUFACTURER_LBL')], ['<option','</option','','','value',''], $orderMf);
        $manufacturers = count($orderMf);
        ?>
        <select onchange="window.location.href=this.value">
        <?php if ($manufacturer_id == 0) : ?>
        <option selected="selected"><?php echo vmText::_('COM_VIRTUEMART_SEARCH_SELECT_MANUFACTURER') ?></option>
        <?php for ($i = 0; $i < $manufacturers; $i ++) : ?>
        <?php echo $orderMf[$i]; ?>
        <?php endfor; ?>
        <?php else : ?>
        <option selected="selected"><?php echo $orderMf[0]; ?></option>
        <?php for ($i = 0; $i < $manufacturers; $i ++) : ?>
        <?php echo $orderMf[$i + 1]; ?>
        <?php endfor; ?>
        <?php endif; ?>
        </select>
        <?php endif; ?>
      </div>
      <div class="col-sm-4 orderlistcontainer display-number text-right">
        <div class="title"><?php echo $this->vmPagination->getResultsCounter ();?></div>
        <?php echo $this->vmPagination->getLimitBox ($this->category->limit_list_step); ?>
      </div>
      <div class="col-xs-12 vm-pagination vm-pagination-top">
        <div class="row">
          <div class="col-xs-4 text-left small text-muted"><?php echo $this->vmPagination->getPagesCounter (); ?></div>
          <div class="col-xs-8"><?php echo str_replace('<ul>', '<ul class="pagination">', $this->vmPagination->getPagesLinks ()); ?></div>
        </div>
      </div>
  	</div> <!-- end of orderby-displaynumber -->
    <hr>
    <?php endif; ?>

    <?php	if (!empty($this->products))
    {
  		//revert of the fallback in the view.html.php, will be removed vm3.2
  		if($this->fallback){
  			$p = $this->products;
  			$this->products = array();
  			$this->products[0] = $p;
  			vmdebug('Refallback');
  		}

  	  echo shopFunctionsF::renderVmSubLayout($this->productsLayout,array('products'=>$this->products,'currency'=>$this->currency,'products_per_row'=>$this->perRow,'showRating'=>$this->showRating));

    }
    ?>

    <?php if (!empty($this->orderByList)) { ?>
    <hr>
  	<div class="vm-pagination vm-pagination-bottom text-center row">
  		<div class="vm-page-counter col-sm-3 small text-muted"><?php echo $this->vmPagination->getPagesCounter (); ?></div>
  		<div class="col-sm-9 text-right">
  	  <?php echo $this->vmPagination->getPagesLinks (); ?>
  		</div>
  	</div>
    <hr>
    <?php } ?>

  	<?php	if ($this->keyword !== false && empty($this->products)) { ?>
    <hr>
    <div class="alert alert-info">
    <?php echo vmText::_ ('COM_VIRTUEMART_NO_RESULT') . ($this->keyword ? ' : (' . $this->keyword . ')' : ''); ?>
    </div>
  	<?php } ?>

	</div> <!-- browse view end -->
  <?php } ?>
</div>
<?php
if(VmConfig::get ('ajax_category', false)){
	$j = "Virtuemart.container = jQuery('.category-view');
	Virtuemart.containerSelector = '.category-view';";

	vmJsApi::addJScript('ajax_category',$j);
	vmJsApi::jDynUpdate();
}
?>
<!-- end browse-view -->