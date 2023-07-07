<?php
/**
 *
 * Description
 *
 * @packageVirtueMart
 * @subpackage Config
 * @author RickG
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_shopfront_stock.php 10422 2021-01-14 08:42:44Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access'); ?>


<div class="uk-card uk-card-small uk-card-vm">
	<div class="uk-card-header">
		<div class="uk-card-title" uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_CFG_POOS_ENABLE_EXPLAIN'); ?>">
						<span class=" md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: inventory; ratio: 1.2"></span>
			<?php echo vmText::_('COM_VIRTUEMART_CFG_POOS_ENABLE'); ?>
		</div>
		<div class="uk-margin-small-top uk-text-meta">
			<?php echo vmText::_('COM_VIRTUEMART_CFG_POOS_ENABLE_EXPLAIN'); ?>
		</div>
	</div>
	<div class="uk-card-body">
		<div>

			<?php
			echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_CFG_LOWSTOCK_NOTIFY', 'lstockmail', VmConfig::get('lstockmail'));
			?>
		</div>
		<div>
			<?php
			echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_CFG_POOS_DISCONTINUED_PRODUCTS', 'stockhandle_products', VmConfig::get('stockhandle_products'));
			?>

		</div>
		<?php
		$options = array(
			'none' => vmText::_('COM_VIRTUEMART_ADMIN_CFG_POOS_NONE'),
			'disableit' => vmText::_('COM_VIRTUEMART_ADMIN_CFG_POOS_DISABLE_IT'),
			'disableit_children' => vmText::_('COM_VIRTUEMART_ADMIN_CFG_POOS_DISABLE_IT_CHILDREN'),
			'disableadd' => vmText::_('COM_VIRTUEMART_ADMIN_CFG_POOS_DISABLE_ADD'),
			'risetime' => vmText::_('COM_VIRTUEMART_ADMIN_CFG_POOS_RISE_AVATIME')
		);
		echo VmuikitHtml::radioList('stockhandle', VmConfig::get('stockhandle', 'none'), $options);
		?>
		<div style="font-weight:bold;">
					<span class="" uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_AVAILABILITY_EXPLAIN'); ?>">
						<?php echo vmText::_('COM_VIRTUEMART_AVAILABILITY'); ?>
					</span>
		</div>
		<input type="text" class="inputbox" id="product_availability" name="rised_availability"
				value="<?php echo VmConfig::get('rised_availability'); ?>"/>
		<span class="icon-nofloat vmicon vmicon-16-info "
				uk-tooltip="<?php echo '<b>' . vmText::_('COM_VIRTUEMART_AVAILABILITY') . '</b><br/ >' . vmText::_('COM_VIRTUEMART_PRODUCT_FORM_AVAILABILITY_TOOLTIP1') ?>"></span>

		<div class="clr"></div>
		<?php if (!empty($this->imagePath) and JFolder::exists(VMPATH_ROOT . $this->imagePath)) {
			echo JHtml::_('list.images', 'image', VmConfig::get('rised_availability'), " ", $this->imagePath);
		} else {
			echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_ASSETS_GENERAL_PATH_MISSING');
		} ?>
		<span class="icon-nofloat vmicon vmicon-16-info "
				uk-tooltip="<?php echo '<b>' . vmText::_('COM_VIRTUEMART_AVAILABILITY') . '</b><br/ >' . vmText::sprintf('COM_VIRTUEMART_PRODUCT_FORM_AVAILABILITY_TOOLTIP2', $this->imagePath) ?>"></span>

		<div class="clr"></div>
		<img id="imagelib" alt="<?php echo vmText::_('COM_VIRTUEMART_PREVIEW'); ?>" name="imagelib"
				src="<?php if (VmConfig::get('rised_availability') and file_exists(JPATH_ROOT . '/' . $this->imagePath . VmConfig::get('rised_availability'))) {
					echo JURI::root(true) . $this->imagePath . VmConfig::get('rised_availability');
				} ?>"/>
	</div>
</div>


