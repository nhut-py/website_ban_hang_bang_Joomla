<?php

/**
 *
 * @package VirtueMart
 * @subpackage Sublayouts
 * @author Eugen Stranz, Max Milbers
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
defined ( '_JEXEC' ) or die ();


/** @var TYPE_NAME $viewData */

$VmMediaHandler = $viewData['VmMediaHandler'];
$image = $viewData['image'];
$key = $viewData['key'];
$image->file_root = JURI::root(true) . '/';
$image->msg = 'OK';
$file_url_thumb = $image->getFileUrlThumb();

$media_path = VMPATH_ROOT . DS . str_replace('/', DS, $image->file_url_thumb);
if ((empty($image->file_url_thumb) || !file_exists($media_path)) && is_a($image, 'VmImage')) {
	$file_url_thumb = $image->createThumb();
}

?>
<!-- keep vm_thumb_image because of js -->
<div class="vmuikit-js-thumb-image vmuikit-thumb_image">
	<div class="uk-card uk-card-small uk-card-vm " id="card-media-image-<?php echo $image->virtuemart_media_id ?>">
		<div class="uk-card-header">
			<div class="uk-grid uk-grid-small uk-grid-divider uk-flex uk-flex-right" uk-grid>
				<div class="uk-width-auto uk-text-right">
					<a uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_IMAGE_VIEW') ?>"
							href="#modal-media-image-<?php echo $image->virtuemart_media_id ?>" uk-toggle
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
				<!-- keep 4remove because of js -->
				<div class="uk-width-auto uk-text-right">
					<div class="uk-link vmuikit-js-remove"
							uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_IMAGE_REMOVE') ?>">
						<span class="" uk-icon="icon: trash; ratio: 1"></span>
					</div>
				</div>
				<input type="hidden" value="<?php echo $image->virtuemart_media_id ?>" name="virtuemart_media_id[]">
				<input class="ordering" type="hidden" name="mediaordering[<?php echo $image->virtuemart_media_id ?>]"
						value="<?php echo $key ?>">

			</div>
		</div>
		<div class="uk-card-media">
			<div class="uk-inline-clip  uk-flex uk-flex-center uk-flex-middle">
				<?php if ($file_url_thumb) {
					?>
					<!-- done above
					<input type="hidden" value="<?php echo $image->virtuemart_media_id ?>" name="virtuemart_media_id[]">
					<input type="hidden" value="<?php echo $key ?>" name="mediaordering[<?php echo $image->virtuemart_media_id ?>]" class="ordering">
					-->
					<a class="" href="#modal-media-image-<?php echo $image->virtuemart_media_id ?>" uk-toggle>
						<img src="<?php echo JURI::root(true) . '/' . $file_url_thumb; ?>"
								alt="<?php echo $image->file_title ?>"/>
					</a>
					<div id="modal-media-image-<?php echo $image->virtuemart_media_id ?>" class="uk-flex-top" uk-modal>
						<div class="uk-modal-dialog uk-width-auto uk-margin-auto-vertical">
							<button class="uk-modal-close-outside" type="button" uk-close></button>
							<img src="<?php echo JURI::root(true) . '/' . $image->file_url; ?>"
									alt="<?php echo $image->file_title ?>"/>
						</div>
					</div>
					<?php
				} else {
					$fileTitle = empty($image->file_title) ? 'no  title' : $image->file_title;
					echo vmText::_('COM_VIRTUEMART_NO_IMAGE_SET') . ' ' . $fileTitle;
				}
				?>
			</div>

		</div>
		<div class="uk-padding-small">
			<h6 class="uk-margin-small-bottom uk-margin-remove-adjacent uk-text-bold"><?php echo $image->file_title ?></h6>
			<p class="uk-text-small"><?php echo $image->file_description ?></p>
			<p class="uk-text-small uk-text-muted"><?php echo $image->file_meta ?></p>
		</div>

	</div>
</div>




