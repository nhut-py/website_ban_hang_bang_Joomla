<?php
/**
 *
 * Description
 *
 * @package    VirtueMart
 * @subpackage OrderStatus
 * @author Oscar van Eijk
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: edit.php 10451 2021-01-27 08:16:53Z alatak $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$adminTemplate = VMPATH_ROOT . '/administrator/templates/vmadmin/html/com_virtuemart/';
JLoader::register('vmuikitAdminUIHelper', $adminTemplate . 'helpers/vmuikit_adminuihelper.php');
vmuikitAdminUIHelper::startAdminArea($this);
vmuikitAdminUIHelper::imitateTabs('start', 'COM_VIRTUEMART_ORDERSTATUS_DETAILS');
?>
<div class="uk-grid-match uk-grid-small uk-child-width-1-1" uk-grid>
	<div>
		<div class="uk-card   uk-card-small uk-card-vm ">
			<div class="uk-card-header">
				<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: settings; ratio: 1.2"></span>
					<?php echo vmText::_('COM_VIRTUEMART_ORDERSTATUS_DETAILS') ?>
				</div>
			</div>
			<div class="uk-card-body">
				<form action="index.php" method="post" name="adminForm" id="adminForm" class="uk-form-horizontal">

					<?php
					$editcoreStatus = (in_array($this->orderStatus->order_status_code, $this->lists['vmCoreStatusCode']));
					$orderStatusCodeTip = ($editcoreStatus) ? 'COM_VIRTUEMART_ORDER_STATUS_CODE_CORE' : 'COM_VIRTUEMART_ORDER_STATUS_CODE_TIP';
					if ($editcoreStatus) {
						$readonly = 'readonly';
					} else {
						$readonly = '';
					}
					?>

					<?php
					$lang = vmLanguage::getLanguage();
					$text = $lang->hasKey($this->orderStatus->order_status_name) ? ' (' . vmText::_($this->orderStatus->order_status_name) . ')' : ' ';

					echo VmuikitHtml::row('input', 'COM_VIRTUEMART_ORDER_STATUS_NAME', 'order_status_name', $this->orderStatus->order_status_name, 'class="inputbox"', '', 50, 50, $text);
					?>

					<?php echo VmuikitHtml::row('select', 'COM_VIRTUEMART_ORDER_STATUS_STOCK_HANDLE', 'order_stock_handle', $this->stockHandelList, $this->orderStatus->order_stock_handle, '', 'value', 'text', false); ?>
					<?php echo VmuikitHtml::row('color', 'COM_VIRTUEMART_ORDER_STATUS_COLOR', 'order_status_color', $this->orderStatus->order_status_color, '', 'value', 'text', false); ?>
					<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_ORDER_STATUS_CODE', 'order_status_code', $this->orderStatus->order_status_code, 'class="inputbox ' . $readonly . '" ' . $readonly . '', '', 3, 1); ?>
					<?php echo VmuikitHtml::row('editor', 'COM_VIRTUEMART_DESCRIPTION', 'order_status_description', $this->orderStatus->order_status_description, '100%;', '250', array('image', 'pagebreak', 'readmore')); ?>
					<?php echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_VENDOR', $this->lists['vendors']); ?>
					<?php echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_ORDERING', $this->ordering); ?>


					<input type="hidden" name="virtuemart_orderstate_id"
							value="<?php echo $this->orderStatus->virtuemart_orderstate_id; ?>"/>
					<?php echo $this->addStandardHiddenToForm(); ?>
				</form>
			</div>
		</div>
	</div>
	<div>
		<div class="uk-card   uk-card-small uk-card-vm ">
			<div class="uk-card-header">
				<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: cog; ratio: 1.2"></span>
					<?php echo vmText::_('COM_VIRTUEMART_ORDERSTATUS_CONFIG_PARAMS') ?>
				</div>
			</div>
			<div class="uk-card-body">

				<table class="uk-table uk-table-small uk-table-striped uk-table-responsive">
					<thead>
					<tr>
						<th>
							<?php echo vmText::_('COM_VIRTUEMART_ORDER_STATUS_EMAIL_SHOPPER'); ?>
						</th>
						<th>
							<?php echo vmText::_('COM_VIRTUEMART_ORDER_STATUS_EMAIL_VENDOR'); ?>
						</th>
						<th>
							<?php //echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_STATUS_PDF_INVOICES'); ?>
							<?php echo vmText::_('COM_VIRTUEMART_ORDER_STATUS_ALLOW_EDIT'); ?>
						</th>
						<th>
							<?php //echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_STATUS_PDF_INVOICES'); ?>
							<?php echo vmText::_('COM_VIRTUEMART_ORDER_STATUS_CREATE_INVOICE'); ?>
						</th>
						<th>
							<?php //echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_STATUS_PDF_INVOICES'); ?>
							<?php echo vmText::_('COM_VIRTUEMART_ORDER_STATUS_DO_REFUND'); ?>
						</th>
						<th>
							<?php //echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_STATUS_PDF_INVOICES'); ?>
							<?php echo vmText::_('COM_VIRTUEMART_ORDER_STATUS_DELIVERY_DATE'); ?>
						</th>
					</tr>
					</thead>
					<tr>
						<td align="center">
							<?php

							if (in_array($this->orderStatus->order_status_code, VmConfig::get('email_os_s', array('U', 'C', 'S', 'R', 'X')))) {
								echo '<span class="icon-mail-2"><span></span></span>';
							}

							?>
						</td>
						<td align="center">
							<?php

							if (in_array($this->orderStatus->order_status_code, VmConfig::get('email_os_v', array('U', 'C', 'R', 'X')))) {
								echo '<span class="icon-mail-2"><span></span></span>';
							}

							?>
						</td>
						<td align="center">
							<?php
							if (in_array($this->orderStatus->order_status_code, VmConfig::get('order_allowedit_os', array('P', 'U')))) {
								echo '<span class="icon-pencil-2 text-success"><span></span></span>';
							} else {
								echo '<span class="icon-lock"><span></span></span>';
							}
							?>
						</td>
						<td align="center">
							<?php

							if (in_array($this->orderStatus->order_status_code, VmConfig::get('inv_os', array('C')))) {
								if (in_array($this->orderStatus->order_status_code, VmConfig::get('refund_os', array('R')))) {
									echo '<span class="icon-file-2 text-error"><span></span></span>';
								} else {
									echo '<span class="icon-file-2 text-success"><span></span></span>';
								}
							}

							?>
						</td>
						<td align="center">
							<?php
							if (in_array($this->orderStatus->order_status_code, VmConfig::get('refund_os', array('R')))) {
								echo '<span class="icon-undo-2 text-error"><span></span></span>';
							}
							?>
						</td>
						<td align="center">
							<?php
							$del_date_type = VmConfig::get('del_date_type', array('m'));
							if ($del_date_type == 'm') {
								$del_date_type = VmConfig::get('inv_os', array('C'));
							}
							if (!is_array($del_date_type)) {
								$del_date_type = array($del_date_type);
							}
							if (in_array($this->orderStatus->order_status_code, $del_date_type)) {
								echo '<span class="icon-box-add text-success"><span></span></span>';
							}
							?>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<?php
vmuikitAdminUIHelper::imitateTabs('end');
vmuikitAdminUIHelper::endAdminArea();
?>
