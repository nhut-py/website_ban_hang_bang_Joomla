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
 * @version $Id: displayimage.php 10396 2021-01-11 11:35:30Z alatak $
 *
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

?>
{{#images}}
<div class="vmuikit-js-thumb-image vmuikit-thumb_image">
	<div class="uk-card uk-card-small uk-card-vm " id="card-media-image-{{virtuemart_media_id}}">
		<div class="uk-card-header">
			<div class="uk-grid uk-grid-small uk-grid-divider uk-flex uk-flex-right" uk-grid>
				<div class="uk-width-auto uk-text-right">
					<a uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_IMAGE_VIEW') ?>"
							href="#modal-media-image-{{virtuemart_media_id}}" uk-toggle
							class="uk-icon-buttonx">
						<span class="" uk-icon="icon: expand; ratio: 1"></span>
					</a>
				</div>
				<div class="uk-width-auto uk-text-right">
					<div uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_IMAGE_EDIT_INFO') ?>"
							class="vmuikit-js-edit-image uk-link">
						<span class="" uk-icon="icon: pencil; ratio: 1"></span>
					</div>
				</div>
				<div class="uk-width-auto uk-text-right">
					<a uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_IMAGE_SORTABLE') ?>" href="#"
							class="uk-sortable-handle">
						<span class="" uk-icon="icon: move; ratio: 1"></span>
					</a>
				</div>
				<div class="uk-width-auto uk-text-right">
					<div class="uk-link vmuikit-js-remove"
							uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_IMAGE_REMOVE') ?>">
						<span class="" uk-icon="icon: trash; ratio: 1"></span>
					</div>
				</div>
				<input type="hidden" value="{{virtuemart_media_id}}" name="virtuemart_media_id[]">
				<input class="ordering" type="hidden" name="mediaordering[{{virtuemart_media_id}}]"
						value="{{ordering }}">
			</div>
		</div>
		<div class="uk-card-media">
			<div class="uk-inline-clip  uk-flex uk-flex-center uk-flex-middle">
				{{#file_url_thumb }}
				<a class="" href="#modal-media-image-{{virtuemart_media_id}}" uk-toggle>
					{{{file_url_thumb_img}}}
				</a>
				<div id="modal-media-image-{{virtuemart_media_id}}" class="uk-flex-top" uk-modal>
					<div class="uk-modal-dialog uk-width-auto uk-margin-auto-vertical">
						<button class="uk-modal-close-outside" type="button" uk-close></button>
						{{{file_url_img}}}
					</div>
				</div>
				{{/file_url_thumb }}
			</div>

		</div>
		<div class="uk-padding-small">
			<h6 class="uk-margin-small-bottom uk-margin-remove-adjacent uk-text-bold">{{file_title }}</h6>
			<p class="uk-text-small">{{file_description }}</p>
			<p class="uk-text-small uk-text-muted">{{file_meta }}</p>
		</div>

	</div>
</div>
{{/images}}







