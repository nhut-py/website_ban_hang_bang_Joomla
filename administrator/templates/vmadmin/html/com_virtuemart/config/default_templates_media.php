<?php
/**
 *
 * Description
 *
 * @package    VirtueMart
 * @subpackage Config
 * @author Max Milbers
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_templates_media.php 10424 2021-01-14 09:24:33Z alatak $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$params = VmConfig::loadConfig();

?>
<?php
$type = 'checkbox';

?>

<div class="uk-card uk-card-small uk-card-vm">
	<div class="uk-card-header">
		<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: image; ratio: 1.2"></span>
			<?php echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_MEDIA_TITLE'); ?>
		</div>
	</div>
	<div class="uk-card-body">
		<?php
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_CFG_ADDITIONAL_IMAGES', 'add_img_main', VmConfig::get('add_img_main'));
		if (function_exists('imagecreatefromjpeg')) {
			echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_ADMIN_CFG_DYNAMIC_THUMBNAIL_RESIZING', 'img_resize_enable', VmConfig::get('img_resize_enable', 1));
			echo VmuikitHtml::row('input', 'COM_VM_CFG_MEDIA_WIDTH', 'img_width_full', VmConfig::get('img_width_full', ''), 'class="uk-form-width-xsmall"', "", 4);
			echo VmuikitHtml::row('input', 'COM_VM_CFG_MEDIA_HEIGHT', 'img_height_full', VmConfig::get('img_height_full', ''), 'class="uk-form-width-xsmall"', "", 4);
			echo VmuikitHtml::row('input', 'COM_VIRTUEMART_ADMIN_CFG_THUMBNAIL_WIDTH', 'img_width', VmConfig::get('img_width', ''), 'class="uk-form-width-xsmall"', "", 4);
			echo VmuikitHtml::row('input', 'COM_VIRTUEMART_ADMIN_CFG_THUMBNAIL_HEIGHT', 'img_height', VmConfig::get('img_height', 90), 'class="uk-form-width-xsmall"', "", 4);

		} else { ?>
			<strong><?php echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_GD_MISSING'); ?></strong>
			<input type="hidden" name="img_resize_enable" value="0"/>
		<?php }

		echo VmuikitHtml::row('genericlist', 'COM_VIRTUEMART_ADMIN_CFG_NOIMAGEPAGE', $this->noimagelist, 'no_image_set', 'style="min-width:120px"', 'value', 'text', VmConfig::get('no_image_set', 'noimage_new.gif'));
		echo VmuikitHtml::row('genericlist', 'COM_VIRTUEMART_ADMIN_CFG_NOIMAGEFOUND', $this->noimagelist, 'no_image_found', 'style="min-width:120px"', 'value', 'text', VmConfig::get('no_image_found'));

		echo VmuikitHtml::row('input', 'COM_VIRTUEMART_ADMIN_CFG_MEDIA_FORSALE_PATH', 'forSale_path', VmConfig::get('forSale_path', ''), 'class="uk-form-width-large"', '', 50, 260);
		echo VmuikitHtml::row('input', 'COM_VIRTUEMART_ADMIN_CFG_MEDIA_FORSALE_PATH_THUMB', 'forSale_path_thumb', VmConfig::get('forSale_path_thumb', ''), 'class="uk-form-width-large"', '', 50, 260);

		echo VmuikitHtml::row('input', 'COM_VIRTUEMART_ADMIN_CFG_ASSETS_GENERAL_PATH', 'assets_general_path', VmConfig::get('assets_general_path', ''), 'class="uk-form-width-large"', '', 50, 260);
		echo VmuikitHtml::row('input', 'COM_VIRTUEMART_ADMIN_CFG_MEDIA_CATEGORY_PATH', 'media_category_path', VmConfig::get('media_category_path', ''), 'class="uk-form-width-large"', '', 50, 260);
		echo VmuikitHtml::row('input', 'COM_VIRTUEMART_ADMIN_CFG_MEDIA_PRODUCT_PATH', 'media_product_path', VmConfig::get('media_product_path', ''), 'class="uk-form-width-large"', '', 50, 260);
		echo VmuikitHtml::row('input', 'COM_VIRTUEMART_ADMIN_CFG_MEDIA_MANUFACTURER_PATH', 'media_manufacturer_path', VmConfig::get('media_manufacturer_path', ''), 'class="uk-form-width-large"', '', 50, 260);
		echo VmuikitHtml::row('input', 'COM_VIRTUEMART_ADMIN_CFG_MEDIA_VENDOR_PATH', 'media_vendor_path', VmConfig::get('media_vendor_path', ''), 'class="uk-form-width-large"', '', 50, 260);

		?>
	</div>
</div>

