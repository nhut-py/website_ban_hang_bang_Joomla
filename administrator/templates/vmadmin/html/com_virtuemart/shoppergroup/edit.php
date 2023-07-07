<?php
/**
 *
 * Description
 *
 * @package    VirtueMart
 * @subpackage ShopperGroup
 * @author Markus �hler
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: edit.php 10438 2021-01-22 07:18:16Z alatak $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

$js = 'Virtuemart.showprices;';
vmJsApi::addJScript('show_prices', $js, true);

$adminTemplate = VMPATH_ROOT . '/administrator/templates/vmadmin/html/com_virtuemart/';
JLoader::register('vmuikitAdminUIHelper', $adminTemplate . 'helpers/vmuikit_adminuihelper.php');
vmuikitAdminUIHelper::startAdminArea($this);
vmuikitAdminUIHelper::imitateTabs('start', 'COM_VIRTUEMART_SHOPPERGROUP_NAME');

?>
	<form action="index.php" method="post" name="adminForm" id="adminForm" class="uk-form-horizontal">
		<div class="uk-child-width-1-1" uk-grid>
			<div>

				<div class="uk-card   uk-card-small uk-card-vm ">
					<div class="uk-card-header">
						<div class="uk-card-title">
					<span class="md-color-cyan-600 uk-margin-small-right"
							uk-icon="icon: users; ratio: 1.2"></span>
							<?php echo vmText::_('COM_VIRTUEMART_SHOPPERGROUP_DETAILS') ?>
						</div>
					</div>
					<div class="uk-card-body">
						<?php
						echo VmuikitHtml::row('input', 'COM_VIRTUEMART_SHOPPERGROUP_NAME', 'shopper_group_name', $this->shoppergroup->shopper_group_name, 'class="required"');
						echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_PUBLISHED', 'published', $this->shoppergroup->published);
						/*if($this->showVendors() ){
							echo VmuikitHtml::row('raw','COM_VIRTUEMART_VENDOR', $this->vendorList );
						}*/
						if ($this->shoppergroup->default == 1) {
							?>
							<div class="uk-clearfix">
								<div class="uk-form-label">
							<span uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_SHOPPERGROUP_DEFAULT_TIP'); ?>">
								<?php echo vmText::_('COM_VIRTUEMART_SHOPPERGROUP_DEFAULT'); ?>
							</span>
								</div>
								<div class="uk-form-controls">
									<?php echo JHtml::_('image', 'menu/icon-16-default.png', vmText::_('COM_VIRTUEMART_SHOPPERGROUP_DEFAULT'), NULL, true); ?>
								</div>
							</div>

						<?php }
						echo VmuikitHtml::row('textarea', 'COM_VIRTUEMART_SHOPPERGROUP_DESCRIPTION', 'shopper_group_desc', $this->shoppergroup->shopper_group_desc,'class="uk-textarea"', 80);

						if ($this->shoppergroup->default < 1) {
							echo VmuikitHtml::row('checkbox', 'COM_VIRTUEMART_SHOPPERGROUP_ADDITIONAL', 'sgrp_additional', $this->shoppergroup->sgrp_additional);
						} else {

						}
						?>
					</div>
				</div>
			</div>
			<div>
				<div class="uk-card   uk-card-small uk-card-vm ">
					<div class="uk-card-header">
						<div class="uk-card-title">
					<span class="md-color-cyan-600 uk-margin-small-right"
							uk-icon="icon: tag; ratio: 1.2"></span>
							<?php echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_PRICES') ?>
						</div>
					</div>
					<div class="uk-card-body">


						<?php
						$attributes = 'id="show_prices"';
						echo VmuikitHtml::row('checkbox', 'COM_VIRTUEMART_SHOPPERGROUP_ENABLE_PRICE_DISPLAY', 'custom_price_display', $this->shoppergroup->custom_price_display, 1, 0, $attributes); ?>


						<?php
						$params = $this->shoppergroup;
						$show_prices = $this->shoppergroup->show_prices;
						$showPricesLine = true;
						include($adminTemplate . '/config/default_priceconfig.php');
						?>


						<input type="hidden" name="default" value="<?php echo $this->shoppergroup->default ?>"/>
						<input type="hidden" name="virtuemart_shoppergroup_id"
								value="<?php echo $this->shoppergroup->virtuemart_shoppergroup_id; ?>"/>
						<?php echo $this->addStandardHiddenToForm(); ?>


					</div>
				</div>
			</div>
		</div>

	</form>
<?php
vmuikitAdminUIHelper::imitateTabs('end');
vmuikitAdminUIHelper::endAdminArea();
?>