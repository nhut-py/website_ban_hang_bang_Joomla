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
 * @version $Id: search_medias.php 10396 2021-01-11 11:35:30Z alatak $
 *
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

?>
<div id="search-media-template">
	<div class="uk-card-vmx">

		<div class="uk-card-small uk-card-body">

			<div class="vmuikit-js-thumb-image vmuikit-thumb_image">
				<div class="uk-dropdown-grid uk-grid-small uk-grid-match uk-child-width-auto" uk-grid>
					{{#images}}
					<div class="">
						<div class="uk-card uk-card-small uk-card-vm "
								id="card-media-image-{{ virtuemart_media_id }}">
							<a class="vmuikit-js-select-media" href="#"
									uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_IMAGE_SELECT') ?> {{ file_title }}"
									data-virtuemart-media-id="{{ virtuemart_media_id }}"
									data-file-url-thumb="{{ file_url_thumb}}"
									data-file-title="{{ file_title}}"
									data-file-description="{{ file_description }}"
									data-file-meta="{{ file_meta}}"
									data-file-url="{{ file_url}}"
									data-ordering="{{ ordering }}"
							>
								<div class="uk-card-media">
									<div class="uk-inline-clip  uk-flex uk-flex-center uk-flex-middle">
										{{#file_url_thumb_img }}
										{{{file_url_thumb_img }}}
										{{/file_url_thumb_img }}
									</div>

								</div>
								<div class="uk-card-footer">
									<h6 class="uk-margin-small-bottom uk-margin-remove-adjacent uk-text-bold">{{ file_title }}</h6>
									<p class="uk-text-small">{{ file_description }}</p>
									<p class="uk-text-small uk-text-muted">{{ file_meta }}</p>
								</div>
							</a>
						</div>
					</div>
					{{/images}}
				</div>

			</div>
		</div>
	</div>
</div>









