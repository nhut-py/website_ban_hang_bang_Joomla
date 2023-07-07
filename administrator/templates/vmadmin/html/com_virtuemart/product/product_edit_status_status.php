<?php
/**
 *
 * Information regarding the product status
 *
 * @package    VirtueMart
 * @subpackage Product
 * @author RolandD
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: product_edit_status_status.php 10397 2021-01-11 11:39:18Z alatak $
 *
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access'); ?>
<div class="uk-card   uk-card-small uk-card-vm">
	<div class="uk-card-header">
		<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: inventory; ratio: 1.2"></span>
			<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_PRODUCT_STATUS_LBL'); ?>
		</div>
	</div>
	<div class="uk-card-body">

		<div class="uk-grid-match uk-grid-small uk-child-width-1-2@m" uk-grid>
			<div>
				<div>
					<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_PRODUCT_FORM_IN_STOCK', 'product_in_stock', $this->product->product_in_stock, $class = 'class="inputbox js-change-stock input-small"'); ?>
					<?php if ($this->product->product_parent_id != 0 and !$this->product_childs) {
						echo VmuikitHtml::row('checkbox', 'COM_VM_PRODUCT_FORM_STOCK_SHARED', 'shared_stock', $this->product->shared_stock);

					}
					?>
					<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_LOW_STOCK_NOTIFICATION', 'low_stock_notification', $this->product->low_stock_notification, $class = 'class="inputbox input-small"'); ?>
					<div class="uk-margin">
						<label class="uk-form-label"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_AVAILABLE_DATE') ?></label>
						<div class="uk-form-controls">
							<?php echo vmJsApi::jDate($this->product->product_available_date, 'product_available_date'); ?>

						</div>
					</div>
					<div class="uk-margin">
						<label class="uk-form-label"><?php echo vmText::_('COM_VIRTUEMART_AVAILABILITY') ?></label>
						<div class="uk-form-controls">
							<input type="text" class="inputbox" id="product_availability"
									name="product_availability"
									value="<?php echo $this->product->product_availability; ?>"/>
							<span class="icon-nofloat vmicon vmicon-16-info tooltip"
									title="<?php echo '' . vmText::_('COM_VIRTUEMART_AVAILABILITY') . '<br/ >' . vmText::_('COM_VIRTUEMART_PRODUCT_FORM_AVAILABILITY_TOOLTIP1') ?>"></span>

							<?php echo JHtml::_('list.images', 'image', $this->product->product_availability, " ", $this->imagePath); ?>
							<span class="icon-nofloat vmicon vmicon-16-info tooltip"
									title="<?php echo '' . vmText::_('COM_VIRTUEMART_AVAILABILITY') . '<br/ >' . vmText::sprintf('COM_VIRTUEMART_PRODUCT_FORM_AVAILABILITY_TOOLTIP2', $this->imagePath) ?>">
									</span>

						</div>
					</div>
					<div>
						<label class="uk-form-label"></label>
						<div class="uk-form-controls">
							<img border="0" id="imagelib"
									alt="<?php echo vmText::_('COM_VIRTUEMART_PREVIEW'); ?>" name="imagelib"
									src="<?php if ($this->product->product_availability and file_exists(JPATH_ROOT . '/' . $this->imagePath . $this->product->product_availability)) {
										echo JURI::root(true) . $this->imagePath . $this->product->product_availability;
									} ?>"/>
						</div>
					</div>

				</div>
			</div>

			<div>
				<div>
					<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_PRODUCT_FORM_ORDERED_STOCK', 'product_ordered', $this->product->product_ordered, $class = 'class="inputbox js-change-stock input-small"'); ?>
					<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_PRODUCT_FORM_STEP_ORDER', 'step_order_level', $this->product->step_order_level, $class = 'class="inputbox  input-small"'); ?>
					<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_PRODUCT_FORM_MIN_ORDER', 'min_order_level', $this->product->min_order_level, $class = 'class="inputbox  input-small"'); ?>
					<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_PRODUCT_FORM_MAX_ORDER', 'max_order_level', $this->product->max_order_level, $class = 'class="inputbox  input-small"'); ?>

				</div>
			</div>
		</div>
	</div>
</div>





