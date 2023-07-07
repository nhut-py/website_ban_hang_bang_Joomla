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
 * @version $Id: search_relatedcf.php 10396 2021-01-11 11:35:30Z alatak $
 *
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

?>
<div id="search-relatedcf-template">
	<div class="vmuikit-relatedcf">

		<div class="uk-card-small uk-card-body">

			<div class="vmuikit-js-thumb-image vmuikit-thumb_image">
				<div class="uk-dropdown-grid uk-grid-small uk-grid-match uk-child-width-1-2@s uk-child-width-1-4@m uk-child-width-1-6@l"
						uk-grid>
					{{#relatedDatas}}
					<div class="">
						<div class="vmuikit-js-cf-card uk-card uk-card-small uk-card-vm uk-padding-small">
							<div class="uk-card-header uk-text-center">
								<a class="vmuikit-js-relatedcf-select uk-button uk-button-small uk-button-primary"
										data-relatedcf="{{relatedcf}}"
										href="#"
										uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_RELATEDCF_SELECT') ?>"
								>
									<?php echo vmText::_('COM_VIRTUEMART_RELATEDCF_SELECT') ?>
								</a>

							</div>
							<div class="vmuikit-js-cf-card-body uk-card-body vmuikit-js-cf-selected">
								{{{hiddenHTML}}}
								{{{displayHTML}}}
							</div>

						</div>

					</div>
					{{/relatedDatas}}
				</div>

			</div>
		</div>
	</div>
</div>









