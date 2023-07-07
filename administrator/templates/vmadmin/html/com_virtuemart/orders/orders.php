<?php
/**
 *
 *
 * @package    VirtueMart
 * @subpackage
 * @author VirtueMart Team, Max Milbers
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: orders.php 10451 2021-01-27 08:16:53Z alatak $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$adminTemplate = VMPATH_ROOT . '/administrator/templates/vmadmin/html/com_virtuemart/';
JLoader::register('vmuikitAdminUIHelper', $adminTemplate . 'helpers/vmuikit_adminuihelper.php');
vmuikitAdminUIHelper::startAdminArea($this);

$styleDateCol = '';
?>

	<form action="index.php?option=com_virtuemart&view=orders" method="post" name="adminForm" id="adminForm">

		<div id="filterbox" class="filter-bar">
			<?php
			$extras[] = '<span class="uk-margin-small-right">' . vmText::_('COM_VIRTUEMART_ORDERSTATUS') . '</span>' . $this->lists['state_list'];
			$tool['title'] = vmText::_('COM_VIRTUEMART_BULK_ORDERSTATUS');
			$tool['subtitle'] = vmText::_('COM_VIRTUEMART_PLEASE_MAKE_A_SELECTION_FROM_THE_LIST');
			$tool['fields'] = array(
				$this->lists['bulk_state_list'],
				VmuikitHtml::row('checkbox', 'COM_VIRTUEMART_ORDER_LIST_NOTIFY', 'customer_notified', 0),
				VmuikitHtml::row('checkbox', 'COM_VIRTUEMART_ORDER_HISTORY_INCLUDE_COMMENT', 'customer_send_comment', 1),
				VmuikitHtml::row('checkbox', 'COM_VIRTUEMART_ORDER_UPDATE_LINESTATUS', 'update_lines', 1),
				VmuikitHtml::row('textarea', 'COM_VIRTUEMART_ADD_COMMENT', 'comments', '', 'class="uk-textarea"', 80)
			);
			$tool['footer'] = '
<button onclick="Joomla.submitbutton(\'updatestatus\');" class="uk-button uk-button-small uk-button-primary uk-text-center">
' . vmText::_('COM_VIRTUEMART_UPDATE_STATUS') . '</button>';

			$tools[] = $tool;
			echo adminSublayouts::renderAdminVmSubLayout('filterbar',
				array(
					'search' => array(
						'label' => 'COM_VIRTUEMART_ORDER_PRINT_NAME',
						'name' => 'search',
						'value' => vRequest::getVar('search')
					),
					'extras' => $extras,
					'tools' => $tools,
					'resultsCounter' => $this->pagination->getResultsCounter()
				));


			?>

		</div>


		<div>
			<table class="uk-table  uk-table-small uk-table-striped uk-table-responsive">
				<thead>
				<tr>
					<th>
						<input type="checkbox" name="toggle" value=""
								onclick="Joomla.checkAll(this)"/>
					</th>
					<th><?php echo $this->sort('order_number', 'COM_VIRTUEMART_ORDER_LIST_NUMBER') ?> / <?php echo vmText::_('COM_VIRTUEMART_INVOICE') ?></th>
					<th>
						<?php echo $this->sort('order_name', 'COM_VIRTUEMART_ORDER_PRINT_NAME') . ' / ';
						echo $this->sort('order_email', 'COM_VIRTUEMART_EMAIL') ?>
					</th>
					<th><?php echo $this->sort('payment_method', 'COM_VIRTUEMART_ORDER_PRINT_PAYMENT_LBL') ?></th>
					<th><?php echo $this->sort('shipment_method', 'COM_VIRTUEMART_ORDER_PRINT_SHIPMENT_LBL') ?></th>
					<th><?php echo vmText::_('COM_VIRTUEMART_PRINT_VIEW'); ?></th>
					<th class="uk-width-small admin-dates"><?php echo $this->sort('created_on', 'COM_VIRTUEMART_ORDER_CDATE') ?></th>
					<th class="uk-width-small admin-dates"><?php echo $this->sort('modified_on', 'COM_VIRTUEMART_ORDER_LIST_MDATE') ?></th>
					<th><?php echo $this->sort('paid', 'COM_VM_ORDER_PAID') ?></th>
					<th><?php echo $this->sort('order_status', 'COM_VIRTUEMART_STATUS') ?></th>
					<!--<th style="min-width:130px;width:5%;"><?php echo vmText::_('COM_VIRTUEMART_ORDER_LIST_NOTIFY'); ?></th>-->
					<th><?php echo $this->sort('order_total', 'COM_VIRTUEMART_TOTAL') ?></th>
					<th class="uk-table-shrink"><?php echo $this->sort('virtuemart_order_id', 'COM_VIRTUEMART_ID') ?></th>

				</tr>
				</thead>
				<tbody>
				<?php
				if (count($this->orderslist) > 0) {
					$i = 0;
					$k = 0;
					$keyword = vRequest::getCmd('keyword');

					foreach ($this->orderslist as $key => $order) {
						$checked = JHtml::_('grid.id', $i, $order->virtuemart_order_id);

//				setup some order variables
//                      colors
						$statuscolorStyle = '';
						if (!empty($this->orderStatesColors[$order->order_status])) {
							$statuscolorStyle = "background-color:" . $this->orderStatesColors[$order->order_status];
						}

						$shipmentcolorStyle = '';
						if (!empty($this->shipmentColors[$order->virtuemart_shipmentmethod_id])) {
							$shipmentcolorStyle = "background-color:" . $this->shipmentColors[$order->virtuemart_shipmentmethod_id];
						}

//                     order paid determined items
						if ($order->paid < $order->order_total) {
							$orderStati = $this->orderStatesUnpaid;
						} else {
							$orderStati = $this->orderstatuses;
						}
//                        order status name for display
						$status_name = ' ';
						foreach ($orderStati as $orderSt) {
							if ($orderSt->order_status_code == $order->order_status) {
								$status_name = $orderSt->order_status_name;
							}
						}
						?>
						<tr class="row<?php echo $k . ' status-' . strtolower($order->order_status); ?>">
							<!-- Checkbox -->
							<td><?php echo $checked; ?></td>
							<!-- Order id -->
							<?php
							$link = 'index.php?option=com_virtuemart&view=orders&task=edit&virtuemart_order_id=' . $order->virtuemart_order_id;
							?>
							<td>
								<div class="uk-label uk-label-vm uk-width-1-1"
										style="<?php echo $statuscolorStyle ?>">
									<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
											uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_ORDER_LIST_NUMBER') ?>"
											uk-icon="icon: hashtag"></span>
									<?php echo JHtml::_('link', JRoute::_($link, FALSE), $order->order_number, array('title' => vmText::_('COM_VIRTUEMART_ORDER_EDIT_ORDER_NUMBER') . ' ' . $order->order_number)); ?>
								</div>

								<span class="uk-visible@m">
									<?php
									echo implode(' ', $order->invoiceNumbers);
									?>
								</span>

							</td>
							<td>
								<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
										uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_NAME') ?>"
										uk-icon="icon: user"></span>
								<?php
								$orderName = html_entity_decode($order->order_name);
								if ($order->virtuemart_user_id) {
									$userlink = JRoute::_('index.php?option=com_virtuemart&view=user&task=edit&virtuemart_user_id[]=' . $order->virtuemart_user_id, FALSE);
									echo JHtml::_('link', $userlink, $orderName, array('title' => vmText::_('COM_VIRTUEMART_ORDER_EDIT_USER') . ' ' . $orderName));
								} else {
									echo $orderName;
								}
								?>
								<br>
								<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
										uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_EMAIL') ?>"
										uk-icon="icon: mail"></span>
								<?php
								echo $order->order_email;
								?>
							</td>

							<!-- Payment method -->
							<td>
											<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
													uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_PAYMENT_LBL') ?>"
													uk-icon="icon: credit-card"></span>
								<span class="uk-label  uk-label-vm"><?php echo $order->payment_method; ?></span>
							</td>
							<!-- Shipment method -->
							<td>
								<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
										uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_ORDER_PRINT_SHIPMENT_LBL') ?>"
										uk-icon="icon: shipment"></span>
								<div class="uk-label uk-label-vm"
										style="<?php echo $shipmentcolorStyle ?>"><?php echo $order->shipment_method; ?></div>


							</td>
							<!-- Print view -->
							<td>
									<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
											uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRINT_VIEW') ?>"
											uk-icon="icon: print"></span>
								<?php
								echo adminSublayouts::renderAdminVmSubLayout('print_links',
									array('order' => $order)
								);
								?>
							</td>
							<!-- Order date -->
							<td>
								<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
										uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_ORDER_CDATE') ?>"
										uk-icon="icon: calendar"></span>
								<?php echo vmJsApi::date($order->created_on, 'LC2', TRUE); ?></td>
							<!-- Last modified -->
							<td>
								<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
										uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_ORDER_LIST_MDATE') ?>"
										uk-icon="icon: clock"></span>
								<?php echo vmJsApi::date($order->modified_on, 'LC2', TRUE); ?></td>
							<!-- Status -->
							<td class="uk-text-center@m">
								<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
										uk-tooltip="<?php echo vmText::_('COM_VM_ORDER_PAID') ?>"
										uk-icon="icon: tag"></span>
								<?php
								// 	function toggle( $field, $i, $toggle, $imgY = 'tick.png', $imgX = 'publish_x.png', $untoggleable = false )
								echo $this->toggle($order->paid, $i, 'toggle.paid'); ?>
							</td>

							<td>
								<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
											uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_STATUS') ?>"
											uk-icon="icon: future"></span>
								<div class="uk-label  uk-label-vm" style="<?php echo $statuscolorStyle ?>">
									<?php echo vmText::_($status_name) ?>
									<span class="" uk-icon="icon:  triangle-down"></span>
								</div>
								<div class="uk-width-large uk-form-horizontal uk-card-tab-content"
										uk-dropdown="mode: click;animation: uk-animation-slide-bottom-small; duration: 1000">
									<div class=" ">
										<div class="uk-card-title">
											<span class="md-color-grey-500 uk-margin-small-right"
													uk-icon="icon: comment; ratio: 1.2"></span>
											<?php echo  vmText::_('COM_VIRTUEMART_ORDER_UPDATE_STATUS').' '.$order->order_number  ?>
										</div>
										<hr/>

										<div class="uk-clearfix">
											<label class="uk-form-label"><?php echo vmText::_('COM_VIRTUEMART_ORDERSTATUS') ?></label>
											<div class="uk-form-controls">
												<?php
												echo JHtml::_('select.genericlist', $orderStati, "orders[" . $order->virtuemart_order_id . "][order_status]", 'class="orderstatus_select" style="width:180px"', 'order_status_code', 'order_status_name', $order->order_status, 'order_status' . $i, TRUE);
												?>
											</div>
										</div>
										<input type="hidden"
												name="orders[<?php echo $order->virtuemart_order_id; ?>][current_order_status]"
												value="<?php echo $order->order_status; ?>"/>
										<input type="hidden"
												name="orders[<?php echo $order->virtuemart_order_id; ?>][coupon_code]"
												value="<?php echo $order->coupon_code; ?>"/>
										<br>
										<?php
										echo VmuikitHtml::row('checkbox', 'COM_VIRTUEMART_ORDER_LIST_NOTIFY', 'orders[' . $order->virtuemart_order_id . '][customer_notified]', 0);
										echo VmuikitHtml::row('checkbox', 'COM_VIRTUEMART_ORDER_HISTORY_INCLUDE_COMMENT', 'orders[' . $order->virtuemart_order_id . '][customer_send_comment]', 1);
										echo VmuikitHtml::row('checkbox', 'COM_VIRTUEMART_ORDER_UPDATE_LINESTATUS', 'orders[' . $order->virtuemart_order_id . '][update_lines]', 1);
										echo VmuikitHtml::row('textarea', 'COM_VIRTUEMART_ADD_COMMENT', 'orders[' . $order->virtuemart_order_id . '][comments]', '', 'class="uk-textarea"');
										?>
										<hr/>
										<div class="uk-text-center">
											<button onclick="Joomla.submitbutton('updatestatus');"
													class="uk-button uk-button-small uk-button-primary">
												<?php echo vmText::_('COM_VIRTUEMART_UPDATE_STATUS') ?>
											</button>
										</div>
									</div>
								</div><!-- uk-dropdown -->
							</td>
							<!-- Total -->
							<td class="uk-text-nowrap uk-text-right@m">
									<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
											uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_TOTAL') ?>"
											uk-icon="icon: cart"></span>
								<?php echo $order->order_total; ?></td>
							<td class="uk-text-center@m">
								<span class="uk-hidden@m uk-margin-small-right md-color-grey-500"
										uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_ID') ?>"
										uk-icon="icon: hashtag"></span>

								<?php echo JHtml::_('link', JRoute::_($link, FALSE), $order->virtuemart_order_id, array('title' => vmText::_('COM_VIRTUEMART_ORDER_EDIT_ORDER_ID') . ' ' . $order->virtuemart_order_id)); ?>
							</td>

						</tr>
						<?php
						$k = 1 - $k;
						$i++;
					}
				}
				?>
				</tbody>
				<tfoot>
				<tr>
					<td colspan="12">
						<?php echo $this->pagination->getListFooter(); ?>
					</td>
				</tr>
				</tfoot>
			</table>
		</div>
		<!-- Hidden Fields -->
		<?php echo $this->addStandardHiddenToForm(); ?>
	</form>
<?php vmuikitAdminUIHelper::endAdminArea();

$orderstatusForShopperEmail = VmConfig::get('email_os_s', array('U', 'C', 'S', 'R', 'X'));
if (!is_array($orderstatusForShopperEmail)) {
	$orderstatusForShopperEmail = array($orderstatusForShopperEmail);
}
$jsOrderStatusShopperEmail = vmJsApi::safe_json_encode($orderstatusForShopperEmail);

$j = 'if (typeof Virtuemart === "undefined")
	var Virtuemart = {};
	Virtuemart.orderstatus = ' . $jsOrderStatusShopperEmail . ';
	jQuery(document).ready(function() {
		//Virtuemart.onReadyOrderItems();
		Virtuemart.onReadyOrderStatus()
	});';
vmJsApi::addJScript('onReadyOrders', $j);

vmJsApi::addJScript('/administrator/components/com_virtuemart/assets/js/orders.js', false, false);
?>