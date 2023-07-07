<?php
/**
 *
 * Main product information
 *
 * @package    VirtueMart
 * @subpackage Product
 * @author Max Milbers
 * @todo Price update calculations
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: product_edit_information.php 10438 2021-01-22 07:18:16Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');


// set row counter
$i = 0;
?>
	<div class="uk-grid-match uk-grid-small uk-child-width-1-1" uk-grid>
		<div>
			<div class="uk-card   uk-card-small uk-card-vm">
				<div class="uk-card-header">
					<div class="uk-card-title">
				<span class="md-color-cyan-600 uk-margin-small-right"
						uk-icon="icon: info; ratio: 1.2"></span>
						<?php
						$parentRel = '';
						if ($this->product->product_parent_id) {
							$parentRel = vmText::sprintf('COM_VIRTUEMART_PRODUCT_FORM_PARENT', JHtml::_('link', JRoute::_('index.php?option=com_virtuemart&view=product&task=edit&virtuemart_product_id=' . $this->product->product_parent_id),
									($this->product_parent->product_name), array('title' => vmText::_('COM_VIRTUEMART_EDIT') . ' ' . $this->product_parent->product_name)) . ' =&gt; ');
						}
						echo vmText::sprintf('COM_VIRTUEMART_PRODUCT_INFORMATION', $parentRel);
						echo ' id: ' . $this->product->virtuemart_product_id ?>


					</div>
				</div>
				<div class="uk-card-body">
					<div class="uk-child-width-1-1 uk-child-width-1-3@xl uk-child-width-1-2@l" uk-grid>
						<div>
							<div class="uk-card">
								<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_PRODUCT_FORM_NAME', 'product_name', $this->product->product_name, $class = 'class="inputbox required input-xlarge"'); ?>
								<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_PRODUCT_SKU', 'product_sku', $this->product->product_sku); ?>
								<?php
								if (isset($this->lists['manufacturers'])) {
									echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_MANUFACTURER', $this->lists['manufacturers']);
								}

								$categories = '<select class="vm-drop" id="categories" name="categories[]" multiple="multiple"
						data-placeholder="' . vmText::_('COM_VIRTUEMART_DRDOWN_SELECT_SOME_OPTIONS') . '">
					<option value="-2" selected="selected">Do not store</option>
				</select>';
								echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_CATEGORY_S', $categories);

								$this->categoryTree = ShopFunctions::categoryListTree($this->product->product_canon_category_id);
								$canonical = '<select class="vm-drop" id="product_canon_category_id" name="product_canon_category_id"
						value="' . $this->product->product_canon_category_id . '" size="10">
					<option value="">No override</option>
					' . $this->categoryTree . '
				</select>';
								echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_PRODUCT_FORM_CANONICAL_CATEGORY', $canonical);


								?>

							</div>
						</div>
						<div>
							<div class="uk-card">
								<?php
								echo VmuikitHtml::row('checkbox', 'COM_VIRTUEMART_PUBLISHED', 'published', $this->product->published);
								echo VmuikitHtml::row('checkbox', 'COM_VIRTUEMART_PRODUCT_FORM_SPECIAL', 'product_special', $this->product->product_special);
								echo VmuikitHtml::row('checkbox', 'COM_VIRTUEMART_PRODUCT_FORM_DISCONTINUED', 'product_discontinued', $this->product->product_discontinued);
								echo VmuikitHtml::row('input', 'COM_VIRTUEMART_PRODUCT_GTIN', 'product_gtin', $this->product->product_gtin);

								echo VmuikitHtml::row('selectList', 'COM_VIRTUEMART_PRODUCT_DETAILS_PAGE', 'layout', $this->product->layout, $this->productLayouts);
								echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_SHOPPER_FORM_GROUP', $this->shoppergroupList);
								?>


							</div>
						</div>
						<div>
							<div class="uk-card">
								<?php echo VmuikitHtml::row('input', vmText::_('COM_VIRTUEMART_PRODUCT_FORM_ALIAS') . ' ' . $this->origLang, 'slug', $this->product->slug); ?>
								<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_PRODUCT_MPN', 'product_mpn', $this->product->product_mpn); ?>
								<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_PRODUCT_FORM_URL', 'product_url', $this->product->product_url); ?>
								<?php echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_VENDOR', $this->lists['vendors']); ?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Product pricing -->
		<div class="">

			<div class="uk-card   uk-card-small uk-card-vm">
				<div class="uk-card-header">
					<div class="uk-card-title">
						<div class="uk-grid-collapse" uk-grid>
							<div class="uk-width-expand">
								<div class="">
									<span class="md-color-cyan-600 uk-margin-small-right"
											uk-icon="icon: tag; ratio: 1.2"></span>
									<?php
									echo vmText::sprintf('COM_VIRTUEMART_PRODUCT_FORM_PRICES', $this->activeShoppergroups);
									if ($this->deliveryCountry) {
										?>
										<span class="uk-margin-small-left">
									<?php
										echo vmText::sprintf('COM_VIRTUEMART_PRODUCT_FORM_PRICES_COUNTRY', $this->deliveryCountry);
										?>
										</span>
									<?php
									}
									if ($this->deliveryState) {
									?>
									<span class="uk-margin-small-left">
									<?php
										echo vmText::sprintf('COM_VIRTUEMART_PRODUCT_FORM_PRICES_STATE', $this->deliveryState);
									?>
										</span>
										<?php
									}
									?>
								</div>
							</div>

						</div>

					</div>
				</div>

				<div class="uk-card-body">
						<?php
						//$product = $this->product;

						if (empty($this->product->prices)) {
							$this->product->prices[] = array();
						}
						$this->i = 0;
						$rowColor = 0;

						$calculator = $this->calculator;
						$currency_model = VmModel::getModel ('currency');
						$currencies = $currency_model->getCurrencies ();

						$nbPrice = is_array($this->product->allPrices)? count ($this->product->allPrices):0;
						$this->priceCounter = 0;
						$this->product->allPrices[$nbPrice] = VmModel::getModel()->fillVoidPrice();


						?>
						<table  id="mainPriceTable" class="uk-table uk-table-xsmall uk-table-responsive  ">
							<tbody id="productPriceBody">
							<?php

							foreach ($this->product->allPrices as $k => $sPrices) {
								if ($this->priceCounter == $nbPrice) {
									$tmpl = "productPriceRowTmpl";
									$this->product->allPrices[$k]['virtuemart_product_price_id'] = '';
									$class="vm-chzn-add";
								} else {
									$tmpl = "productPriceRowTmpl_" . $this->priceCounter;
									$class="vm-chzn-select";
								}

								if(empty($this->product->allPrices[$k]['product_currency'])){
									$this->product->allPrices[$k]['product_currency'] = $this->vendor->vendor_currency;
								}

								$this->product->selectedPrice = $k;
								$this->calculatedPrices = $calculator->getProductPrices ($this->product);
								$this->product->allPrices[$k] = array_merge($this->product->allPrices[$k],$this->calculatedPrices);

								$currency_model = VmModel::getModel ('currency');
								$this->lists['currencies'] = JHtml::_ ('select.genericlist', $currencies, 'mprices[product_currency][]', 'class="'.$class.'"', 'virtuemart_currency_id', 'currency_name', $this->product->allPrices[$k]['product_currency'],'[');

								$DBTax = ''; //vmText::_('COM_VIRTUEMART_RULES_EFFECTING') ;
								foreach ($calculator->rules['DBTax'] as $rule) {
									$DBTax .= $rule['calc_name'] . '<br />';
								}
								$this->DBTaxRules = $DBTax;

								$tax = ''; //vmText::_('COM_VIRTUEMART_TAX_EFFECTING').'<br />';
								foreach ($calculator->rules['Tax'] as $rule) {
									$tax .= $rule['calc_name'] . '<br />';
								}
								foreach ($calculator->rules['VatTax'] as $rule) {
									$tax .= $rule['calc_name'] . '<br />';
								}
								$this->taxRules = $tax;

								$DATax = ''; //vmText::_('COM_VIRTUEMART_RULES_EFFECTING');
								foreach ($calculator->rules['DATax'] as $rule) {
									$DATax .= $rule['calc_name'] . '<br />';
								}
								$this->DATaxRules = $DATax;

								if (!isset($this->product->product_tax_id)) {
									$this->product->product_tax_id = 0;
								}
								if (!isset($this->product->allPrices[$k]['product_tax_id'])) {
									$this->product->allPrices[$k]['product_tax_id'] = 0;
								}
								$this->lists['taxrates'] = ShopFunctions::renderTaxList ($this->product->allPrices[$k]['product_tax_id'], 'mprices[product_tax_id][]','class="'.$class.'"');
								if (!isset($this->product->allPrices[$k]['product_discount_id'])) {
									$this->product->allPrices[$k]['product_discount_id'] = 0;
								}
								$this->lists['discounts'] = $this->renderDiscountList ($this->product->allPrices[$k]['product_discount_id'], 'mprices[product_discount_id][]');

								$this->lists['shoppergroups'] = ShopFunctions::renderShopperGroupList ($this->product->allPrices[$k]['virtuemart_shoppergroup_id'], false, 'mprices[virtuemart_shoppergroup_id][]', 'COM_VIRTUEMART_DRDOWN_AVA2ALL',array('class'=>$class));



								?>
								<tr id="<?php echo $tmpl ?>" class="removable row<?php echo $rowColor?>">
									<td width="100%">
										<div class="uk-grid uk-grid-small uk-grid-divider uk-flex uk-flex-right"
												uk-grid>
											<div class="uk-width-auto uk-text-right">
												<div class="uk-sortable-handle uk-link price_ordering"
														uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_PRICE_SORTABLE') ?>">
													<span class="" uk-icon="icon: move; ratio: 0.75"></span>
												</div>
											</div>
											<div class="uk-width-auto uk-text-right">
												<div class="uk-link price-remove"
														uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_PRICE_REMOVE') ?>">
													<span class="" uk-icon="icon: trash; ratio: 0.75"></span>
												</div>
											</div>
										</div>
										<!--
										<span class="vmicon vmicon-16-move price_ordering"></span>
										<?php /* <span class="vmicon vmicon-16-new price-clone" ></span> */ ?>
										<span class="vmicon vmicon-16-remove price-remove"></span>
										<?php //echo vmText::_ ('COM_VIRTUEMART_PRODUCT_PRICE_ORDER');?>
										-->
										<?php echo $this->loadTemplate ('price'); ?>
									</td>
								</tr>
								<?php
								$this->priceCounter++;
							}
							?>
							</tbody>
						</table>


				</div>

				<div class="uk-card-footer">
					<div>

						<a  class="uk-button uk-button-small uk-button-primary" href="#" id="add_new_price"
								uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_ADD_PRICE') ?>">
							<span class="uk-margin-small-right" uk-icon="icon: plus; ratio: 1"></span><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_ADD_PRICE') ?>
						</a>
					</div>
				</div>

			</div>
		</div>


		<!-- /Product pricing -->

		<!-- add_child_button -->
		<?php

		if ($this->product->virtuemart_product_id) {
			$link = JRoute::_('index.php?option=com_virtuemart&view=product&task=createChild&virtuemart_product_id=' . $this->product->virtuemart_product_id . '&' . JSession::getFormToken() . '=1');
			$add_child_button = "";
		} else {
			$link = "";
			$add_child_button = " not-active";
		}
		?>
		<div class="">
			<div class="uk-card   uk-card-small uk-card-vm">
				<div class="uk-card-header">
					<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: tree; ratio: 1.2"></span>
						<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_CHILD'); ?>
					</div>
				</div>
				<div class="uk-card-body">
					<div class="uk-margin-small <?php echo $add_child_button ?> ">
						<div class="blank">
							<?php
							if ($link) {
							?>
							<a href="<?php echo $link ?>" class="uk-button uk-button-small uk-button-primary">
								<?php
								} else {
								?>
								<span uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_ADD_CHILD_TIP') ?>">
						<?php
						}
						?>
						<span class="uk-margin-small-right" uk-icon="icon: plus; ratio: 1"></span><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_ADD_CHILD') ?>

						<?php
						if ($link) {
						?>
							</a>
						<?php
						}
						?>
						</div>
					</div>

					<?php
					echo VmuikitHtml::row('input', 'COM_VIRTUEMART_PRODUCT_PARENTID', 'product_parent_id', $this->product->product_parent_id);
					?>

				</div>
			</div>
		</div>

		<!-- /add_child_button -->


		<div class=" ">
			<div class="uk-card   uk-card-small uk-card-vm">
				<div class="uk-card-header">
					<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: lock; ratio: 1.2"></span>
						<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_PRINT_INTNOTES'); ?>
					</div>
				</div>
				<div class="uk-card-body">
					<?php
					echo VmuikitHtml::row('textarea', 'COM_VIRTUEMART_PRODUCT_PRINT_INTNOTES', 'intnotes', $this->product->intnotes,'class="uk-textarea"');
					?>


				</div>
			</div>
		</div>
	</div>


<?php

$j = 'jQuery(document).ready(function ($) {
        jQuery("#mainPriceTable").dynoTable({
            removeClass: ".price-remove", //remove class name in  table
            cloneClass: ".price-clone", //Custom cloner class name in  table
            addRowTemplateId: "#productPriceRowTmpl", //Custom id for  row template
            addRowButtonId: "#add_new_price", //Click this to add a price
            lastRowRemovable:true, //let the table be empty.
            orderable:true, //prices can be rearranged
            dragHandleClass: ".price_ordering", //class for the click and draggable drag handle
            onRowRemove:function () {
            },
            onRowClone:function () {
            },
            onRowAdd:function () {
            },
            onTableEmpty:function () {
            },
            onRowReorder:function () {
            }
        });
    });';
vmJsApi::addJScript('dynotable_ini',$j);
?>


