<?php
/**
 *
 *
 * @package    VirtueMart
 * @subpackage Manufacturer
 * @author Patrick Kohl
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: edit_description.php 10396 2021-01-11 11:35:30Z alatak $
 */


// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

?>
<div class="uk-grid-match uk-grid-small uk-child-width-1-1" uk-grid>
	<div>
		<div class="uk-card   uk-card-small uk-card-vm ">
			<div class="uk-card-header">
				<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: manufacturer; ratio: 1.2"></span>
					<?php echo vmText::_('COM_VIRTUEMART_DESCRIPTION') ?>
				</div>
			</div>
			<div class="uk-card-body">
				<?php //echo VmHTML::row('input','COM_VIRTUEMART_MANUFACTURER_NAME','mf_name',$this->manufacturer->mf_name,'class="required"'); ?>
				<?php echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_MANUFACTURER_NAME', VmHtml::input('mf_name', $this->manufacturer->mf_name, 'class="required inputbox"') . $this->origLang); ?>
				<?php echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_PUBLISHED', 'published', $this->manufacturer->published); ?>
				<?php echo VmuikitHtml::row('input', $this->viewName . ' ' . vmText::_('COM_VIRTUEMART_SLUG'), 'slug', $this->manufacturer->slug); ?>
				<?php echo VmuikitHtml::row('select', 'COM_VIRTUEMART_MANUFACTURER_CATEGORY_NAME', 'virtuemart_manufacturercategories_id', $this->manufacturerCategories, $this->manufacturer->virtuemart_manufacturercategories_id, 'style="width:200px;"', 'virtuemart_manufacturercategories_id', 'mf_category_name', false); ?>
				<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_MANUFACTURER_URL', 'mf_url', $this->manufacturer->mf_url); ?>
				<?php echo VmuikitHtml::row('input', 'COM_VIRTUEMART_MANUFACTURER_EMAIL', 'mf_email', $this->manufacturer->mf_email); ?>
				<?php echo VmuikitHtml::row('editor', 'COM_VIRTUEMART_MANUFACTURER_DESCRIPTION', 'mf_desc', $this->manufacturer->mf_desc); ?>
			</div>
		</div>
	</div>
	<div>
		<?php

		echo adminSublayouts::renderAdminVmSubLayout('metaedit',
			array(
				'obj' => $this->manufacturer,
			)
		);

		?>
	</div>
</div>