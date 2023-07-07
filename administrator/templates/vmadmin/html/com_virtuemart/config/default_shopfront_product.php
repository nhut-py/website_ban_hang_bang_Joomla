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
 * @version $Id: default_shopfront_product.php 10424 2021-01-14 09:24:33Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access'); ?>

<div class="uk-card uk-card-small uk-card-vm">
	<div class="uk-card-header">
		<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: product; ratio: 1.2"></span>
			<?php echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_PRODUCT_LISTING'); ?>
		</div>
	</div>
	<div class="uk-card-body">
		<?php
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_PRODUCT_NAVIGATION_SHOW', 'product_navigation', VmConfig::get('product_navigation', 1));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_DISPLAY_STOCK', 'display_stock', VmConfig::get('display_stock', 1));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_SHOW_PRODUCT_CUSTOMS', 'show_pcustoms', VmConfig::get('show_pcustoms', 1));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_SUBCAT_PRODUCTS_SHOW', 'show_subcat_products', VmConfig::get('show_subcat_products', 0));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_UNCAT_PARENT_PRODUCTS_SHOW', 'show_uncat_parent_products', VmConfig::get('show_uncat_parent_products', 0));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_UNCAT_CHILD_PRODUCTS_SHOW', 'show_uncat_child_products', VmConfig::get('show_uncat_child_products', 0));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_SHOW_PRODUCTS_UNPUBLISHED_CATEGORIES', 'show_unpub_cat_products', VmConfig::get('show_unpub_cat_products', 1));
		echo VmuikitHtml::row('booleanlist', 'COM_VM_PRODUCTDETAILS_DISPL_CATS', 'cat_productdetails', VmConfig::get('cat_productdetails', 0));
		echo VmuikitHtml::row('input', 'COM_VIRTUEMART_LATEST_PRODUCTS_DAYS', 'latest_products_days', VmConfig::get('latest_products_days', 7), 'class="uk-form-width-xsmall"', '', 4, 4);
		$latest_products_orderBy = array(
			'modified_on' => vmText::_('COM_VIRTUEMART_LATEST_PRODUCTS_ORDERBY_MODIFIED'),
			'created_on' => vmText::_('COM_VIRTUEMART_LATEST_PRODUCTS_ORDERBY_CREATED')
		);
		echo VmuikitHtml::row('selectList', 'COM_VIRTUEMART_LATEST_PRODUCTS_ORDERBY', 'latest_products_orderBy', VmConfig::get('latest_products_orderBy', 'created_on'), $latest_products_orderBy);
		?>

	</div>
</div>


