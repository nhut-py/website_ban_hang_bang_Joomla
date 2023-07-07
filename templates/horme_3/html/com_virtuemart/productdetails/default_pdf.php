<?php
/**
 *
 * Show the product details page
 *
 * @package	VirtueMart
 * @subpackage
 * @author Max Milbers, Eugen Stranz
 * @author RolandD,
 * @todo handle child products
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default.php 3605 2011-07-04 10:23:23Z Milbo $
 */

// Check to ensure this file is included in Joomla!
defined ( '_JEXEC' ) or die ( 'Restricted access' );

// addon for joomla modal Box
			if (isset($this->type)) {
			$document = JFactory::getDocument();
			$document->setTitle($this->product->product_name);
			$document->setName($this->product->product_name);
			$document->setDescription( $this->product->product_s_desc);
			}


/* Let's see if we found the product */
if (empty ( $this->product )) {
	echo vmText::_ ( 'COM_VIRTUEMART_PRODUCT_NOT_FOUND' );
	echo '<br /><br />  ' . $this->continue_link_html;
	return;
}

?>
<table width="100%">
	<tr>
	  <td>
			<?php // Showing The Additional Images
			if(!empty($this->product->images) && count($this->product->images)>0) {	?>
			<table width="100%" align="center">
				<tr>
					<td><?php	echo $this->product->images[0]->displayMediaFull('',false,false,false); ?></td>
				</tr>
				<tr><td></td></tr>
				<tr>
				  <td>
						<table width="100%" align="center">
							<tr>
							<?php // List all Images
							foreach ($this->product->images as $image) {
								echo '<td>' . $image->displayMediaThumb('',false) . '</td>';
							} ?>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<?php } ?>
	  </td>
		<td>
      <table width="100%" align="left">
				<?php
				// Show Rating
				if (VmConfig::get('showRatingFor') == 'all') {
				?>
      	<tr>
	        <td align="center">
	        <?php
					if ( !empty($this->product->rating) ) {
						echo vmText::_('COM_VIRTUEMART_RATING') . $this->product->rating;
          } else {
            echo vmText::_('COM_VIRTUEMART_UNRATED');
          }
					?>
					</td>
				</tr>
        <?php } ?>
				<?php
				// Product Price
				if ($this->show_prices) {
				?>
        <tr><td></td></tr>
				<?php if (VmConfig::get('salesPrice')) { ?>
				<tr>
					<td>
						<strong><?php	echo $this->currency->createPriceDiv ( 'salesPrice', 'COM_VIRTUEMART_PRODUCT_SALESPRICE', $this->product->prices );	?></strong>
					</td>
				</tr>
				<?php } ?>
				<?php if (VmConfig::get('basePriceWithTax') && $this->product->prices['discountAmount'] != -0) { ?>
				<tr>
					<td><del><?php	echo vmText::_('COM_VIRTUEMART_PRODUCT_BASEPRICE_WITHTAX') . ' ' . $this->currency->createPriceDiv ( 'basePriceWithTax', '', $this->product->prices , TRUE); ?></del></td>
				</tr>
        <?php } ?>
				<?php if (VmConfig::get('discountedPriceWithoutTax')) { ?>
				<tr>
					<td><?php	echo $this->currency->createPriceDiv ( 'discountedPriceWithoutTax', 'COM_VIRTUEMART_PRODUCT_DISCOUNTED_PRICE', $this->product->prices ); ?></td>
				</tr>
				<?php } ?>
				<?php if (VmConfig::get('salesPriceWithDiscount')) { ?>
				<tr>
				<td><?php	echo $this->currency->createPriceDiv ( 'salesPriceWithDiscount', 'COM_VIRTUEMART_PRODUCT_SALESPRICE_WITH_DISCOUNT', $this->product->prices ); ?></td>
				</tr>
				<?php } ?>
				<?php if (VmConfig::get('priceWithoutTax')) { ?>
				<tr>
					<td><?php	echo $this->currency->createPriceDiv ( 'priceWithoutTax', 'COM_VIRTUEMART_PRODUCT_SALESPRICE_WITHOUT_TAX', $this->product->prices); ?></td>
				</tr>
				<?php } ?>
        <?php if ($this->product->prices['discountAmount'] != -0) { ?>
				<tr>
					<td><?php	echo $this->currency->createPriceDiv ( 'discountAmount', 'COM_VIRTUEMART_PRODUCT_DISCOUNT_AMOUNT', $this->product->prices ); ?></td>
        </tr>
        <?php } ?>
				<?php if (VmConfig::get('taxAmount')) { ?>
				<tr>
        <td><?php	echo $this->currency->createPriceDiv ( 'taxAmount', 'COM_VIRTUEMART_PRODUCT_TAX_AMOUNT', $this->product->prices);	?></td>
				</tr>
				<?php } ?>

				<?php } ?>
				<tr><td></td></tr>
				<?php // Product Short Description
				if (!empty($this->product->product_s_desc)) { ?>
				<tr>
	        <td>
						<table bgcolor="#DDDDDD" cellpadding="20">
							<tr>
								<td>
									<?php echo $this->product->product_s_desc; ?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<?php } ?>
				<?php // Availability Image
				if (!empty($this->product->product_availability)) { ?>
				<tr>
					<td>
						<table width="100%" align="center" cellpadding="20">
						<tr>
							<td>
								<img src="<?php echo JURI::root().VmConfig::get('assets_general_path').'images/availability/'.$this->product->product_availability?>" width="200"/>
	            </td>
						</tr>
	          </table>
					</td>
				</tr>
				<?php } ?>
      </table>
		</td>
	</tr>
	<tr><td colspan="2"></td></tr>
	<tr><td colspan="2"></td></tr>
	<tr>
		<td colspan="2">
		<?php // Product Description
		if (!empty($this->product->product_desc)) { ?>
			<h2 class="title"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_DESC_TITLE') ?></h2>
			<?php echo $this->product->product_desc; ?>
		<?php } ?>
	  </td>
	</tr>
</table>