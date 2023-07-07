<?php
/**
 *
 * Description
 *
 * @package    VirtueMart
 * @subpackage Calculation tool
 * @author Max Milbers, Valérie Isaksen
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: edit_calc.php 10390 2021-01-11 11:08:53Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
vmJsApi::jDate();

?>
<form action="index.php" method="post" name="adminForm" id="adminForm" class="uk-form-horizontal">
	<div class="uk-grid-match uk-grid-small uk-child-width-1-1" uk-grid>
		<div>
			<div class="uk-card   uk-card-small uk-card-vm">
				<div class="uk-card-header">
					<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: calculator; ratio: 1.2"></span>
						<?php echo vmText::_('COM_VIRTUEMART_CALC_DETAILS'); ?>
					</div>
				</div>
				<div class="uk-card-body">
					<?php $lang = vmLanguage::getLanguage();
					$text = $lang->hasKey($this->calc->calc_name) ? vmText::_($this->calc->calc_name) : '';
					$input = VmuikitHtml::input('calc_name', $this->calc->calc_name, 'class="required"') . '(' . $text . ')';

					echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_CALC_NAME', $input);
					//echo VmuikitHtml::row('input','COM_VIRTUEMART_CALC_NAME','calc_name',$this->calc->calc_name,'class="required"'); ?>
					<?php echo VmuikitHtml::row('checkbox', 'COM_VIRTUEMART_PUBLISHED', 'published', $this->calc->published); ?>
					<?php if ($this->showVendors()) {
						echo VmuikitHtml::row('checkbox', 'COM_VIRTUEMART_SHARED', 'shared', $this->calc->shared);
					} ?>
					<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_ORDERING', 'ordering', $this->calc->ordering, 'class="inputbox"', '', 4, 4); ?>
					<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_DESCRIPTION', 'calc_descr', $this->calc->calc_descr, 'class="inputbox"', '', 70, 255); ?>
					<?php echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_CALC_KIND', $this->entryPointsList); ?>
					<?php echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_CALC_VALUE_MATHOP', $this->mathOpList); ?>
					<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_VALUE', 'calc_value', $this->calc->calc_value); ?>
					<?php echo VmuikitHtml::row('select', 'COM_VIRTUEMART_CURRENCY', 'calc_currency', $this->currencies, $this->calc->calc_currency, '', 'virtuemart_currency_id', 'currency_name', false); ?>
					<div class="uk-clearfix">
						<label class="uk-form-label" for="virtuemart_shoppergroup_id">
							<?php echo vmText::_('COM_VIRTUEMART_CATEGORY'); ?>
						</label>
						<div class="uk-form-controls">
							<select class="inputbox multiple" id="calc_categories" name="calc_categories[]"
									multiple="multiple" size="10">
								<?php echo $this->categoryTree; ?>
							</select>
						</div>
					</div>
					<?php echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_SHOPPERGROUP_IDS', $this->shopperGroupList); ?>
					<?php echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_COUNTRY', $this->countriesList); ?>
					<?php echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_STATE_S', $this->statesList); ?>
					<?php echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_MANUFACTURER', $this->manufacturerList); /* Mod. <mediaDESIGN> St.Kraft 2013-02-24 Herstellerrabatt */ ?>

					<?php //echo VmuikitHtml::row('booleanlist','COM_VIRTUEMART_VISIBLE_FOR_SHOPPER','calc_shopper_published',$this->calc->calc_shopper_published); ?>
					<?php //echo VmuikitHtml::row('booleanlist','COM_VIRTUEMART_VISIBLE_FOR_VENDOR','calc_vendor_published',$this->calc->calc_vendor_published); ?>
					<?php
					echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_START_DATE', vmJsApi::jDate($this->calc->publish_up, 'publish_up')); ?>
					<?php
					echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_END_DATE', vmJsApi::jDate($this->calc->publish_down, 'publish_down')); ?>


					<?php

					JPluginHelper::importPlugin('vmcalculation');
					$dispatcher = JDispatcher::getInstance();
					$html = '';
					$returnValues = $dispatcher->trigger('plgVmOnDisplayEdit', array(&$this->calc, &$html));
					echo $html;

					if ($this->showVendors()) {
						echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_VENDOR', $this->vendorList);
					}
					?>


				</div>
			</div>
		</div>
	</div>


	<input type="hidden" name="virtuemart_calc_id" value="<?php echo $this->calc->virtuemart_calc_id; ?>"/>

	<?php echo $this->addStandardHiddenToForm(); ?>

</form>
