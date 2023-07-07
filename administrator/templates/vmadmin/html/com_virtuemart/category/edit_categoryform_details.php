<?php
/**
 *
 * Description
 *
 * @package    VirtueMart
 * @subpackage Category
 * @author RickG, jseros, Max Milbers, Valérie Isaksen
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: edit_categoryform_details.php 10392 2021-01-11 11:15:34Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');


$mainframe = JFactory::getApplication();
?>

<div class="uk-card   uk-card-small uk-card-vm">
	<div class="uk-card-header">
		<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: more; ratio: 1.2"></span>
			<?php echo vmText::_('COM_VIRTUEMART_DETAILS'); ?>
		</div>
	</div>
	<div class="uk-card-body">
		<?php echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_CATEGORY_ORDERING', ShopFunctions::getEnumeratedCategories(true, true, $this->parent->virtuemart_category_id, 'ordering', '', 'ordering', 'category_name', $this->category->ordering)); ?>
		<?php $categorylist = '
						<select name="category_parent_id" id="category_parent_id" class="inputbox">
							<option value="">' . vmText::_('COM_VIRTUEMART_CATEGORY_FORM_TOP_LEVEL') . '</option>
							' . $this->categorylist . '
						</select>';
		echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_CATEGORY_FORM_PARENT', $categorylist); ?>
		<?php //echo VmHTML::row('input','COM_VIRTUEMART_CATEGORY_FORM_PRODUCTS_PER_ROW','products_per_row',$this->category->products_per_row,'','',4); ?>
		<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_CATEGORY_FORM_LIMIT_LIST_STEP', 'limit_list_step', $this->category->limit_list_step, '', '', 4); ?>
		<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_CATEGORY_FORM_INITIAL_DISPLAY_RECORDS', 'limit_list_initial', $this->category->limit_list_initial, '', '', 4); ?>
		<?php //echo VmHTML::row('select','COM_VIRTUEMART_CATEGORY_FORM_TEMPLATE', 'category_template', $this->jTemplateList ,$this->category->category_template,'','value', 'name',false) ; ?>
		<?php //echo VmHTML::row('select','COM_VIRTUEMART_CATEGORY_FORM_BROWSE_LAYOUT', 'category_layout', $this->categoryLayouts ,$this->category->category_layout,'','value', 'text',false) ; ?>
		<?php //echo VmHTML::row('select','COM_VIRTUEMART_CATEGORY_FORM_FLYPAGE', 'category_product_layout', $this->productLayouts ,$this->category->category_product_layout,'','value', 'text',false) ; ?>
	</div>
</div>