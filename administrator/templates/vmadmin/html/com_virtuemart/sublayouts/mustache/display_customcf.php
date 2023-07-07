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
 * @version $Id: display_customcf.php 10421 2021-01-13 17:36:50Z alatak $
 *
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

?>
{{#customcfs}}
<div class="vmuikit-js-customcf vmuikit-customcf">
	<div class="uk-card uk-card-small uk-card-vm ">
		<div class="uk-card-header uk-padding-remove">

			<div class="uk-navbar-container" uk-navbar>
				<div class="uk-navbar-left">
					<div class="uk-navbar-item">
						<h6 class="uk-margin-small-bottom uk-margin-remove-adjacent uk-text-bold">{{title}}</h6>
					</div>
					<div class="uk-navbar-item">
						<div class="uk-text-meta">{{type}}</div>
					</div>
					{{#is_cart_attribute}}
					<div class="uk-navbar-item">
						<div class="uk-icon-button md-bg-grey-200"
								uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_CUSTOM_IS_CART_ATTRIBUTE') ?>"
						>
							<span uk-icon="icon: cart; ratio: 0.75"></span>
						</div>
					</div>
					{{/is_cart_attribute}}
					{{#searchable}}
					<div class="uk-navbar-item">
						<div class="uk-icon-button md-bg-grey-200"
								uk-tooltip="<?php echo vmText::_('COM_VM_CUSTOM_IS_SEARCHABLE') ?>"
						>
							<span uk-icon="icon: search; ratio: 0.75"></span>
						</div>
					</div>
					{{/searchable}}
					{{#layout_pos}}
					<div class="uk-navbar-item">
						<div class="md-bg-grey-200"
								uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_CUSTOM_LAYOUT_POS') ?>"
						>
							<span class="uk-label md-bg-grey-200 md-color-grey-600" >{{layout_pos}}</span>
						</div>
					</div>
					{{/layout_pos}}
				</div>

				<div class="uk-navbar-right">
					<?php // Click here to disable the derived customfield for this child product ?>
					{{#overrideCheckbox }}
					<div class="uk-navbar-item">
						<label class="uk-link"
								uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_CUSTOMFLD_DIS_DER_TIP') ?>">
							<span class="" uk-icon="icon: disable; ratio: 0.75"></span>
							{{{overrideCheckbox}}}
						</label>
					</div>
					{{/overrideCheckbox }}
					{{#canMove}}
					<div class="uk-navbar-item">
						<a uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_CUSTOMFIELD_SORTABLE') ?>" href="#"
								class="uk-sortable-handle">
							<span class="" uk-icon="icon: move; ratio: 0.75"></span>
						</a>
					</div>
					{{/canMove}}
					{{#canRemove}}
					<div class="uk-navbar-item">
						<div class="uk-link vmuikit-js-remove"
								uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_CUSTOMFIELD_REMOVE') ?>">
							<span class="" uk-icon="icon: trash; ratio: 0.75"></span>
						</div>
					</div>
					{{/canRemove}}
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
{{/customcfs}}







