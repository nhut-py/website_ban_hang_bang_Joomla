<?php
if (!defined('_JEXEC')) {
	die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');
}
/**
 *
 * @package VirtueMart
 * @subpackage Report
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * @version $Id: default.php 10451 2021-01-27 08:16:53Z alatak $
 *
 */

$adminTemplate = VMPATH_ROOT . '/administrator/templates/vmadmin/html/com_virtuemart/';
JLoader::register('vmuikitAdminUIHelper', $adminTemplate . 'helpers/vmuikit_adminuihelper.php');
vmuikitAdminUIHelper::startAdminArea($this);
/* Load some variables */
$rows = count($this->report);
$intervalTitle = vRequest::getVar('intervals', 'day');
if (($intervalTitle == 'week') or ($intervalTitle == 'month')) {
	$addDateInfo = true;
} else {
	$addDateInfo = false;
}

//JHtml::_('behavior.framework', true);

?>
<form action="index.php?option=com_virtuemart&view=report" method="post" name="adminForm" id="adminForm">

	<div id="filterbox" class="filter-bar">
		<h3><?php echo vmText::sprintf('COM_VIRTUEMART_REPORT_TITLE', vmJsApi::date($this->from_period, 'LC', true), vmJsApi::date($this->until_period, 'LC', true)); ?></h3>

		<?php
		$extras = array();
		$tools = array();
		$extras[] = vmText::_('COM_VIRTUEMART_ORDERSTATUS') . $this->lists['state_list'];
		$extras[] = vmText::_('COM_VIRTUEMART_REPORT_INTERVAL') . $this->lists['intervals'];
		$extras[] = vmText::_('COM_VIRTUEMART_REPORT_SET_PERIOD') . $this->lists['select_date'];
		$extras[] = vmText::_('COM_VIRTUEMART_REPORT_FROM_PERIOD') . vmJsApi::jDate($this->from_period, 'from_period');
		$extras[] = vmText::_('COM_VIRTUEMART_REPORT_UNTIL_PERIOD') . vmJsApi::jDate($this->until_period, 'until_period');
		if ($this->showVendors()) {
			$extras[] = $this->lists['vendors'];
		}
		$extras[] = '
		 <button class="uk-button uk-button-small uk-button-default" onclick="this.form.period.value=\"\";this.form.submit();">
		 	<span uk-icon="search"></span>
        </button>
		';


		echo adminSublayouts::renderAdminVmSubLayout('filterbar',
			array(
				'extras' => $extras,
				'resultsCounter' => $this->pagination->getResultsCounter()
			));


		?>

	</div>
	<div id="editcell">
		<table class="uk-table uk-table-small uk-table-striped uk-table-responsive" cellspacing="0" cellpadding="0">
			<thead>
			<tr>
				<th>
					<?php echo $this->sort('created_on', 'COM_VIRTUEMART_' . $intervalTitle); ?>
				</th>
				<th class="uk-text-right@m">
					<?php echo $this->sort('o.virtuemart_order_id', 'COM_VIRTUEMART_REPORT_BASIC_ORDERS'); ?>
				</th>
				<th class="uk-text-right@m">
					<?php echo $this->sort('product_quantity', 'COM_VIRTUEMART_REPORT_BASIC_TOTAL_ITEMS'); ?>
				</th>
				<th class="uk-text-right@m">
					<?php echo $this->sort('order_subtotal_netto', 'COM_VIRTUEMART_REPORT_BASIC_REVENUE_NETTO'); ?>
				</th>
				<th class="uk-text-right@m">
					<?php echo $this->sort('order_subtotal_brutto', 'COM_VIRTUEMART_REPORT_BASIC_REVENUE_BRUTTO'); ?>
				</th>
				<?php
				$intervals = vRequest::getCmd('intervals', 'day');
				if ($intervals == 'product_s'){
					?>
					<th>
						<?php echo $this->sort('order_item_name', 'COM_VIRTUEMART_PRODUCT_NAME'); ?>
					</th>
					<th class="uk-text-right@m">
						<?php echo $this->sort('virtuemart_product_id', 'COM_VIRTUEMART_PRODUCT_ID'); ?>
					</th>
					<?php
				} else /*if(VmConfig::get('multix','none')!='none')*/
				{
				?>
				<th class="uk-text-right@m"><?php
					echo $this->sort('coupon_discount', 'COM_VIRTUEMART_COUPON');
					}
					?>
			</tr>
			</thead>
			<tbody>
			<?php
			$i = 0;
			for ($j = 0; $j < $rows; ++$j) {
				$r = $this->report[$j];

				//$is = $this->itemsSold[$j];
				$s = 0;
				?>
				<tr class="row<?php echo $i; ?>">
					<td >
						<?php echo $r['intervals'];
						if ($addDateInfo) {
							echo ' (' . substr($r['created_on'], 0, 4) . ')';
						}
						?>
					</td>
					<td class="uk-text-right@m">
						<?php
						if ($intervals == 'orders') {
							$link = 'index.php?option=com_virtuemart&view=orders&task=edit&virtuemart_order_id=' . $r['virtuemart_order_id'];
							echo JHtml::_('link', JRoute::_($link, FALSE), $r['order_number'], array('title' => vmText::_('COM_VIRTUEMART_ORDER_EDIT_ORDER_NUMBER') . ' ' . $r['order_number'], 'target' => '_blank'));

						} else {
							echo $r['count_order_id'];
						}
						?>
					</td>
					<td class="uk-text-right@m">
						<?php echo $r['product_quantity']; ?>
					</td>
					<td class="uk-text-right@m">
						<?php echo $r['order_subtotal_netto']; ?>
					</td>
					<td class="uk-text-right@m">
						<?php echo $r['order_subtotal_brutto']; ?>
					</td>
					<?php if ($intervals == 'product_s') {
						?>
						<td>
							<?php echo $r['order_item_name']; ?>
						</td>
						<td  class="uk-text-right@m">
							<?php echo $r['virtuemart_product_id']; ?>
						</td>

					<?php } else /*if(VmConfig::get('multix','none')!='none')*/ { ?>
						<td class="uk-text-right@m">
							<?php echo $r['coupon_discount']; ?>
						</td>
					<?php } ?>

				</tr>
				<?php
				$i = 1 - $i;
			}
			?>
			</tbody>
			<thead>
			<tr>
				<td class="uk-text-right@m"><strong><?php echo vmText::_('COM_VIRTUEMART_TOTAL') . ' : '; ?></strong></td>
				<td class="uk-text-right@m"><strong><?php echo $this->totalReport['number_of_ordersTotal'] ?></strong></td>
				<td class="uk-text-right@m"><strong><?php echo $this->totalReport['itemsSoldTotal']; ?></strong></td>
				<td class="uk-text-right@m"><strong><?php echo $this->totalReport['revenueTotal_netto']; ?></strong></td>
				<td class="uk-text-right@m"><strong><?php echo $this->totalReport['revenueTotal_brutto']; ?></strong></td>
				<td></td>
			</tr>
			</thead>
			<tfoot>
			<tr>
				<td colspan="10">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
			</tfoot>
		</table>
	</div>

	<?php echo $this->addStandardHiddenToForm(); ?>
</form>

<?php vmuikitAdminUIHelper::endAdminArea(); ?>

