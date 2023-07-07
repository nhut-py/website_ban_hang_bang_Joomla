<?php
/**
 *
 * @package VirtueMart
 * @subpackage Sublayouts  build tabs end
 * @author Max Milbers, Valérie Isaksen
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * @version $Id: image_upload.php 10412 2021-01-12 09:17:50Z alatak $
 *
 */

// Check to ensure this file is included in Joomla!
defined ( '_JEXEC' ) or die ();


/** @var TYPE_NAME $viewData */

$VmMediaHandler = $viewData['VmMediaHandler'];
$supportedTypes = $VmMediaHandler->displaySupportedImageTypes();
$folders = $VmMediaHandler->displayFoldersWriteAble();
$VmMediaHandler->addMediaActionByType();
?>


<div class="vmuikit-image-upload-container uk-container uk-margin-top uk-margin-bottom"
		id="vmuikit-image-upload-container">

	<div id="vmuikit-error-alert-file-upload" class="uk-alert-danger uk-margin-top uk-hidden" uk-alert>
		<div class="vmuikit-error-messages-fileupload"></div>
	</div>
	<div class="uk-upload-box">

		<div class="vmuikit-js-upload uk-placeholder uk-text-center" id="vmuikit-js-upload">

			<div uk-form-custom>
				<input name="upload" accept="image/png, image/jpeg" type="file" id="vmuikit-js-upload-file">
				<span class="uk-button uk-button-small uk-button-primary vmuikit-js-upload-button"
						id="vmuikit-js-upload-button"><?php echo vmText::_('COM_VIRTUEMART_IMAGE_UPLOAD_SELECT') ?></span>
			</div>

			<div id="vmuikit-image-preview"
					class="uk-margin-top uk-child-width-1-1 uk-child-width-1-4@m uk-flex uk-flex-center uk-flex-middle uk-hidden"
					uk-scrollspy="cls: uk-animation-scale-up; target: .uk-card-vm; delay: 80">
				<div class="uk-card uk-card-small uk-card-vm " id="image-preview-card">

					<div class="uk-card-media">
						<div class="uk-inline-clip uk-padding-remove uk-flex uk-flex-center uk-flex-middle"
								id="image-preview-card-image">
							<!-- image -->
						</div>
						<div class="uk-padding-small uk-text-meta" id="image-preview-card-title">
							<!-- title -->
						</div>

					</div>
					<div class="uk-card-footer ">
						<div class="uk-text-bold uk-text-center uk-padding-small">
							<?php
							echo vmText::_('COM_VIRTUEMART_IMAGE_ACTION');
							?>
						</div>
						<div class="uk-text-left vmuikit-media-action">
							<?php
							echo JHtml::_('select.radiolist', VmuikitMediaHandler::getOptions($VmMediaHandler->_actions), 'media[media_action]', '', 'value', 'text', 0)
							?>
						</div>
						<!--
												<div class="uk-grid uk-grid-small uk-grid-divider uk-flex uk-flex-right" uk-grid="">

													<div class="uk-width-auto uk-text-right">
														<div class="uk-link vmuikit-js-remove" uk-tooltip="Remove Image">
															<span uk-icon="trash"></span>
														</div>
													</div>
													<div class="uk-width-auto uk-text-right">
														<div class="uk-link" uk-tooltip=" upload Image">
															<span class="uk-icon" uk-icon="icon: upload; ratio: 1"></span>
														</div>
													</div>
													<div class="uk-width-auto uk-text-right">
														<div class="uk-link" uk-tooltip="Replace Image"
																aria-expanded="false">
															<span class="uk-icon" uk-icon="icon: upload; ratio: 1"></span>
														</div>
													</div>
													<div class="uk-width-auto uk-text-right">
														<div class="uk-link vmuikit-js-remove" uk-tooltip="Replace Thumb" title=""
																aria-expanded="false">
															<span class="uk-icon" uk-icon="icon: upload; ratio: 1"></span>
														</div>
													</div>
												</div>
										-->
					</div>

				</div>

			</div>
		</div>


	</div>

</div>
<div class="uk-alert-primary" uk-alert>
	<div><?php echo $supportedTypes ?></div>
	<div><?php echo $folders ?></div>
</div>