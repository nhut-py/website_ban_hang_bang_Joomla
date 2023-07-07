<?php
/**
 *
 * Modify user form view, User info
 *
 * @package    VirtueMart
 * @subpackage User
 * @author Oscar van Eijk
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: edit_vendorletter.php 10438 2021-01-22 07:18:16Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

if (!vmAccess::manager('user.editshop')) {
	?>
	<div><?php echo vmText::_('COM_VM_PERM_MISSING_VENDOR'); ?></div> <?php
}
?>

<div class="alert alert-info">
	<div>
		<?php echo vmText::_('COM_VIRTUEMART_VENDORLETTER_DESC'); ?>
	</div>
</div>
<div class=" uk-child-width-1-2@m" uk-grid>
	<div>

		<div class="uk-card   uk-card-small uk-card-vm">
			<div class="uk-card-header">
				<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: file; ratio: 1.2"></span>
					<?php echo vmText::_('COM_VIRTUEMART_VENDOR_LETTER_PAGE'); ?>
				</div>
			</div>
			<div class="uk-card-body">
				<?php echo VmuikitHtml::row('select', 'COM_VIRTUEMART_VENDOR_LETTER_FORMAT',
					'vendor_letter_format', array('A4' => vmText::_('COM_VIRTUEMART_VENDOR_LETTER_A4'), 'Letter' => vmText::_('COM_VIRTUEMART_VENDOR_LETTER_LETTER')),
					$default = $this->vendor->vendor_letter_format, $attrib = '', 'value', 'text',
					$zero = false); ?>
				<?php echo VmuikitHtml::row('select', 'COM_VIRTUEMART_VENDOR_LETTER_ORIENTATION',
					'vendor_letter_orientation', array('P' => vmText::_('COM_VIRTUEMART_VENDOR_LETTER_ORIENTATION_PORTRAIT'), 'L' => vmText::_('COM_VIRTUEMART_VENDOR_LETTER_ORIENTATION_LANDSCAPE')),
					$default = $this->vendor->vendor_letter_orientation, $attrib = '', 'value', 'text',
					$zero = false); ?>

				<table>
					<thead>
					<columns>
						<col width="33%">
						<col width="17%">
						<col width="17%">
						<col width="33%">
					</columns>
					</thead>
					<tbody>
					<tr>
						<td colspan=2 align="center">
							<div>
													<span class="key">
														<label class="hasTooltip" for="vendor_letter_margin_top"
																id="vendor_letter_margin_top-lbl"><?php echo vmText::_('COM_VIRTUEMART_VENDOR_LETTER_MARGIN_TOP'); ?></label>:
													</span><br/>
								<span style="whitespace:nowrap"><input type="text" size="3" class="text_area"
											value="<?php echo $this->vendor->vendor_letter_margin_top; ?>"
											id="vendor_letter_margin_top" name="vendor_letter_margin_top">mm</span>
							</div>
						</td>
						<td colspan=2 align="center">
							<div>
													<span class="key">
														<label class="hasTooltip" for="vendor_letter_margin_header"
																id="vendor_letter_margin_header-lbl"><?php echo vmText::_('COM_VIRTUEMART_VENDOR_LETTER_MARGIN_HEADER'); ?></label>:
													</span> <br/>
								<span style="whitespace:nowrap"><input type="text" size="3" class="text_area"
											value="<?php echo $this->vendor->vendor_letter_margin_header; ?>"
											id="vendor_letter_margin_header"
											name="vendor_letter_margin_header">mm</span>
							</div>
						</td>
					</tr>
					<tr>
						<td align="center">
							<div>
							<span class="key"><label class="hasTooltip" for="vendor_letter_margin_left"
										id="vendor_letter_margin_left-lbl"><?php echo vmText::_('COM_VIRTUEMART_VENDOR_LETTER_MARGIN_LEFT'); ?></label>:</span>
								<br/>
								<span style="whitespace:nowrap"><input type="text" size="3" class="text_area"
											value="<?php echo $this->vendor->vendor_letter_margin_left; ?>"
											id="vendor_letter_margin_left" name="vendor_letter_margin_left">mm</span>
							</div>
						</td>
						<td align="center" colspan=2><img alt=""
									src="components/com_virtuemart/assets/images/margins-page.png"></td>
						<td align="center" style="height: 50%">
							<div>
							<span class="key"><label class="hasTooltip" for="vendor_letter_margin_right"
										id="vendor_letter_margin_right-lbl"><?php echo vmText::_('COM_VIRTUEMART_VENDOR_LETTER_MARGIN_RIGHT'); ?></label>:</span>
								<br/>
								<span style="whitespace:nowrap"><input type="text" size="3" class="text_area"
											value="<?php echo $this->vendor->vendor_letter_margin_right; ?>"
											id="vendor_letter_margin_right" name="vendor_letter_margin_right">mm</span>
							</div>
						</td>
					</tr>
					<tr>
						<td align="center" colspan=2>
							<div>
							<span class="editlinktip"><label class="hasTooltip" for="vendor_letter_margin_bottom"
										id="vendor_letter_margin_bottom-lbl"><?php echo vmText::_('COM_VIRTUEMART_VENDOR_LETTER_MARGIN_BOTTOM'); ?></label>:</span>
								<br/>
								<span style="whitespace:nowrap"><input type="text" size="3" class="text_area"
											value="<?php echo $this->vendor->vendor_letter_margin_bottom; ?>"
											id="vendor_letter_margin_bottom"
											name="vendor_letter_margin_bottom">mm</span>
							</div>
						</td>
						<td align="center" colspan=2>
							<div>
							<span class="editlinktip"><label class="hasTooltip" for="vendor_letter_margin_footer"
										id="vendor_letter_margin_footer-lbl"><?php echo vmText::_('COM_VIRTUEMART_VENDOR_LETTER_MARGIN_FOOTER'); ?></label>:</span>
								<br/>
								<span style="whitespace:nowrap"><input type="text" size="3" class="text_area"
											value="<?php echo $this->vendor->vendor_letter_margin_footer; ?>"
											id="vendor_letter_margin_footer"
											name="vendor_letter_margin_footer">mm</span>
							</div>
						</td>
					</tr>
					</tbody>
				</table>

				<?php echo VmuikitHtml::row('checkbox', 'COM_VIRTUEMART_VENDOR_LETTER_ADD_TOS',
					'vendor_letter_add_tos', $this->vendor->vendor_letter_add_tos); ?>
				<?php echo VmuikitHtml::row('checkbox', 'COM_VIRTUEMART_VENDOR_LETTER_ADD_TOS_PAGEBREAK',
					'vendor_letter_add_tos_newpage', $default = $this->vendor->vendor_letter_add_tos_newpage); ?>
				<?php echo VmuikitHtml::row('checkbox', 'COM_VIRTUEMART_VENDOR_LETTER_FOR_PRODUCT_PDF',
					'vendor_letter_for_product_pdf', $default = $this->vendor->vendor_letter_for_product_pdf); ?>


			</div>
		</div>
	</div>
	<div>

		<div class="uk-card   uk-card-small uk-card-vm">
			<div class="uk-card-header">
				<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: file; ratio: 1.2"></span>
					<?php echo vmText::_('COM_VIRTUEMART_VENDOR_LETTER_FONTS'); ?>
				</div>
			</div>
			<div class="uk-card-body">
				<?php
				echo VmuikitHtml::row('genericlist', 'COM_VIRTUEMART_VENDOR_LETTER_FONT', $this->pdfFonts, 'vendor_letter_font', '', 'value', 'text', $this->vendor->vendor_letter_font);
				echo VmuikitHtml::row('input', 'COM_VIRTUEMART_VENDOR_LETTER_FONT_SIZE', 'vendor_letter_font_size', $this->vendor->vendor_letter_font_size) . ' pt';
				echo VmuikitHtml::row('input', 'COM_VIRTUEMART_VENDOR_LETTER_FONT_SIZE_HEADER', 'vendor_letter_header_font_size', $this->vendor->vendor_letter_header_font_size) . ' pt';
				echo VmuikitHtml::row('input', 'COM_VIRTUEMART_VENDOR_LETTER_FONT_SIZE_FOOTER', 'vendor_letter_footer_font_size', $this->vendor->vendor_letter_footer_font_size) . ' pt';
				echo VmuikitHtml::row('textarea', 'COM_VIRTUEMART_VENDOR_LETTER_CSS', 'vendor_letter_css', $this->vendor->vendor_letter_css,'class="uk-textarea"');

				?>


			</div>
		</div>
	</div>
</div>
<div class="uk-child-width-1-1" uk-grid>

	<div>
		<div class="uk-card   uk-card-small uk-card-vm">
			<div class="uk-card-header">
				<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: file; ratio: 1.2"></span>
					<?php echo vmText::_('COM_VIRTUEMART_VENDOR_LETTER_HEAD'); ?>
				</div>
			</div>
			<div class="uk-card-body">
				<div class="uk-child-width-1-2@m uk-text-center" uk-grid>
					<div>
						<div class="">
							<?php
							echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_VENDOR_LETTER_HEADER', 'vendor_letter_header', $this->vendor->vendor_letter_header);
							echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_VENDOR_LETTER_HEADER_LINE', 'vendor_letter_header_line', $this->vendor->vendor_letter_header_line);
							echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_VENDOR_LETTER_HEADER_IMAGE', 'vendor_letter_header_image', $this->vendor->vendor_letter_header_image);
							?>
						</div>
					</div>
					<div>
						<div class="">
							<?php
							echo VmuikitHtml::row('input', 'COM_VIRTUEMART_VENDOR_LETTER_HEADER_CELL_RATIO', 'vendor_letter_footer_cell_height_ratio', $this->vendor->vendor_letter_footer_cell_height_ratio);
							echo VmuikitHtml::row('color', 'COM_VIRTUEMART_VENDOR_LETTER_HEADER_LINE_COLOR', 'vendor_letter_header_line_color', $this->vendor->vendor_letter_header_line_color);
							echo VmuikitHtml::row('input', 'COM_VIRTUEMART_VENDOR_LETTER_HEADER_IMAGESIZE', 'vendor_letter_header_imagesize', $this->vendor->vendor_letter_header_imagesize);
							?>
						</div>
					</div>
					<div class="uk-width-1-1">
						<div>
							<div class="alert alert-info">
								<div>
									<?php echo vmText::_('COM_VIRTUEMART_VENDOR_LETTER_REPLACEMENTS_DESC'); ?>
								</div>
							</div>
							<?php echo $this->editor->display('vendor_letter_header_html', $this->vendor->vendor_letter_header_html, '100%', 200, 70, 15) ?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div>
		<div class="uk-card   uk-card-small uk-card-vm">
			<div class="uk-card-header">
				<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: file; ratio: 1.2"></span>
					<?php echo vmText::_('COM_VIRTUEMART_VENDOR_LETTER_FOOT'); ?>
				</div>
			</div>
			<div class="uk-card-body">
				<div class="uk-child-width-1-2@m uk-text-center" uk-grid>
					<div>
						<div class="">
							<?php
							echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_VENDOR_LETTER_FOOTER', 'vendor_letter_footer', $this->vendor->vendor_letter_footer);
							echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_VENDOR_LETTER_FOOTER_LINE_COLOR', 'vendor_letter_footer_line', $this->vendor->vendor_letter_footer_line);
							?>
						</div>
					</div>
					<div>
						<div class="">
							<?php
							echo VmuikitHtml::row('input', 'COM_VIRTUEMART_VENDOR_LETTER_FOOTER_CELL_RATIO', 'vendor_letter_footer_cell_height_ratio', $this->vendor->vendor_letter_footer_cell_height_ratio);
							echo VmuikitHtml::row('color', 'COM_VIRTUEMART_VENDOR_LETTER_FOOTER_LINE_COLOR', 'vendor_letter_footer_line_color', $this->vendor->vendor_letter_footer_line_color);
							?>
						</div>
					</div>
					<div class="uk-width-1-1">
						<div>
							<div class="alert alert-info">
								<div>
									<?php echo vmText::_('COM_VIRTUEMART_VENDOR_LETTER_REPLACEMENTS_DESC'); ?>
								</div>
							</div>
							<?php echo $this->editor->display('vendor_letter_footer_html', $this->vendor->vendor_letter_footer_html, '100%', 200, 70, 15) ?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


