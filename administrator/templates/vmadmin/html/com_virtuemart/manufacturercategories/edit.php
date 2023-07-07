<?php
/**
 *
 *
 * @package    VirtueMart
 * @subpackage Manufacturer Category
 * @author Patrick Kohl
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: edit.php 10438 2021-01-22 07:18:16Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$adminTemplate = VMPATH_ROOT . '/administrator/templates/vmadmin/html/com_virtuemart/';
JLoader::register('vmuikitAdminUIHelper', $adminTemplate . 'helpers/vmuikit_adminuihelper.php');
vmuikitAdminUIHelper::startAdminArea($this);
vmuikitAdminUIHelper::imitateTabs('start', 'COM_VIRTUEMART_MANUFACTURER_CATEGORY_DETAILS');

?>
	<div class="uk-card   uk-card-small uk-card-vm ">
		<div class="uk-card-header">
			<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: category; ratio: 1.2"></span>
				<?php echo vmText::_('COM_VIRTUEMART_MANUFACTURER_CATEGORY_DETAILS') ?>
			</div>
		</div>
		<div class="uk-card-body">
			<form action="index.php" method="post" name="adminForm" id="adminForm" class="uk-form-horizontal">
				<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_MANUFACTURER_CATEGORY_NAME', 'mf_category_name', $this->manufacturerCategory->mf_category_name); ?>
				<?php echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_PUBLISHED', 'published', $this->manufacturerCategory->published); ?>
				<?php echo VmuikitHtml::row('textarea', 'COM_VIRTUEMART_MANUFACTURER_CATEGORY_DESCRIPTION', 'mf_category_desc', $this->manufacturerCategory->mf_category_desc,'class="uk-textarea"'); ?>


				<input type="hidden" name="virtuemart_manufacturercategories_id"
						value="<?php echo $this->manufacturerCategory->virtuemart_manufacturercategories_id; ?>"/>
				<?php echo $this->addStandardHiddenToForm(); ?>
			</form>
		</div>
	</div>
<?php
vmuikitAdminUIHelper::imitateTabs('end');
vmuikitAdminUIHelper::endAdminArea(); ?>


