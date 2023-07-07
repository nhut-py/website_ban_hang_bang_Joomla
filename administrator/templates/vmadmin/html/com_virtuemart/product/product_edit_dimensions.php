<?php
/**
 *
 * Set the product dimensions
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
 * @version $Id: product_edit_dimensions.php 10422 2021-01-14 08:42:44Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access'); ?>

<div class="uk-grid-small uk-child-width-1-1" uk-grid>
	<div>
		<div class="uk-card   uk-card-small uk-card-vm">
			<div class="uk-card-header">
				<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: weight; ratio: 1.2"></span>
					<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_PRODUCT_STATUS_LBL'); ?>
				</div>
			</div>
			<div class="uk-card-body">

				<div class="uk-margin">
					<label class="uk-form-label"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_LENGTH') ?></label>
					<div class="uk-form-controls">
						<input type="text" class="inputbox" name="product_length"
								value="<?php echo $this->product->product_length; ?>" size="15"
								maxlength="15"/> <?php echo " " . $this->lists['product_lwh_uom']; ?>

					</div>
				</div>

				<div class="uk-margin">
					<label class="uk-form-label"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_WIDTH') ?></label>
					<div class="uk-form-controls">
						<input type="text" class="inputbox" name="product_width"
								value="<?php echo $this->product->product_width; ?>" size="15" maxlength="15"/>

					</div>
				</div>

				<div class="uk-margin">
					<label class="uk-form-label"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_HEIGHT') ?></label>
					<div class="uk-form-controls">
						<input type="text" class="inputbox" name="product_height"
								value="<?php echo $this->product->product_height; ?>" size="15" maxlength="15"/>
					</div>
				</div>

				<div class="uk-margin">
					<label class="uk-form-label"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_WEIGHT') ?></label>
					<div class="uk-form-controls">
						<input type="text" class="inputbox" name="product_weight"
								value="<?php echo $this->product->product_weight; ?>" size="15" maxlength="15"/>
						<?php echo " " . $this->lists['product_weight_uom']; ?>
					</div>
				</div>

				<div class="uk-margin">
					<label class="uk-form-label">
			        <span uk-tooltip="<?php echo vmText::sprintf('COM_VIRTUEMART_PRODUCT_PACKAGING_DESCRIPTION', vmText::_('COM_VIRTUEMART_UNIT_NAME_L'), vmText::_('COM_VIRTUEMART_PRODUCT_UNIT'), vmText::_('COM_VIRTUEMART_UNIT_NAME_100ML')); ?>">
        <?php echo vmText::_('COM_VIRTUEMART_PRODUCT_PACKAGING') ?>
         </span>
					</label>
					<div class="uk-form-controls">
						<input type="text" class="inputbox" name="product_packaging"
								value="<?php echo $this->product->product_packaging; ?>" size="15"
								maxlength="15"/>&nbsp;
						<?php echo " " . $this->lists['product_iso_uom']; ?>
					</div>
				</div>

				<div class="uk-margin">
					<label class="uk-form-label">
			           <span uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_BOX_DESCRIPTION'); ?>">
                <?php echo vmText::_('COM_VIRTUEMART_PRODUCT_BOX') ?>
                </span>
					</label>
					<div class="uk-form-controls">
						<input type="text" class="inputbox" name="product_box"
								value="<?php echo $this->product->product_box; ?>" size="15" maxlength="15"/>&nbsp;
					</div>
				</div>


			</div>

		</div>
	</div>
</div>