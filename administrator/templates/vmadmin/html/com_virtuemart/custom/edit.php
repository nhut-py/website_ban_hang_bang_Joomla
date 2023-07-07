<?php
/**
 *
 * Description
 *
 * @package    VirtueMart
 * @subpackage
 * @author Max Milbers
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

$adminTemplate = VMPATH_ROOT . '/administrator/templates/vmadmin/html/com_virtuemart/';
JLoader::register('vmuikitAdminUIHelper', $adminTemplate . 'helpers/vmuikit_adminuihelper.php');

vmuikitAdminUIHelper::startAdminArea($this);
vmuikitAdminUIHelper::imitateTabs('start', 'COM_VIRTUEMART_PRODUCT_CUSTOM_FIELD');
vmJsApi::JvalideForm();

?>
	<div class="uk-card uk-card-small uk-card-vm ">
		<div class="uk-card-header">
			<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: customfield; ratio: 1.2"></span>
				<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_CUSTOM_FIELD') ?>
			</div>
		</div>
		<div class="uk-card-body">
			<form name="adminForm" id="adminForm" method="post" action="" class="uk-form-horizontal">


				<?php
				$this->addHidden('view', 'custom');
				$this->addHidden('task', '');
				$this->addHidden(JSession::getFormToken(), 1);
				$this->addHidden('custom_jplugin_id', $this->custom->custom_jplugin_id);
				$this->addHidden('custom_element', $this->custom->custom_element);
				//if ($this->custom->custom_parent_id) $this->customfields->addHidden('custom_parent_id',$this->custom->custom_parent_id);
				$attribute_id = vRequest::getVar('attribute_id', '');
				if (!empty($attribute_id)) {
					$this->customfields->addHidden('attribute_id', $attribute_id);
				}
				?>
				<?php

				if ($this->custom->field_type) {
					$this->addHidden('field_type', $this->custom->field_type);
				}
				$this->addHidden('virtuemart_custom_id', $this->custom->virtuemart_custom_id);
				$this->addHidden('option', 'com_virtuemart');

				$model = VmModel::getModel('custom');

				// only input when not set else display
				if ($this->custom->field_type) {
					echo VmuikitHtml::row('value', 'COM_VIRTUEMART_CUSTOM_FIELD_TYPE', $this->fieldTypes[$this->custom->field_type]);
				} else {
					echo VmuikitHtml::row('select', 'COM_VIRTUEMART_CUSTOM_FIELD_TYPE', 'field_type', $this->getOptions($this->fieldTypes), $this->custom->field_type, VmHTML::validate('R'));
				}
				echo VmuikitHtml::row('input', 'COM_VIRTUEMART_TITLE', 'custom_title', $this->custom->custom_title, 'class="required"');
				echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_SHOW_TITLE', 'show_title', $this->custom->show_title);
				echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_PUBLISHED', 'published', $this->custom->published);
				echo VmuikitHtml::row('select', 'COM_VIRTUEMART_CUSTOM_GROUP', 'custom_parent_id', $model->getParentList($this->custom->virtuemart_custom_id), $this->custom->custom_parent_id, '');
				echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_CUSTOM_IS_CART_ATTRIBUTE', 'is_cart_attribute', $this->custom->is_cart_attribute);
				echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_CUSTOM_IS_CART_INPUT', 'is_input', $this->custom->is_input);
				echo VmuikitHtml::row('booleanlist', 'COM_VM_CUSTOM_IS_SEARCHABLE', 'searchable', $this->custom->searchable);
				echo VmuikitHtml::row('input', 'COM_VIRTUEMART_DESCRIPTION', 'custom_desc', $this->custom->custom_desc);
				// change input by type
				echo VmuikitHtml::row('textarea', 'COM_VIRTUEMART_CUSTOM_DEFAULT', 'custom_value', $this->custom->custom_value,'class="uk-textarea"', 80);
				echo VmuikitHtml::row('input', 'COM_VIRTUEMART_CUSTOM_TIP', 'custom_tip', $this->custom->custom_tip);
				echo VmuikitHtml::row('input', 'COM_VIRTUEMART_CUSTOM_LAYOUT_POS', 'layout_pos', $this->custom->layout_pos);
				//echo VmuikitHtml::row('booleanlist','COM_VIRTUEMART_CUSTOM_GROUP','custom_parent_id',$this->getCustomsList(),  $this->custom->custom_parent_id,'');
				echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_CUSTOM_ADMIN_ONLY', 'admin_only', $this->custom->admin_only);
				$typesWList = array('S', 'M');
				if (empty($this->custom->field_type) or in_array($this->custom->field_type, $typesWList)) {
					$opt = array(0 => 'COM_VIRTUEMART_NO', 1 => 'COM_VIRTUEMART_YES', 2 => 'COM_VIRTUEMART_CUSTOM_ADMINLIST');
					echo VmuikitHtml::row('select', 'COM_VIRTUEMART_CUSTOM_IS_LIST', 'is_list', $opt, $this->custom->is_list, '', 'value', 'text', false);
				}
				echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_CUSTOM_IS_HIDDEN', 'is_hidden', $this->custom->is_hidden);
				echo VmuikitHtml::row('raw', 'COM_VM_CUSTOM_SHOPPERGROUPS', ShopFunctions::renderShopperGroupList($this->custom->virtuemart_shoppergroup_id));
				echo VmuikitHtml::inputHidden($this->_hidden);
				?>


				<div class="uk-margin well" id="custom_plg">
					<label class="uk-form-label">
						<?php echo vmText::_('COM_VIRTUEMART_SELECT_CUSTOM_PLUGIN'); ?>
					</label>
					<div class="uk-form-controls well">
						<?php if (!$this->custom->form) {
							echo $this->pluginList;
						} ?>
						<div class="clear"></div>
						<div id="plugin-Container">
							<?php
							defined('_JEXEC') or die('Restricted access');
							if ($this->custom->form) {
								?>
								<h2 style="text-align: center;"><?php echo vmText::_($this->custom->custom_title) ?></h2>
								<div style="text-align: center;"><?php echo VmText::_('COM_VIRTUEMART_CUSTOM_CLASS_NAME') . ": " . $this->custom->custom_element ?></div>
								<?php
								if ($this->custom->form) {
									$form = $this->custom->form;
									include(VMPATH_ADMIN . '/fields/formrenderer.php');
								}
							} else {
								//echo vmText::_('COM_VIRTUEMART_SELECT_CUSTOM_PLUGIN');
							}
							?>
						</div>
					</div>
				</div>


				<!--
		
			<table class="admintable">
				<?php //echo $this->displayCustomFields($this->custom); ?>
				<tr id="custom_plgx">
					<td valign="top"><?php echo vmText::_('COM_VIRTUEMART_SELECT_CUSTOM_PLUGIN') ?></td>
					<td>
						<fieldset>
							<?php if (!$this->custom->form) {
					echo $this->pluginList;
				} ?>
							<div class="clear"></div>
							<div id="plugin-Container">
								<?php
				defined('_JEXEC') or die('Restricted access');
				if ($this->custom->form) {
					?>
									<h2 style="text-align: center;"><?php echo vmText::_($this->custom->custom_title) ?></h2>
									<div style="text-align: center;"><?php echo VmText::_('COM_VIRTUEMART_CUSTOM_CLASS_NAME') . ": " . $this->custom->custom_element ?></div>
									<?php
					if ($this->custom->form) {
						$form = $this->custom->form;
						include(VMPATH_ADMIN . '/fields/formrenderer.php');
					}
				} else {
					echo vmText::_('COM_VIRTUEMART_SELECT_CUSTOM_PLUGIN');
				}
				?>
							</div>
						</fieldset>
					</td>
				</tr>
				<?php //} ?>
			</table>
	 -->
			</form>
		</div>

	</div>

<?php


$js = "function submitbutton(pressbutton) {
	if (pressbutton=='cancel'){
		submitform(pressbutton);
		return true;
	}
	if (jQuery('#adminForm').validationEngine('validate')== true){
		submitform(pressbutton);
		return true;
	}
	else return false ;
}
jQuery(function($) {";

if (!$this->custom->form) {
	$js .= "$('#custom_plg').hide();";
}
$js .= '$(\'#field_type\').change(function () {
	var $selected = $(this).val();
	if ($selected == "E" ) $(\'#custom_plg\').show();
	else { $(\'#custom_plg\').hide();
		$(\'#custom_jplugin_id option:eq(0)\').attr("selected", "selected");
		$(\'#custom_jplugin_id\').change();
	}

	});
	$(\'#custom_jplugin_id\').change(function () {
	var $id = $(this).val();
	$(\'#plugin-Container\').load( \'index.php?option=com_virtuemart&view=custom&format=json&custom_jplugin_id=\'+$id , function() {
	$(this).find("[title]").vm2admin(\'tips\',tip_image) });

	});
}); ';

vmJsApi::addJScript('showPlugin', $js);
vmuikitAdminUIHelper::imitateTabs('end');
vmuikitAdminUIHelper::endAdminArea(); ?>