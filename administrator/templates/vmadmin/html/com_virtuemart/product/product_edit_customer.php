<?php
/**
 *
 * Handle the waitinglist, and the send an email to shoppers who bought this product
 *
 * @package    VirtueMart
 * @subpackage Product
 * @author Seyi
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: product_edit_customer.php 10451 2021-01-27 08:16:53Z alatak $
 */
// Check to ensure this file is included in Joomla!
defined ('_JEXEC') or die('Restricted access');

$stockhandle = $this->product->product_stockhandle ? $this->product->product_stockhandle : VmConfig::get ('stockhandle', 0);

$i = 0;
?>
<table class="uk-table uk-table-striped uk-table-responsive">
	<tbody>
	<tr class="row<?php echo $i?>">
		<td width="21%" valign="top">
			<?php
			$mail_options = array(
				'customer'=> vmText::_ ('COM_VIRTUEMART_PRODUCT_SHOPPERS')
			);
			if ($stockhandle != 'disableadd' or empty($this->waitinglist)) {
				echo VmHtml::radioList ('customer_email_type', 'customer', $mail_options, 'style="display:none;"');
			}
			else {
				$mail_default = 'notify';
				$mail_options['notify'] = vmText::_ ('COM_VIRTUEMART_PRODUCT_WAITING_LIST_USERLIST');
				echo VmHtml::radioList ('customer_email_type', $mail_default, $mail_options);
			}
			?>

			<div id="notify_particulars" style="padding-left:20px;">
				<div><input type="checkbox" name="notification_template" id="notification_template" value="1" CHECKED>
					<label for="notification_template">
						<span uk-tooltip="<?php echo vmText::_ ('COM_VIRTUEMART_PRODUCT_USE_NOTIFY_TEMPLATE_TIP'); ?>">
						<?php echo vmText::_ ('COM_VIRTUEMART_PRODUCT_USE_NOTIFY_TEMPLATE'); ?></span>
					</label>
				</div>
				<div><input type="text" name="notify_number" value="" size="4"/><?php echo vmText::_ ('COM_VIRTUEMART_PRODUCT_NOTIFY_NUMBER'); ?></div>
			</div>
			<br/>

			<div class="mailing">
				<div class="button2-left btn-wrapper  uk-button uk-button-small uk-button-primary" data-type="sendmail">
					<div class="blank" style="padding:0 6px;cursor: pointer;" title="<?php echo vmText::_ ('COM_VIRTUEMART_PRODUCT_EMAIL_SEND_TIP'); ?>">
						<span uk-icon="icon: mail" class="uk-margin-small-right"></span>
						<?php echo vmText::_ ('COM_VIRTUEMART_PRODUCT_EMAIL_SEND'); ?>
					</div>
				</div>
				<div id="customers-list-msg"></div>
				<br/>
			</div>

		</td>
	</tr>
	<?php $i = 1 - $i; ?>
	<tr class="row<?php echo $i?>">
		<td width="21%" valign="top">
			<div id="customer-mail-content">
				<div><?php echo vmText::_ ('COM_VIRTUEMART_PRODUCT_EMAIL_SUBJECT') ?></div>
				<input type="text" class="mail-subject input-xxlarge" id="mail-subject" size="100"   value="<?php echo vmText::sprintf ('COM_VIRTUEMART_PRODUCT_EMAIL_SHOPPERS_SUBJECT',$this->product->product_name) ?>">

				<div><?php echo vmText::_ ('COM_VIRTUEMART_PRODUCT_EMAIL_CONTENT') ?></div>
				<textarea class="uk-textarea"   id="mail-body" ></textarea>
				<br/>
			</div>
		</td>
	</tr>
	<?php $i = 1 - $i; ?>
	<tr class="row<?php echo $i?>">
		<td width="21%" valign="top">
			<div id="customer-mail-list">
				<span uk-tooltip="<?php echo vmText::_ ('COM_VIRTUEMART_PRODUCT_EMAIL_ORDER_ITEM_STATUS_TIP'); ?>">
				<strong><?php echo vmText::_ ('COM_VIRTUEMART_PRODUCT_EMAIL_ORDER_ITEM_STATUS') ?></strong>
				</span><br/>
				<?php echo $this->lists['OrderStatus'];?>
				<br/> <br/>
				<div style="font-weight:bold;"><?php echo vmText::sprintf ('COM_VIRTUEMART_PRODUCT_SHOPPERS_LIST', $this->product->product_name); ?></div>
				<table class="uk-table uk-table-small uk-table-striped uk-table-responsive ui-sortable" >
					<thead>
					<tr>
						<th ><?php echo $this->sort ('ou.first_name', 'COM_VIRTUEMART_NAME','edit');?></th>
						<th  ><?php echo $this->sort ('ou.email', 'COM_VIRTUEMART_EMAIL','edit');?></th>
						<th  ><?php echo vmText::_ ('COM_VIRTUEMART_SHOPPER_FORM_PHONE');?></th>
						<th  ><?php echo vmText::_ ('COM_VIRTUEMART_ORDER_PRINT_QUANTITY');?></th>
						<th  ><?php echo vmText::_ ('COM_VIRTUEMART_ORDER_PRINT_ITEM_STATUS');?></th>
						<th  ><?php echo $this->sort ('o.order_number', 'COM_VIRTUEMART_ORDER_NUMBER', 'edit');?></th>
						<th  ><?php echo $this->sort ('order_date', 'COM_VIRTUEMART_ORDER_CDATE','edit');?></th>
					</tr>
					</thead>
					<tbody id="customers-list">
					<?php
					echo ShopFunctions::renderProductShopperList($this->productShoppers);
					?>
					</tbody>
				</table>
			</div>

			<div id="customer-mail-notify-list">

				<?php if ($stockhandle == 'disableadd' && !empty($this->waitinglist)) { ?>
				<div style="font-weight:bold;"><?php echo vmText::_ ('COM_VIRTUEMART_PRODUCT_WAITING_LIST_USERLIST'); ?></div>
				<table class="adminlist table" cellspacing="0" cellpadding="0">
					<thead>
					<tr>
						<th class="title"><?php echo vmText::_ ('COM_VIRTUEMART_NAME');?></th>
						<th class="title"><?php echo vmText::_ ('COM_VIRTUEMART_USERNAME');?></th>
						<th class="title"><?php echo vmText::_ ('COM_VIRTUEMART_EMAIL');?></th>
                        <th class="title"><?php echo vmText::_ ('COM_VIRTUEMART_CREATED_ON');?></th>
					</tr>
					</thead>
					<tbody id="customers-notify-list">
						<?php
						if (isset($this->waitinglist) && count ($this->waitinglist) > 0) {
							$i=0;
							foreach ($this->waitinglist as $key => $wait) {
								if ($wait->virtuemart_user_id == 0) {
									$row = '<tr class="row'.$i.'"><td></td><td></td><td><a href="mailto:' . $wait->notify_email . '">' .
									$wait->notify_email . '</a></td><td>' .  vmJsApi::date($wait->created_on, 'LC2', TRUE) . '</td></tr>';
								}
								else {
									$row = '<tr class="row'.$i.'"><td>' . $wait->name . '</td><td>' . $wait->username . '</td><td>' . '<a href="mailto:' . $wait->notify_email . '">' . $wait->notify_email . '</a>' . '</td> <td>' . vmJsApi::date($wait->created_on, 'LC2', TRUE) . '</td></tr>';
								}
								echo $row;
								$i = 1 - $i;
							}
						}
						else {
							?>
						<tr>
							<td colspan="4">
								<?php echo vmText::_ ('COM_VIRTUEMART_PRODUCT_WAITING_NOWAITINGUSERS'); ?>
							</td>
						</tr>
							<?php
						} ?>
					</tbody>
				</table>

				<?php } ?>
			</div>

		</td>
	</tr>
	<tr>
		<td>
			<?php
			// ALK Problem with that link
			//$aflink = '<a target="_blank" href="https://www.acyba.com/?partner_id=19513"><img title="AcyMailing2" src="https://www.acyba.com/images/banners/affiliate2.png"/></a>';
			//echo vmText::sprintf('COM_VIRTUEMART_AD_ACY',$aflink);
			?>
		</td>
	</tr>
	</tbody>
</table>
