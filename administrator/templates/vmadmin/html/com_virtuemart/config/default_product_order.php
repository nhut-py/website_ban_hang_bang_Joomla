<?php
/**
 *
 * Description
 *
 * @package    VirtueMart
 * @subpackage Config
 * @author RickG
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_product_order.php 10425 2021-01-19 07:08:40Z alatak $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access'); ?>

<div class="uk-grid-match uk-grid-small" uk-grid>
	<div>
		<div class="uk-card uk-card-small uk-card-vm">
			<div class="uk-card-header">
				<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: settings; ratio: 1.2"></span>
					<?php echo vmText::_('COM_VIRTUEMART_BROWSE_ORDERBY_DEFAULT_FIELD_TITLE'); ?>
				</div>
			</div>
			<div class="uk-card-body">
				<div class="uk-clearfix">
					<div class="uk-form-label">
					<span
							uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_BROWSE_ORDERBY_DEFAULT_FIELD_LBL_TIP'); ?>">
									<?php echo vmText::_('COM_VIRTUEMART_BROWSE_ORDERBY_DEFAULT_FIELD_LBL'); ?>
								</span>
					</div>
					<div class="uk-form-controls">
						<?php echo JHtml::_('Select.genericlist', $this->orderByFieldsProduct->select, 'browse_orderby_field', 'size=1', 'value', 'text', VmConfig::get('browse_orderby_field', 'product_name'), 'product_name');

						echo JHtml::_('select.genericlist', $this->orderDirs, 'prd_brws_orderby_dir', 'size=10', 'value', 'text', VmConfig::get('prd_brws_orderby_dir', 'ASC')); ?>
					</div>
				</div>

				<div class="uk-clearfix">
					<div class="uk-form-label">
						<span
								uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_BROWSE_CAT_ORDERBY_DEFAULT_FIELD_LBL_TIP'); ?>">
								<?php echo vmText::_('COM_VIRTUEMART_BROWSE_CAT_ORDERBY_DEFAULT_FIELD_LBL'); ?>
							</span>
					</div>
					<div class="uk-form-controls">
						<?php //Fallback, if someone used an old ordering: "ordering"
						$ordering = VmConfig::get('browse_cat_orderby_field', 'c.ordering,category_name');
						if (!in_array($ordering, VirtueMartModelCategory::$_validOrderingFields)) {
							$ordering = 'c.ordering,category_name';
						}
						echo JHtml::_('Select.genericlist', $this->orderByFieldsCat, 'browse_cat_orderby_field', 'size=1', 'value', 'text', $ordering, 'category_name');
						echo JHtml::_('select.genericlist', $this->orderDirs, 'cat_brws_orderby_dir', 'size=10', 'value', 'text', VmConfig::get('cat_brws_orderby_dir', 'ASC')); ?>
					</div>
				</div>


				<div class="uk-clearfix uk-margin-medium-top">
					<div class="uk-form-label">
						<span
								uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_BROWSE_ORDERBY_FIELDS_LBL_TIP'); ?>">
									<?php echo vmText::_('COM_VIRTUEMART_BROWSE_ORDERBY_FIELDS_LBL'); ?>
								</span>
					</div>
					<div class="uk-form-controls checkbox">
						<?php echo $this->orderByFieldsProduct->checkbox; ?>
					</div>
				</div>
				<div class="uk-clearfix  uk-margin-medium-top">
					<div class="uk-form-label">
						<span
								uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_BROWSE_SEARCH_FIELDS_LBL_TIP'); ?>">
									<?php echo vmText::_('COM_VIRTUEMART_BROWSE_SEARCH_FIELDS_LBL'); ?>
								</span>
					</div>
					<div class="uk-form-controls checkbox">
						<?php echo $this->searchFields->checkbox; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

