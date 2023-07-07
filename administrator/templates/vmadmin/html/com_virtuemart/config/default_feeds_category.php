<?php
/**
 *
 * Description
 *
 * @package    VirtueMart
 * @subpackage Config
 * @author RickG
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_feeds_category.php 10421 2021-01-13 17:36:50Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

?>

<div class="uk-card uk-card-small uk-card-vm">
	<div class="uk-card-header">
		<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: rss; ratio: 1.2"></span>
			<?php echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_CAT_FEED_SETTINGS'); ?>
		</div>
	</div>
	<div class="uk-card-body">
		<?php
		//echo VmuikitHtml::row('input','COM_VIRTUEMART_ADMIN_CFG_FEED_TITLE_CATEGORIES', 'feed_title_categories', VmConfig::get('feed_title_categories', 0));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_ADMIN_CFG_FEED_ENABLE', 'feed_cat_published', VmConfig::get('feed_cat_published', 0));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_ADMIN_CFG_FEED_SHOWIMAGES', 'feed_cat_show_images', VmConfig::get('feed_cat_show_images', 0));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_ADMIN_CFG_FEED_SHOWPRICES', 'feed_cat_show_prices', VmConfig::get('feed_cat_show_prices', 0));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_ADMIN_CFG_FEED_SHOWDESC', 'feed_cat_show_description', VmConfig::get('feed_cat_show_description', 0));

		$options = array();
		$options[] = JHtml::_('select.option', 'product_s_desc', vmText::_('COM_VIRTUEMART_PRODUCT_FORM_S_DESC'));
		$options[] = JHtml::_('select.option', 'product_desc', vmText::_('COM_VIRTUEMART_PRODUCT_FORM_DESCRIPTION'));
		echo VmuikitHtml::row('genericlist', 'COM_VIRTUEMART_ADMIN_CFG_FEED_DESCRIPTION_TYPE', $options, 'feed_cat_description_type', 'size=1', 'value', 'text', VmConfig::get('feed_cat_description_type', 0));
		echo VmuikitHtml::row('input', 'COM_VIRTUEMART_ADMIN_CFG_FEED_MAX_TEXT_LENGTH', 'feed_cat_max_text_length', VmConfig::get('feed_cat_max_text_length', '500'), 'class="uk-form-width-xsmall"', "", 4);
		?>
	</div>
</div>





 

