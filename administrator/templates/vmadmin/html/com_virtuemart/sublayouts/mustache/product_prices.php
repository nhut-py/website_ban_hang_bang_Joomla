<?php
/**
 *
 * @package VirtueMart
 * @subpackage Mustache template
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * @version $Id: product_prices.php 10422 2021-01-14 08:42:44Z alatak $
 *
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

?>
{{#prices}}

<div class="vmuikit-product-price">
	<div class="uk-card uk-card-small uk-card-vm uk-margin-small-bottom"
			id="vmuikit-product-price-{{ virtuemart_product_price_id}}">
		<div class="uk-card-header">
			<div class="uk-grid uk-grid-small uk-grid-divider uk-flex uk-flex-right" uk-grid>

				<div class="uk-width-auto uk-text-right">

					<a class="vmuikit-js-clone-price"
							href="#"
							uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_PRICE_CLONE') ?>">
						<span class="" uk-icon="icon: copy; ratio: 1"></span>
					</a>
				</div>

				<div class="uk-width-auto uk-text-right">
					<a uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_PRICE_SORTABLE') ?>" href="#"
							class="uk-sortable-handle">
						<span class="" uk-icon="icon: move; ratio: 1"></span>
					</a>
				</div>

				<div class="uk-width-auto uk-text-right">
					<div class="uk-link vmuikit-js-price-remove"
							uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_PRICE_REMOVE') ?>">
						<span class="" uk-icon="icon: trash; ratio: 1"></span>
					</div>
				</div>
				<input type="hidden" value="{{ {{virtuemart_product_price_id}}}}"
						name="mprices[virtuemart_product_price_id][]">
				<input class="ordering" type="hidden" name="productordering[{{ virtuemart_product_price_id}}]"
						value="{{ ordering }}">

			</div>
		</div>
		<div class="uk-card-body">
			<div class="uk-grid-collapse  uk-grid-match uk-grid-divider" uk-grid>
				<!-- LEFT -->
				<div class="uk-width-1-1 uk-width-1-2@l">

					<div class="">

						<!-- Cost price -->
						<div class="uk-margin uk-form-price">
							<label class="uk-form-label">
									<span uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_PRICE_COST_TIP'); ?>">
									<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_PRICE_COST') ?>
								</span>
							</label>
							<div class="uk-form-controls">
								<div class="uk-grid-collapse" uk-grid>
									<div class="uk-width-auto@m">
										<input
												type="text"
												class="input-medium"
												name="mprices[product_price][]"
												size="12"
												data-virtuemart-product-price-id="{{ virtuemart_product_price_id }}"
												data-product-price-costprice="{{ costPrice }}"
												value="{{costPrice}}"/>
										<input type="hidden"
												name="mprices[virtuemart_product_price_id][]"
												value="{{virtuemart_product_price_id}}"/>
									</div>

									<div class="uk-width-expand@m">
										<span class="uk-margin-small-left">{{{currencies}}}</span>
									</div>
								</div>

							</div>
						</div>
						<!-- /Cost price -->

						<!-- Base price -->
						<div class="uk-margin uk-form-price">
							<label class="uk-form-label">
								<span uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_PRICE_BASE_TIP'); ?>">
									<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_PRICE_BASE') ?>
								</span>
							</label>
							<div class="uk-form-controls">
								<div class="uk-grid-collapse" uk-grid>
									<div class="uk-width-auto@m">
										<input
												type="text"
												readonly
												class="input-medium readonly"
												name="mprices[basePrice][]"
												size="12"
												data-virtuemart-product-price-id="{{ virtuemart_product_price_id }}"
												data-product-price-baseprice="{{ basePrice }}"
												value="{{basePrice}}"/>&nbsp;
										<span class="uk-margin-xxsmall-left">{{vendor_currency_symb}}</span>
									</div>

									<div class="uk-width-expand@m">
										<span class="uk-margin-small-left">{{{taxratesHtml}}}</span>
									</div>

									<div class="uk-width-1-6@m">
										<div class="">
											<span uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_RULES_EFFECTING_TIP'); ?>">
											<?php echo vmText::_('COM_VIRTUEMART_TAX_EFFECTING') ?>
											</span>
											{{#DBTaxNameRules}}
											<span class="uk-margin-small-left">{{{DBTaxNameRules}}}</span>
											{{/DBTaxNameRules}}

											{{#DATaxNameRules}}
											<span class="uk-margin-small-left">{{{DATaxNameRules}}}</span>
											{{/DATaxNameRules}}
										</div>
									</div>
								</div>

							</div>
						</div>
						<!-- /Base price -->

						<!-- salesPrice price -->
						<div class="uk-margin uk-form-price">
							<label class="uk-form-label">
								<span uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_PRICE_FINAL_TIP'); ?>">
									<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_PRICE_FINAL') ?>
								</span>
							</label>
							<div class="uk-form-controls">
								<div class="uk-grid-collapse" uk-grid>
									<div class="uk-width-auto@m">
										<input
												type="text"
												class="input-medium"
												name="mprices[salesPrice][]"
												size="12"
												value="{{salesPriceTemp}}"/>&nbsp;
										<span class=".uk-margin-xxsmall-left">{{vendor_currency_symb}}</span>
									</div>

									<div class="uk-width-expand@m">
										<span class="uk-margin-small-left">{{{discountsHtml}}}</span>

									</div>
								</div>
							</div>
						</div>
						<!-- /salesPrice price -->


						<!-- product_override_price price -->
						<div class="uk-margin uk-form-price">
							<label class="uk-form-label">
								<span uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_DISCOUNT_OVERRIDE_TIP'); ?>">
									<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_DISCOUNT_OVERRIDE') ?>
								</span>
							</label>
							<div class="uk-form-controls">
								<div class="uk-grid-collapse" uk-grid>
									<div class="uk-width-auto@m">
										<input
												type="text"
												class="input-medium"
												name="mprices[product_override_price][]"
												size="12"
												value="{{product_override_price}}"/>&nbsp;
										<span class=".uk-margin-xxsmall-left">{{vendor_currency_symb}}</span>
									</div>

									<div class="uk-width-expand@m">
										<!-- use_desired_price price -->
										<div class="uk-margin-small-left">
											<input type="checkbox" name="mprices[use_desired_price][]" value="1"/>
											<strong>
												<span
														uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_CALCULATE_PRICE_FINAL_TIP'); ?>">
												<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_CALCULATE_PRICE_FINAL'); ?>
												</span>
											</strong>
											<br/>
											<?php
											// 							echo VmHtml::checkbox('override',$this->product->override);
											$options = array(0 => vmText::_('COM_VIRTUEMART_DISABLED'), 1 => vmText::_('COM_VIRTUEMART_OVERWRITE_FINAL'), -1 => vmText::_('COM_VIRTUEMART_OVERWRITE_PRICE_TAX'));
											echo "Radio list"
											//echo VmHtml::radioList('mprices[override][]', $this->product->allPrices[$this->product->selectedPrice]['override'], $options, '', ' ');
											?>
											<!-- /use_desired_price price -->
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /product_override_price price -->


					</div>

				</div>
				<!-- /LEFT -->
				<!-- RIGHT -->
				<div class="uk-width-1-1 uk-width-1-2@l">
					<div class="">

						<!-- shoppergroups price -->
						<div class="uk-margin">
							<label class="uk-form-label">
								<span uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_SHOPPER_FORM_GROUP_PRICE_TIP'); ?>">
									<?php echo vmText::_('COM_VIRTUEMART_SHOPPER_FORM_GROUP') ?>
								</span>
							</label>
							<div class="uk-form-controls">
								{{{shoppergroupsHtml}}}
							</div>
						</div>
						<!-- /shoppergroups price -->

						<!-- product_price_publish_up price -->
						<div class="uk-margin">
							<label class="uk-form-label">
								<span uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_PRICE_PUBLISH_UP_DOWN_TIP'); ?>">
									<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_PRICE_PUBLISH_UP_DOWN') ?>
								</span>
							</label>
							<div class="uk-form-controls">
								{{product_price_publish_up}}
								<span class="uk-margin-small-left">{{product_price_publish_down}}</span>
							</div>
						</div>
						<!-- /product_price_publish_up price -->

						<!-- product_price_publish_down price -->
						<div class="uk-margin">
							<label class="uk-form-label">
								<span uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_PRICE_QUANTITY_RANGE_TIP'); ?>">
									<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_PRICE_QUANTITY_RANGE') ?>
								</span>
							</label>
							<div class="uk-form-controls">
								<input
										type="text"
										class="inputbox input-mini"
										name="mprices[price_quantity_start][]"
										size="12"
										value="{{price_quantity_start}}"/>

								<span class="uk-margin-small-left">
								<input
										type="text"
										class="inputbox input-mini"
										name="mprices[price_quantity_end][]"
										value="{{price_quantity_end}}"/>&nbsp;
								</span>
							</div>
						</div>
						<!-- /product_price_publish_down price -->


					</div>
				</div>
				<!-- /RIGHT -->
			</div>

		</div>


	</div>
</div>

{{/prices}}