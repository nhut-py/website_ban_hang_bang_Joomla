<?php
/**
*
* Description
*
* @package	VirtueMart
* @subpackage   ratings
* @author
* @link https://virtuemart.net
* @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: default.php 10424 2021-01-14 09:24:33Z alatak $
*/

// @todo a link or tooltip to show the details of shop user who posted comment
// @todo more flexible templating, theming, etc..

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$adminTemplate = VMPATH_ROOT . '/administrator/templates/vmadmin/html/com_virtuemart/';
JLoader::register('vmuikitAdminUIHelper', $adminTemplate . 'helpers/vmuikit_adminuihelper.php');
vmuikitAdminUIHelper::startAdminArea($this);
/* Get the component name */
$option = vRequest::getCmd('option');
?>
<form action="index.php?option=com_virtuemart&view=ratings" method="post" name="adminForm" id="adminForm">

	<div id="filterbox" class="filter-bar">
		<?php
		$extras=array();
		if ($this->showVendors()) {
			$extras[]=Shopfunctions::renderVendorList(vmAccess::getVendorId());
		}
$extras[]=
	JText::_('COM_PROVMTOOLS_FILTER_PRODUCT').
	'
<input type="text" class="ui-autocomplete-input" id="product_filter" name="virtuemart_product_id" value="">
<button type="submit" class="reset-value btn" id="product_filter_submit" name="product_filter_submit">'.JText::_('COM_PROVMTOOLS_BTN_RESET').'</button>
';

		echo adminSublayouts::renderAdminVmSubLayout('filterbar',
			array(
				'search'=>array(
					'label'=>'COM_VIRTUEMART_FILTER',
					'name'=>'filter_ratings',
					'value'=>vRequest::getVar('filter_ratings')
				),
				'extras'=>$extras,
				'resultsCounter'=>$this->pagination->getResultsCounter()
			));


		?>
	</div>

	<table class="uk-table uk-table-striped uk-table-responsive">
	<thead>
	<tr>
		<th><input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this)" /></th>
		<th width="40%"><?php echo $this->sort('created_on', 'COM_VIRTUEMART_DATE') ; ?></th>
		<th width="40%"><?php echo $this->sort('product_name') ; ?></th>
		<th width="20%"><?php echo vmText::_('COM_VIRTUEMART_REVIEW_LANGUAGE') ; ?></th>
		<th width="10%"><?php echo $this->sort('rating', 'COM_VIRTUEMART_RATE_NOM') ; ?></th>
		<th width="20"><?php echo $this->sort('published') ?></th>
	</tr>
	</thead>
	<tbody>
	<?php
	if (count($this->ratingslist) > 0) {
		$i = 0;
		$k = 0;
		$keyword = vRequest::getCmd('keyword');
		foreach ($this->ratingslist as $key => $review) {

			$checked = JHtml::_('grid.id', $i , $review->virtuemart_rating_id);
			$published = $this->gridPublished( $review, $i );
			?>
			<tr class="row<?php echo $k ; ?>">
				<!-- Checkbox -->
				<td><?php echo $checked; ?></td>
				<!-- Username + time -->
				<?php $link = 'index.php?option='.$option.'&view=ratings&task=listreviews&virtuemart_product_id='.$review->virtuemart_product_id; ?>
				<td><?php echo JHtml::_('link', $link,vmJsApi::date($review->created_on,'LC2',true) , array("title" => vmText::_('COM_VIRTUEMART_RATING_EDIT_TITLE'))); ?></td>
				<!-- Product name -->
				<?php $link = 'index.php?option='.$option.'&view=product&task=edit&virtuemart_product_id='.$review->virtuemart_product_id ; ?>
				<td><?php echo JHtml::_('link', JRoute::_($link), $review->product_name, array('title' => vmText::_('COM_VIRTUEMART_EDIT').' '.htmlentities($review->product_name))); ?></td>
				<!-- Stars language -->
				<td width="20%" class="review_language_td_<?php echo $key?>"><?php				
				$modelConfig = VmModel::getModel('config');
				$activeVMLangs = $modelConfig->getActiveVmLanguages();

				echo '<select name="review_language" style="max-width: 100px;" id="sel-review-'.$review->virtuemart_rating_review_id.'" data-rating-review-id="'.$review->virtuemart_rating_review_id.'" class="review_language_select">';
				echo '<option  value="">'.vmText::_('COM_VIRTUEMART_NO_SPECIFIC_LANGUAGE_SELECTED').'</option >';
				foreach ($activeVMLangs as $key => $activeVMLang) {
				    
				    $selected = '';
				    
				    $activeVMLang = strtolower(str_replace('-', '_', $activeVMLang));
				    
				    if($review->review_language == $activeVMLang)  $selected = 'selected="selected"';
				    echo '<option  value="'.$activeVMLang.'::'.$review->virtuemart_rating_id.'" '.$selected.'>'.$activeVMLang.'</option >';
				    
				}
				
				
				echo '</select>';
				
				?></td>				
				<!-- Stars rating -->
				<td align="center">
					
					<?php // Rating Stars output
					$maxrating = VmConfig::get('vm_maximum_rating_scale', 5);
				    $ratingwidth = round($review->rating) * 24;
				    ?>
	
				    <span title="<?php echo (vmText::_("COM_VIRTUEMART_RATING_TITLE").' '. round($review->rating) . '/' . $maxrating) ?>" class="ratingbox" style="display:inline-block;">
						<span class="stars-orange" style="width:<?php echo $ratingwidth.'px'; ?>">
						</span>
				    </span>

				</td>
				<!-- published -->
				<td><?php echo $published; ?></td>
			</tr>
		<?php
			$k = 1 - $k;
			$i++;
		}
	}
	?>
	</tbody>
	<tfoot>
		<tr>
		<td colspan="16">
			<?php echo $this->pagination->getListFooter(); ?>
		</td>
		</tr>
	</tfoot>
	</table>

<!-- Hidden Fields -->
	<?php echo $this->addStandardHiddenToForm(); ?>
</form>
<?php
$js = "
jQuery('input#product_filter' ).keyup(function() {
        var search = this.value;
        jQuery.ajax({
            type: 'POST',
            url: 'index.php?option=com_virtuemart&view=product&task=getData&format=json&type=relatedproducts',
            data: {
                term: search
                }
            }).done(function(msg) {
            jQuery( '#product_filter' ).autocomplete({
                source: msg,
                minLength:2,
                select: function(event, ui) {
                    window.location.href = 'index.php?option=com_virtuemart&view=ratings&task=listreviews&virtuemart_product_id='+ui.item.id;
                },
                delay: 400,
                html: true
            });
        });
    
});
jQuery('.reset-value').click( function(e){
    e.preventDefault();
    none = '';
    jQuery(this).parent().find('.ui-autocomplete-input').val(none);
});
jQuery('.review_language_select').change(function () {
    var ratingReviewId = jQuery(this).data('rating-review-id');
    //jQuery('#button'+this.id).remove();    
    //jQuery( '<button type=\"submit\" id=\"button'+this.id+'\" class=\"btn update-review-lang\">Save</button>' ).insertAfter( 'select#'+this.id );
    var selLang = jQuery('#'+this.id).find(':selected').text();
    jQuery.ajax({
        type: 'POST',
        url: 'index.php?option=com_virtuemart&view=ratings&task=updateReviewLang&format=json',
        data: {
            ratingReviewId: ratingReviewId,
            selLang: selLang
        }
        }).done(function(data) {

           jQuery( '<span class=\"review-msg-'+data.id+'\" style=\"color: green; font-weight: bold;\"> '+data.msg+' </span>' ).insertAfter('#sel-review-'+data.id );
           jQuery('.review-msg-'+data.id).delay(1000).fadeOut(500);

    });

});


";
vmJsApi::addJScript('provmtools', $js);
AdminUIHelper::endAdminArea(); ?>


