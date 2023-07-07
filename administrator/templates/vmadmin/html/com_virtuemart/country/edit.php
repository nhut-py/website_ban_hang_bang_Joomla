<?php
/**
 *
 *
 * @package    VirtueMart
 * @subpackage Country
 * @author RickG
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: edit.php 10394 2021-01-11 11:28:45Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$adminTemplate = VMPATH_ROOT . '/administrator/templates/vmadmin/html/com_virtuemart/';
JLoader::register('vmuikitAdminUIHelper', $adminTemplate . 'helpers/vmuikit_adminuihelper.php');
vmuikitAdminUIHelper::startAdminArea($this);
vmuikitAdminUIHelper::imitateTabs('start', 'COM_VIRTUEMART_COUNTRY_DETAILS');
?>

	<div class="uk-card   uk-card-small uk-card-vm ">
		<div class="uk-card-header">
			<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: world; ratio: 1.2"></span>
				<?php echo vmText::_('COM_VIRTUEMART_COUNTRY_DETAILS') ?>
			</div>
		</div>
		<div class="uk-card-body">
			<div class="uk-grid-collapse" uk-grid>
				<form action="index.php" method="post" name="adminForm" id="adminForm" class="uk-form-horizontal">


					<?php
					$lang = vmLanguage::getLanguage();
					$prefix = "COM_VIRTUEMART_COUNTRY_";
					$country_string = $lang->hasKey($prefix . $this->country->country_3_code) ? ' (' . vmText::_($prefix . $this->country->country_3_code) . ')' : ' ';
					?>
					<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_COUNTRY_REFERENCE_NAME', 'country_name', $this->country->country_name, 'class="required"', '', 50, 50, $country_string); ?>

					<?php echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_PUBLISHED', 'published', $this->country->published); ?>
					<?php /* TODO not implemented		<tr>
			<td width="110" class="key">
				<label for="title">
					<?php echo vmText::_('COM_VIRTUEMART_WORLDZONE'); ?>:
				</label>
			</td>
			<td>
				<?php echo JHtml::_('Select.genericlist', $this->worldZones, 'virtuemart_worldzone_id', '', 'virtuemart_worldzone_id', 'zone_name', $this->country->virtuemart_worldzone_id); ?>
			</td>
		</tr>*/ ?>
					<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_COUNTRY_3_CODE', 'country_3_code', $this->country->country_3_code, 'class="required"'); ?>
					<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_COUNTRY_2_CODE', 'country_2_code', $this->country->country_2_code, 'class="required"'); ?>
					<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_ORDERING', 'ordering', $this->country->ordering, ''); ?>
					<input type="hidden" name="virtuemart_country_id"
							value="<?php echo $this->country->virtuemart_country_id; ?>"/>

					<?php echo $this->addStandardHiddenToForm(); ?>


				</form>
			</div>

		</div>

	</div>

<?php
vmuikitAdminUIHelper::imitateTabs('end');
vmuikitAdminUIHelper::endAdminArea(); ?>