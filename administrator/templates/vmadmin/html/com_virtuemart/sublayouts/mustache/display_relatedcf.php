<?php
/**
 *
 * @package VirtueMart
 * @subpackage Mustache template
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * @version $Id: display_relatedcf.php 10396 2021-01-11 11:35:30Z alatak $
 *
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

?>
	{{#relatedDatas}}
	<div class="vmuikit-js-relatedcf vmuikit-relatedcf">
		<div class="uk-card uk-card-small uk-card-vm " >
			<div class="uk-card-header">
				<div class="uk-grid uk-grid-small uk-grid-divider uk-flex uk-flex-right" uk-grid>
					<?php // Click here to disable the derived customfield for this child product ?>
					{{#disableDerivedCheckbox }}
					<div class="uk-width-auto uk-text-right">
						<label class="uk-link" uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_CUSTOMFLD_DIS_DER_TIP') ?>">
							<span class="" uk-icon="icon: disable; ratio: 1"></span>
							{{{disableDerivedCheckbox}}}
						</label>
					</div>
					{{/disableDerivedCheckbox }}


					<?php // Click here to prevent inhereting of this customfield to the childproduct ?>
					{{#nonInheritableCheckbox }}
					<div class="uk-width-auto uk-text-right">
						<label class="uk-link" uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_CUSTOMFLD_DIS_INH_TIP') ?>">
							<span class="" uk-icon="icon: lock; ratio: 1"></span>
							{{{nonInheritableCheckbox}}}
						</label>
					</div>
					{{/nonInheritableCheckbox }}


					<div class="uk-width-auto uk-text-right">
						<a uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_RELATEDCF_SORTABLE') ?>" href="#"
								class="uk-sortable-handle">
							<span class="" uk-icon="icon: move; ratio: 1"></span>
						</a>
					</div>

					<div class="uk-width-auto uk-text-right">
						<div class="uk-link vmuikit-js-remove"
								uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_RELATEDCF_REMOVE') ?>">
							<span class="" uk-icon="icon: trash; ratio: 1"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="uk-card-body">

					{{#displayHTML }}
					{{{displayHTML}}}
					{{/displayHTML }}

					{{#hiddenHTML }}
					{{{hiddenHTML}}}
					{{/hiddenHTML }}
			</div>

		</div>
	</div>
	{{/relatedDatas}}







