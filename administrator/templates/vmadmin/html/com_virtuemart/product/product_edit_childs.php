<?php
/**
 *
 * Main product information
 *
 * @package    VirtueMart
 * @subpackage Product
 * @author Max Milbers
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: product_edit_childs.php 10451 2021-01-27 08:16:53Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

$i = 0;
?>


<div class="uk-card   uk-card-small uk-card-vm ">
	<div class="uk-card-header">
		<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: tree; ratio: 1.2"></span>
			<span>
							<?php
							echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_CHILD_PARENT');
							?>

							<?php
							$parentRel = '';
							if ($this->product->product_parent_id) {
								$parentRel = vmText::sprintf('COM_VIRTUEMART_PRODUCT_FORM_PARENT', JHtml::_('link', JRoute::_('index.php?option=com_virtuemart&view=product&task=edit&virtuemart_product_id=' . $this->product->product_parent_id),
										$this->product_parent->product_name, array('title' => vmText::_('COM_VIRTUEMART_EDIT') . ' ' . $this->product_parent->product_name)) . ' =&gt; ');
							}
							echo vmText::sprintf('COM_VIRTUEMART_PRODUCT_INFORMATION', $parentRel);
							echo ' id: ' . $this->product->virtuemart_product_id ?>
				</span>
		</div>
	</div>
	<div class="uk-card-body">


		<?php
		if ($this->product->virtuemart_product_id) {
			$link = JROUTE::_('index.php?option=com_virtuemart&view=product&task=createChild&virtuemart_product_id=' . $this->product->virtuemart_product_id . '&' . JSession::getFormToken() . '=1');
			$add_child_button = "";
		} else {
			$link = "";
			$add_child_button = " not-active";
		}
		?>
		<div class="button2-left <?php echo $add_child_button ?> btn-wrapper">
			<div class="blank">
				<?php if ($link) { ?>
				<a href="<?php echo $link ?>" class="uk-button uk-button-small uk-button-primary">
					<?php } else { ?>
					<span uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_ADD_CHILD_TIP'); ?>">
							<?php } ?>
							<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_ADD_CHILD'); ?>
							</span>
					<?php if ($link) { ?>
				</a>
			<?php } ?>
			</div>
		</div>

		<?php if (count($this->product_childs) > 0) {

			$customs = array();
			if (!empty($this->product->customfields)) {
				foreach ($this->product->customfields as $custom) {
					//vmdebug('my custom',$custom);
					if ($custom->field_type == 'A') {
						$customs[] = $custom;
					}
				}
			}
			// vmdebug('ma $customs',$customs);
			?>

			<table class="uk-table uk-table-small uk-table-striped uk-table-responsive">
				<tr>
					<th ><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_CHILD') ?></th>
					<th ><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_CHILD_NAME') ?></th>
					<th ><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_GTIN') ?></th>
					<th ><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_PRICE_COST') ?></th>
					<th ><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_IN_STOCK') ?></th>
					<th ><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_ORDERED_STOCK') ?></th>
					<?php
					$js = '';
					$disabled = '';
					foreach ($customs as $custom) {
						$attrib = $custom->customfield_value;

						if ($attrib == 'product_name') {
							$js = true;
						}
						?>
						<th >
							<?php echo vmText::sprintf('COM_VIRTUEMART_PRODUCT_CUSTOM_FIELD_N', vmText::_('COM_VIRTUEMART_' . strtoupper($custom->customfield_value))) ?>
						</th>
					<?php }
					if ($js) {
						$js = 'jQuery(document).ready(function($) {
										$(\'input[class~="productname"]\').on(\'keyup change\', function(event) {
											id= "#"+$(this).attr("id")+"1";
											$(id).val($(this).val());
										});
									});';
						vmJsApi::addJScript('vm-childProductName', $js);
					}
					?>
					<th ><?php echo vmText::_('COM_VIRTUEMART_ORDERING') ?></th>
					<th ><?php echo vmText::_('COM_VIRTUEMART_PUBLISHED') ?></th>
				</tr>
				<?php foreach ($this->product_childs as $child) {
					$i = 1 - $i; ?>
					<tr class="row<?php echo $i ?>">
						<td>
							<?php echo JHTML::_('link', JRoute::_('index.php?option=com_virtuemart&view=product&task=edit&virtuemart_product_id=' . $child->virtuemart_product_id), $child->slug, array('title' => vmText::_('COM_VIRTUEMART_EDIT') . ' ' . vRequest::vmHtmlEntities($child->product_name), 'target' => '_blank')) ?>
							<!--input type="hidden" name="childs[<?php echo $child->virtuemart_product_id ?>][slug]" id="child<?php echo $child->virtuemart_product_id ?>slug" value="<?php echo $child->slug ?>" /-->
						</td>
						<td><input type="text" class="inputbox productname"
									name="childs[<?php echo $child->virtuemart_product_id ?>][product_name]"
									id="child<?php echo $child->virtuemart_product_id ?>product_name" size="32"
									value="<?php echo vRequest::vmHtmlEntities($child->product_name) ?>"/></td>
						<td><input type="text" class="inputbox"
									name="childs[<?php echo $child->virtuemart_product_id ?>][product_gtin]"
									id="child<?php echo $child->virtuemart_product_id ?>product_gtin" size="32"
									maxlength="64" value="<?php echo $child->product_gtin ?>"/></td>

						<td>
							<input type="text" class="inputbox uk-form-width-small"
									name="childs[<?php echo $child->virtuemart_product_id ?>][mprices][product_price][]"
									size="10"
									value="<?php echo $child->allPrices[$child->selectedPrice]['product_price'] ?>"/><input
									type="hidden"
									name="childs[<?php echo $child->virtuemart_product_id ?>][mprices][virtuemart_product_price_id][]"
									value="<?php echo $child->allPrices[$child->selectedPrice]['virtuemart_product_price_id'] ?>">
						</td>
						<td><?php echo $child->product_in_stock ?></td>
						<td><?php echo $child->product_ordered ?></td>
						<?php foreach ($customs as $custom) {
							$attrib = $custom->customfield_value;

							if (property_exists($child, $attrib)) {
								$childAttrib = $child->{$attrib};
							} else {
								vmdebug('unset? use Fallback product_name instead $attrib ' . $attrib, $child);
								$childAttrib = '';//$child->product_name;
							}
							$disabled = '';
							$id = '';
							if ($attrib == 'product_name') {
								$disabled = 'disabled="disabled"';
								$id = ' id="child' . $child->virtuemart_product_id . 'product_name1"';
							}
							//vmdebug(' $attrib '.$attrib,$child,$childAttrib);
							?>
							<td>
								<input type="text" class="inputbox"
										name="childs[<?php echo $child->virtuemart_product_id ?>][<?php echo $attrib ?>]"
										size="20" value="<?php echo $childAttrib ?>" <?php echo $disabled . $id ?>/>
							</td>
							<?php
						}
						?>
						<td>
							<input type="text" class="inputbox uk-form-width-xsmall"
									name="childs[<?php echo $child->virtuemart_product_id ?>][pordering]" size="2"
									value="<?php echo $child->pordering ?>"/></td>
						</td>
						<td>
							<?php echo VmHTML::checkbox('childs[' . $child->virtuemart_product_id . '][published]', $child->published) ?>
						</td>
					</tr>
				<?php } ?>
			</table>
		<?php } ?>
	</div>

</div>