<?php
/**
 *
 * Description
 *
 * @packageVirtueMart
 * @subpackage Config
 * @author RickG
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_shopfront_settings.php 10393 2021-01-11 11:23:39Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access'); ?>


<div class="uk-card uk-card-small uk-card-vm">
	<div class="uk-card-header">
		<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: cog; ratio: 1.2"></span>
			<?php echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_MORE_CORE_SETTINGS'); ?>
		</div>
	</div>
	<div class="uk-card-body">
		<?php
		echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_WEIGHT_UNIT_DEFAULT', ShopFunctions::renderWeightUnitList('weight_unit_default', VmConfig::get('weight_unit_default')));
		echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_LWH_UNIT_DEFAULT', ShopFunctions::renderLWHUnitList('lwh_unit_default', VmConfig::get('lwh_unit_default')));
		echo VmuikitHtml::row('input', 'COM_VM_PROVIDED_UNITS', 'norm_units', VmConfig::get('norm_units', 'KG,100G,M,SM,CUBM,L,100ML,P'));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_ADMIN_SHOW_PRINTICON', 'show_printicon', VmConfig::get('show_printicon', 1));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_PDF_ICON_SHOW', 'pdf_icon', VmConfig::get('pdf_icon', 0));
		?>
	</div>
</div>


