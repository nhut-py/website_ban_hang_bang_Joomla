<?php
/**
 *
 * Display form details
 *
 * @package	VirtueMart
 * @subpackage Orders
 * @author Oscar van Eijk, Max Milbers
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: order_item.php 10431 2021-01-21 15:22:32Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$lId=0;
$item=$this->item;
$i=0;
?>


<td>
	<?php // TODO : commenting dynoTable way at the moment ?>
	<!--span class="vmicon vmicon-16-remove order-item-remove"></span-->
	<?php // TODO COM_VIRTUEMART_ORDER_DELETE_ITEM_JS : _JS Why ? ?>
	<?php if(vmAccess::manager('orders.edit')) { ?>
		<?php if (!VmConfig::get('ordersAddOnly',false)) { ?>
			<a href="#" uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_ORDER_DELETE_ITEM_JS'). ' ' . $item->order_item_name ; ?>"
					onClick="javascript:Virtuemart.removeItem(event,<?php echo $item->virtuemart_order_item_id; ?>);">
				<div class=" 4remove orderEdit" uk-icon="icon: trash"></div></a>
		<?php } ?>
		<?php //TODO: change vmicon-16-move and create vmicon-16-clone class ?>
		<div class=" order-item-clone orderEdit uk-margin-small-top" uk-icon="icon: copy" uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_ORDER_ITEM_CLONE'). ' ' . $item->order_item_name ; ?>"></div>
	<?php } ?>
</td>
<td>
		<span class='orderView'>
			<?php echo $item->product_quantity; ?>
		</span>
	<input class='input-mini orderEdit' type="text" size="3" name="item_id[<?php echo $item->virtuemart_order_item_id; ?>][product_quantity]" value="<?php echo $item->product_quantity; ?>"/>
	<?php //if(empty($item->virtuemart_product_id)) { ?>

	<?php //} ?>
</td>
<td>
	<span class='orderView'><?php echo $item->order_item_name; ?></span>

	<input class='orderEdit' type="text"  name="item_id[<?php echo $item->virtuemart_order_item_id; ?>][order_item_name]" value="<?php echo vRequest::vmHtmlEntities($item->order_item_name); ?>" style="width:90%;min-width:100px" />
	<?php if ($item->virtuemart_order_item_id > 0 ) { ?>
		<div class="goto-product">
			<a href="<?php echo $item->linkedit ?>" target="_blank"
					uk-tooltip="<?php echo vmText::_('COM_VM_GOTO_PRODUCT') . ' ' . $item->order_item_name ?>">
				<span uk-icon="icon: link"></span>
			</a>
		</div>

		<?php
		$product_attribute = VirtueMartModelCustomfields::CustomsFieldOrderDisplay($item, 'BE');
		if ($product_attribute) {
			echo '<div>' . $product_attribute . '</div>';
		}

		$_dispatcher = JDispatcher::getInstance();
		$_returnValues = $_dispatcher->trigger('plgVmOnShowOrderLineBEShipment', array($this->orderID, $item->virtuemart_order_item_id));
		$_plg = '';
		foreach ($_returnValues as $_returnValue) {
			if ($_returnValue !== null) {
				$_plg .= $_returnValue;
			}
		}
		if ($_plg !== '') {
			echo '<table class="uk-table uk-table-small uk-table-responsive">'
				. '<tr>'
				. '<td width="8px"></td>' // Indent
				. '<td>' . $_plg . '</td>'
				. '</tr>'
				. '</table>';
		}
	}
	?>
</td>
<td>
	<span class='orderView'><?php echo $item->order_item_sku; ?></span>
	<span class='orderEdit'><?php echo vmText::_('COM_VIRTUEMART_ORDER_ITEM_ENTER_SKU_PRODUCT_ID') ?></span>
	<input class='orderEdit' type="text" name="item_id[<?php echo $item->virtuemart_order_item_id; ?>][order_item_sku]" value="<?php echo $item->order_item_sku; ?>" placeholder="<?php echo vmText::_('COM_VIRTUEMART_ORDER_ITEM_ENTER_SKU') ?>"/><br>

	<input class='orderEdit' type="text" size="10" name="item_id[<?php echo $item->virtuemart_order_item_id; ?>][virtuemart_product_id]" value="<?php echo $item->virtuemart_product_id; ?>" placeholder="<?php echo vmText::_('COM_VIRTUEMART_ORDER_ITEM_ENTER_PRODUCT_ID') ?>"/>

</td>
<td class="uk-text-center@m">
	<!--<?php echo $this->orderstatuslist[$item->order_status]; ?><br />-->
	<?php echo $this->itemstatusupdatefields[$item->virtuemart_order_item_id]; ?>

</td>
<td class="uk-text-right@m" >
	<?php
	$item->product_discountedPriceWithoutTax = (float) $item->product_discountedPriceWithoutTax;
	if (!empty($item->product_discountedPriceWithoutTax) and !empty($item->product_priceWithoutTax) and $this->currency->roundByPriceConfig($item->product_discountedPriceWithoutTax) != $this->currency->roundByPriceConfig($item->product_priceWithoutTax)) {
		echo '<span >'.$this->currency->priceDisplay($item->product_item_price) .'</span><br />';
		echo '<span style="color:darkgrey" >'.$this->currency->priceDisplay($item->product_discountedPriceWithoutTax) .'</span>';
	} else {
		echo '<span >'.$this->currency->priceDisplay($item->product_item_price) .'</span>';
	}
	?><br />
	<input class='orderEdit' type="text" size="8" name="item_id[<?php echo $item->virtuemart_order_item_id; ?>][product_item_price]" value="<?php echo $item->product_item_price; ?>"/>
</td>
<td class="uk-text-right@m" >
	<?php echo $this->currency->priceDisplay($item->product_basePriceWithTax); ?><br />
	<input class='orderEdit' type="text" size="8" name="item_id[<?php echo $item->virtuemart_order_item_id; ?>][product_basePriceWithTax]" value="<?php echo $item->product_basePriceWithTax; ?>"/>
</td>
<td class="uk-text-right@m" >
	<?php echo $this->currency->priceDisplay($item->product_final_price); ?><br />
	<input class='orderEdit' type="text" size="8" name="item_id[<?php echo $item->virtuemart_order_item_id; ?>][product_final_price]" value="<?php echo $item->product_final_price; ?>"/>
</td>
<td class="uk-text-right@m" >
	<?php echo $this->currency->priceDisplay( $item->product_tax); ?><br />
	<input class='orderEdit' type="text" size="12" name="item_id[<?php echo $item->virtuemart_order_item_id; ?>][product_tax]" value="<?php echo $item->product_tax; ?>"/>
	<span style="display: block; font-size: 80%;" title="<?php echo vmText::_('COM_VIRTUEMART_ORDER_EDIT_CALCULATE_DESC'); ?>">
			<input class='orderEdit' type="checkbox" name="item_id[<?php echo $item->virtuemart_order_item_id; ?>][calculate_product_tax]" value="1" checked="checked" /> <label class='orderEdit' for="calculate_product_tax"><?php echo vmText::_('COM_VIRTUEMART_ORDER_EDIT_CALCULATE'); ?></label>
		</span>
</td>
<td class="uk-text-right@m" >
	<?php echo $this->currency->priceDisplay( $item->product_subtotal_discount); ?><br />
	<input class='orderEdit' type="text" size="8" name="item_id[<?php echo $item->virtuemart_order_item_id; ?>][product_subtotal_discount]" value="<?php echo $item->product_subtotal_discount; ?>"/>
</td>
<td class="uk-text-right@m" >
	<?php
	$item->product_basePriceWithTax = (float) $item->product_basePriceWithTax;
	if(!empty($item->product_basePriceWithTax) && $item->product_basePriceWithTax != $item->product_final_price ) {
		echo '<span style="text-decoration:line-through" >'.$this->currency->priceDisplay($item->product_basePriceWithTax,$this->currency,$item->product_quantity) .'</span><br />' ;
	}
	elseif (empty($item->product_basePriceWithTax) && $item->product_item_price != $item->product_final_price) {
		echo '<span style="text-decoration:line-through">' . $this->currency->priceDisplay($item->product_item_price,$this->currency,$item->product_quantity) . '</span><br />';
	}
	echo $this->currency->priceDisplay($item->product_subtotal_with_tax);
	?>
	<input class='orderEdit' type="hidden" size="8" name="item_id[<?php echo $item->virtuemart_order_item_id; ?>][product_subtotal_with_tax]" value="<?php echo $item->product_subtotal_with_tax; ?>"/>
	<?php $attr = array('class' => '', 'style' => 'width:160px;display:none', 'multiple' => true);
	echo '<span class="orderEdit" style="display:none">';
	echo JHtml::_('select.genericlist', $this->taxList, 'item_id['.$item->virtuemart_order_item_id.'][product_tax_id][]', $attr, 'value', 'text', $item->tax_rule_id, '[',true);
	echo '<span>';
	?>
</td>
