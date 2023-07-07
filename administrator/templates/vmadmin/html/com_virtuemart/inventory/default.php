<?php
/**
 *
 * @package    VirtueMart
 * @subpackage
 * @author Max Milbers
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default.php 10451 2021-01-27 08:16:53Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$adminTemplate = VMPATH_ROOT . '/administrator/templates/vmadmin/html/com_virtuemart/';
JLoader::register('vmuikitAdminUIHelper', $adminTemplate . 'helpers/vmuikit_adminuihelper.php');
vmuikitAdminUIHelper::startAdminArea($this);
?>
<form action="index.php?option=com_virtuemart&view=inventory" method="post" name="adminForm" id="adminForm">
	<div id="filterbox" class="filter-bar">
		<?php
		$extras = array();
		$extras[] = $this->lists['stockfilter'];
		echo adminSublayouts::renderAdminVmSubLayout('filterbar',
			array(
				'search' => array(
					'label' => 'COM_VIRTUEMART_NAME',
					'name' => 'filter_product',
					'value' => vRequest::getVar('filter_product')
				),
				'extras' => $extras,
				'resultsCounter' => $this->pagination->getResultsCounter()
			));
		?>
	</div>
	<div id="editcell">
		<table class="uk-table uk-table-small uk-table-striped uk-table-responsive">
			<thead>
			<tr>
				<th><input type="checkbox" name="toggle" value=""
							onclick="Joomla.checkAll(this)"/></th>
				<th><?php echo $this->sort('product_name') ?></th>
				<th class="uk-text-center@m"><?php echo $this->sort('product_sku') ?></th>
				<th class="uk-text-right@m"><?php echo $this->sort('product_in_stock', 'COM_VIRTUEMART_PRODUCT_FORM_IN_STOCK') ?></th>
				<th class="uk-text-right@m uk-table-shrink"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_ORDERED_STOCK') ?> </th>
				<th class="uk-text-right@m"><?php echo $this->sort('product_price', 'COM_VIRTUEMART_PRODUCT_FORM_PRICE_COST') ?></th>
				<th class="uk-text-right@m"><?php echo $this->sort('product_price', 'COM_VIRTUEMART_PRODUCT_INVENTORY_PRICE') ?></th>
				<th class="uk-text-right@m"><?php echo $this->sort('product_weight', 'COM_VIRTUEMART_PRODUCT_INVENTORY_WEIGHT') ?></th>
				<th><?php echo $this->sort('published') ?></th>
			</tr>
			</thead>
			<tbody>
			<?php
			if (count($this->inventorylist) > 0) {
				$i = 0;
				$k = 0;
				$keyword = vRequest::uword('keyword', "", ' ,-,+,.,_,#,/');
				foreach ($this->inventorylist as $key => $product) {
					$checked = JHtml::_('grid.id', $i, $product->virtuemart_product_id);
					$published = $this->gridPublished($product, $i);

					//<!-- low_stock_notification  -->
					if ($product->product_in_stock - $product->product_ordered < 1) {
						$stockstatut = "out";
					} elseif ($product->product_in_stock - $product->product_ordered < $product->low_stock_notification) {
						$stockstatut = "low";
					} else {
						$stockstatut = "normal";
					}

					//$stockstatut = 'class="uk-text-center@m stock-' . $stockstatut . '" title="' . vmText::_('COM_VIRTUEMART_STOCK_LEVEL_' . $stockstatut) . '"';
					?>
					<div class="row<?php echo $k; ?>">
						<!-- Checkbox -->
						<td ><?php echo $checked; ?></td>
						<!-- Product name -->
						<?php
						$link = 'index.php?option=com_virtuemart&view=product&task=edit&virtuemart_product_id=' . $product->virtuemart_product_id . '&product_parent_id=' . $product->product_parent_id;
						?>
						<td>
							<div class="uk-label uk-label-vm stock-<?php echo $stockstatut ?> uk-width-1-1">
							<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
									uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_NAME') ?>"
									uk-icon="icon: info"></span>
							<?php echo JHtml::_('link', JRoute::_($link, FALSE), $product->product_name, array('title' => vmText::_('COM_VIRTUEMART_EDIT') . ' ' . htmlentities($product->product_name))); ?></td>
					</div>
						<td class="uk-text-center@m">
							<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
									uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_SKU') ?>"
									uk-icon="icon: barcode"></span>
							<?php echo $product->product_sku; ?></td>
						<td class="uk-text-right@m">
							<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
									uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_IN_STOCK') ?>"
									uk-icon="icon: inventory"></span>
							<span uk-tooltip="<?php echo  vmText::_('COM_VIRTUEMART_STOCK_LEVEL_' . $stockstatut) ?>" class="uk-label stock-<?php echo $stockstatut ?>"><?php echo $product->product_in_stock; ?></span></td>
						<td class="uk-text-right@m" >
							<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
									uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_ORDERED_STOCK') ?>"
									uk-icon="icon: cart"></span>
							<span uk-tooltip="<?php echo  vmText::_('COM_VIRTUEMART_STOCK_LEVEL_' . $stockstatut) ?>" class="uk-label stock-<?php echo $stockstatut ?>"><?php echo $product->product_ordered; ?></span></td>
						<td class="uk-text-right@m">
							<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
									uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_PRICE_COST') ?>"
									uk-icon="icon: tag"></span>
							<?php echo $product->product_price_display; ?></td>
						<td class="uk-text-right@m">
							<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
									uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_INVENTORY_PRICE') ?>"
									uk-icon="icon: calculator"></span>
							<?php echo $product->product_instock_value; ?></td>
						<td class="uk-text-right@m">
							<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
									uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_INVENTORY_WEIGHT') ?>"
									uk-icon="icon: weight"></span>
							<?php echo $product->product_weight . " " . $product->weigth_unit_display; ?></td>
						<td class="uk-text-center@m">
							<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
									uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PUBLISHED') ?>"
									uk-icon="icon: eye"></span>
							<?php echo $published; ?></td>
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
	</div>
	<!-- Hidden Fields -->
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['filter_order']; ?>"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['filter_order_Dir']; ?>"/>
	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="option" value="com_virtuemart"/>
	<input type="hidden" name="view" value="inventory"/>
	<input type="hidden" name="boxchecked" value="0"/>
	<?php echo JHtml::_('form.token'); ?>
</form>
<?php AdminUIHelper::endAdminArea(); ?>