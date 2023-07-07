<?php
/**
 *
 * Description product view
 *
 * @package    VirtueMart
 * @subpackage
 * @author Max Milbers, Claes Norin, Valérie Isaksen
 * @link https://virtuemart.net
 * @release 3.8
 * @copyright Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @revision $Rev
 * @version $Id: default.php 10451 2021-01-27 08:16:53Z alatak $
 *
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$adminTemplate = VMPATH_ROOT . '/administrator/templates/vmadmin/html/com_virtuemart/';
JLoader::register('vmuikitAdminUIHelper', $adminTemplate . 'helpers/vmuikit_adminuihelper.php');
vmuikitAdminUIHelper::startAdminArea($this);

/* Load some variables */

$multipleCats = '';
if (VmConfig::get('AllowMultipleCatsFilter', false)) {
	$multipleCats = 'multiple="multiple"';
}
// OSP in view.html.php $virtuemart_category_id = vRequest::getInt('virtuemart_category_id', false);
if ($product_parent_id = vRequest::getInt('product_parent_id', false)) {
	$col_product_name = 'COM_VIRTUEMART_PRODUCT_CHILDREN_LIST';
} else {
	$col_product_name = 'COM_VIRTUEMART_PRODUCT_NAME';
}

?>
	<form action="index.php?option=com_virtuemart&view=product" method="post" name="adminForm" id="adminForm">
		<div id="filterbox" class="filter-bar">
			<?php
			$extras=array();
			$extras[]='
							<select class="changeSendForm inputbox"
						id="virtuemart_category_id" '.$multipleCats.' name="virtuemart_category_id[]"
						value="0">
					<option value="">'.vmText::sprintf('COM_VIRTUEMART_UNSELECT', vmText::_('COM_VIRTUEMART_CATEGORY')).'</option>
				</select>
			';
			$extras[]=JHtml::_('select.genericlist', $this->manufacturers, 'virtuemart_manufacturer_id', 'class="inputbox" onchange="document.adminForm.submit(); return false;"', 'value', 'text',
				$this->model->virtuemart_manufacturer_id);

			$extras[]=$this->lists['published'];
			$extras[]=$this->lists['search_type'];
			$extras[]=$this->lists['search_order'];
			$extras[]=vmJsApi::jDate($this->search_date, 'search_date');
			$extras[]=$this->lists['customlist'];
			$extras[]=$this->lists['vendors'];
			echo adminSublayouts::renderAdminVmSubLayout('filterbar',
				array(
					'search'=>array(
						'label'=>'COM_VIRTUEMART_PRODUCT_LIST_SEARCH_BY_DATE',
						'name'=>'search',
						'value'=>vRequest::getVar('search')
					),
					'extras'=>$extras,
					'resultsCounter'=>$this->pagination->getResultsCounter(),
					'limitBox'=>$this->pagination->getLimitBox()
				));
			?>
		</div>

			<?php
			// $this->productlist
			$mediaLimit = (int)VmConfig::get('mediaLimit', 20);
			$total = $this->pagination->total;
			$totalList = count($this->productlist);
			if ($this->pagination->limit <= $mediaLimit or $totalList <= $mediaLimit) {
				$imgWidth = 90;
			} else {
				$imgWidth = 30;
			}


			?>
			<table class="uk-table uk-table-small uk-table-striped uk-table-responsive">
				<thead>
				<tr>
					<th>
						<input type="checkbox" name="toggle" value=""
								onclick="Joomla.checkAll(this)"/></th>

					<th ><?php echo $this->sort('product_name', $col_product_name) ?> </th>
					<?php if (!$product_parent_id) { ?>
						<th class="uk-table-shrink"><?php echo $this->sort('product_parent_id', 'COM_VIRTUEMART_PRODUCT_CHILDREN_OF'); ?></th>
					<?php } ?>
					<th class="uk-table-shrink"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_PARENT_LIST_CHILDREN'); ?></th>
					<th class="uk-table-shrink"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_MEDIA'); ?></th>
					<th><?php echo $this->sort('`p`.product_sku', 'COM_VIRTUEMART_PRODUCT_SKU') ?></th>
					<th ><?php echo $this->sort('product_price', 'COM_VIRTUEMART_PRODUCT_PRICE_TITLE'); ?></th>
					<?php /*		<th><?php echo JHtml::_('grid.sort', 'COM_VIRTUEMART_CATEGORY', 'c.category_name', $this->lists['filter_order_Dir'], $this->lists['filter_order'] ); ?></th> */ ?>
					<th class="uk-table-shrink"><?php echo vmText::_('COM_VIRTUEMART_CATEGORY'); ?></th>
					<!-- Only show reordering fields when a category ID is selected! -->
					<?php
					$num_rows = 0;
					if ($this->showOrdering) { ?>
						<th >
							<?php echo $this->sort('pc.ordering', 'COM_VIRTUEMART_FIELDMANAGER_REORDER'); ?>
							<?php echo JHtml::_('grid.order', $this->productlist); //vmCommonHTML::getSaveOrderButton( $num_rows, 'changeordering' ); ?>
						</th>
					<?php } ?>
					<th ><?php echo $this->sort('mf_name', 'COM_VIRTUEMART_MANUFACTURER_S'); ?></th>
					<th class="uk-text-center@m"><?php echo vmText::_('COM_VIRTUEMART_REVIEW_S'); ?></th>
					<th class="uk-table-shrink"><?php echo $this->sort('product_special', 'COM_VIRTUEMART_PRODUCT_FORM_SPECIAL'); ?> </th>
					<th class="uk-text-center@m"><?php echo $this->sort('published'); ?></th>
					<th class="uk-text-center@m"><?php echo $this->sort('p.virtuemart_product_id', 'COM_VIRTUEMART_ID') ?></th>
				</tr>
				</thead>
				<tbody>
				<?php


				if ($totalList) {
					$i = 0;
					$k = 0;
					$keyword = vRequest::getCmd('keyword');
					foreach ($this->productlist as $key => $product) {
						$checked = JHtml::_('grid.id', $i, $product->virtuemart_product_id, null, 'virtuemart_product_id');
						//$published = JHtml::_('grid.published', $product, $i );
						$published = $this->gridPublished($product, $i);

						$is_featured = $this->toggle($product->product_special, $i, 'toggle.product_special');
						$link = 'index.php?option=com_virtuemart&view=product&task=edit&virtuemart_product_id=' . $product->virtuemart_product_id;
						?>
						<tr class="row<?php echo $k; ?>">
							<!-- Checkbox -->
							<td><?php echo $checked; ?></td>

							<td >
								<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
										uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_NAME') ?>"
										uk-icon="icon: info"></span>
								<?php
								if (empty($product->product_name)) {
									$product->product_name = vmText::sprintf('COM_VM_TRANSLATION_MISSING', 'virtuemart_product_id', $product->virtuemart_product_id);
								}
								echo JHtml::_('link', JRoute::_($link), vRequest::vmHtmlEntities($product->product_name), array('title' => vmText::_('COM_VIRTUEMART_EDIT') . ' ' . vRequest::vmHtmlEntities($product->product_name))); ?>

							</td>

							<?php if (!$product_parent_id) { ?>
								<td>
									<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
											uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_CHILDREN_OF') ?>"
											uk-icon="icon: tree"></span>
									<?php
									//if ($product->product_parent_id  ) {
									echo $product->parent_link;
									//}
									?></td>
							<?php } ?>
							<td class="">
								<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
										uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_PARENT_LIST_CHILDREN') ?>"
										uk-icon="icon: tree"></span>
								<?php
								echo $product->childlist_link;
								?>
							</td>
							<!-- Media -->
							<?php
							// Create URL
							$link = JRoute::_('index.php?view=media&virtuemart_product_id=' . $product->virtuemart_product_id . '&option=com_virtuemart');
							?>
							<td >
								<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
										uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_MEDIA') ?>"
										uk-icon="icon: image"></span>
								<?php
								// We show the images only when less than 21 products are displayeed -->

								if ($this->pagination->limit <= $mediaLimit or $totalList <= $mediaLimit) {
									// Product list should be ordered
									$this->model->addImages($product, 1);
									$img = '<span >(' . $product->mediaitems . ')</span>' . $product->images[0]->displayMediaThumb('class="vm_mini_image"', false);
									//echo JHtml::_('link', $link, $img,  array('title' => vmText::_('COM_VIRTUEMART_MEDIA_MANAGER').' '.$product->product_name));
								} else {
									//echo JHtml::_('link', $link, '<span class="icon-nofloat vmicon vmicon-16-media"></span> ('.$product->mediaitems.')', array('title' => vmText::_('COM_VIRTUEMART_MEDIA_MANAGER').' '.$product->product_name) );
									$img = '<span class="icon-nofloat vmicon vmicon-16-media"></span> (' . $product->mediaitems . ')';
								}
								echo JHtml::_('link', $link, $img, array('title' => vmText::_('COM_VIRTUEMART_MEDIA_MANAGER') . ' ' . vRequest::vmHtmlEntities($product->product_name)));
								?>
							</td>
							<!-- Product SKU -->
							<td>
								<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
										uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_SKU') ?>"
										uk-icon="icon: barcode"></span>
								<?php echo $product->product_sku; ?></td>
							<!-- Product price -->
							<td >
								<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
										uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_PRICE_TITLE') ?>"
										uk-icon="icon: tag"></span>
								<?php
								if (isset($product->product_price_display)) {
										echo $product->product_price_display;
								}
								?>
							</td>
							<!-- Category name -->
							<td>
								<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
										uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_CATEGORY') ?>"
										uk-icon="icon: category"></span>
								<?php
								echo $product->categoriesList;
								//  show canonical category if set
								if (!empty($product->product_canon_category_id) && $product->product_canon_category_id > 0) {
									echo '<p style = "color:red;">CanonCat: ' . $product->canonCatIdname . '</p>';
								}
								?>
							</td>
                            <!-- Reorder only when category ID is present -->
                            <?php if ($this->showOrdering ) { ?>
                                <td class="order" >

						<?php if($this->showOrdering == $product->virtuemart_category_id){
							?>
							<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
									uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_FIELDMANAGER_REORDER') ?>"
									uk-icon="icon: arrow-up"></span>
								<?php
							if($this->showDrag){ ?>
								<span class="vmicon vmicon-16-move"></span>
							<?php }
							/* ?>
							<span><?php echo $this->pagination->vmOrderUpIcon( $i, $product->ordering, 'orderup', vmText::_('COM_VIRTUEMART_MOVE_UP')  ); ?></span>
							<span><?php echo $this->pagination->vmOrderDownIcon( $i, $product->ordering, ($total * 5)-3, true, 'orderdown', vmText::_('COM_VIRTUEMART_MOVE_DOWN') ); ?></span>
							*/ ?>
							<input class="ordering" type="text" name="order[<?php echo $product->virtuemart_product_id?>]" id="order[<?php echo $i?>]" size="5" value="<?php echo $product->ordering; ?>" style="text-align: center" />
						<?php } ?>
					</td>
				<?php } ?>
				<!-- Manufacturer name -->
				<td>
					<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
							uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_MANUFACTURER_S') ?>"
							uk-icon="icon: manufacturer"></span>

					<?php
					echo $product->manuList;

								?>
							</td>

							<!-- Reviews -->
							<?php $link = vRequest::vmSpecialChars('index.php?option=com_virtuemart&view=ratings&task=listreviews&virtuemart_product_id=' . $product->virtuemart_product_id); ?>
							<td class="uk-text-center@m">
								<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
										uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_REVIEW_S') ?>"
										uk-icon="icon: comments"></span>

								<?php echo JHtml::_('link', $link, $product->reviews); ?></td>
							<td class="uk-text-center@m">
								<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
										uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_SPECIAL') ?>"
										uk-icon="icon: heart"></span>
								<?php
								echo $is_featured;
								?>
							</td>
							<!-- published -->
							<td class="uk-text-center@m">
								<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
										uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PUBLISHED') ?>"
										uk-icon="icon: eye"></span>

								<?php echo $published; ?></td>
							<!-- Vendor name -->
							<td class="uk-text-center@m">
								<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
										uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_ID') ?>"
										uk-icon="icon: hashtag"></span>

								<?php echo $product->virtuemart_product_id; // echo $product->vendor_name; ?>
							</td>
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
						<?php echo $this->pagination->getListFooter(false); ?>
					</td>
				</tr>
				</tfoot>
			</table>

		<!-- Hidden Fields -->
		<input type="hidden" name="product_parent_id" value="<?php echo vRequest::getInt('product_parent_id', 0); ?>"/>
		<?php echo $this->addStandardHiddenToForm(); ?>
	</form>

<?php vmuikitAdminUIHelper::endAdminArea();

// DONE BY stephanbais
/// DRAG AND DROP PRODUCT ORDER HACK
if ($this->showOrdering && $this->showDrag) {
	vmJsApi::addJScript('/administrator/components/com_virtuemart/assets/js/products.js', false, false);
	vmJsApi::addJScript('sortable', 'Virtuemart.sortable;');
}

/// END PRODUCT ORDER HACK
?>