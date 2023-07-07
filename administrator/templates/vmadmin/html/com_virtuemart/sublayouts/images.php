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
 * @version $Id: images.php 10418 2021-01-13 12:24:24Z alatak $
 *
 */
// Check to ensure this file is included in Joomla!
defined ( '_JEXEC' ) or die ();



/** @var TYPE_NAME $viewData */

$type = $viewData['type'];
$medias = $viewData['medias'];
$VmMediaHandler = $viewData['VmMediaHandler'];
$vendorId = $viewData['vendorId'];
$canSearch = $viewData['canSearch'];
$adminTemplatePath = '/administrator/templates/vmadmin/html/com_virtuemart/';
vmJsApi::addJScript($adminTemplatePath.'assets/js/mustache.js');

// TODO check if Already done ???
/*
$VmMediaHandler->addHiddenByType();
echo $VmMediaHandler->displayHidden();
*/
// manuf= media[active_media_id], option
//	$this->addHidden('media[active_media_id]',$this->virtuemart_media_id);
//		$this->addHidden('option','com_virtuemart');
?>
	<!-- MEDIA Hidden comes from mediaHandler->addHiddenByType-->
	<input type="hidden" name="media[active_media_id]" value="<?php $VmMediaHandler->virtuemart_media_id ?>"/>
	<input type="hidden" name="option" value="com_virtuemart"/>


<?php
if ($canSearch) {
	?>
	<!-- BOF COM_VIRTUEMART_IMAGE_SEARCH  -->
	<div class="vmuikit-js-images" uk-grid>
		<div class="uk-width-1-1">

			<div class="uk-card   uk-card-small uk-card-vm">
				<div class="uk-card-header">
					<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right" uk-icon="icon: image; ratio: 1.2"></span>
						<?php echo vmText::_('COM_VIRTUEMART_IMAGES'); ?>
					</div>
				</div>

				<div class="uk-card-body">
					<!-- BOF SEARCH MEDIA -->
					<div class="filter-bar search-media-boundary">

						<div class="uk-navbar-container uk-margin uk-navbar" uk-navbar="">
							<div class="uk-navbar-left">
								<div class="uk-navbar-item">
									<div class="uk-button-group vmuikit-filter-search ">
										<input type="text" name="searchMedia" id="vmuikit-js-search-media"
												data-start="0"
												placeholder="<?php echo vmText::_('COM_VIRTUEMART_SEARCH_MEDIA'); ?>"
												value="<?php echo vRequest::getString('searchMedia') ?>"
												class="vmuikit-filter-search-input vmuikit-js-search-media vmuikit-js-reset-input-value"/>

										<a class="vmuikit-js-pages vmuikit-js-next  uk-button uk-button-small uk-button-default"
												type="button">
											<span uk-icon="search"></span>
										</a>
										<button class="vmuikit-js-reset-value uk-button uk-button-small uk-button-default">
											<span uk-icon="close"></span></button>

									</div>
								</div>
								<div class="uk-navbar-item">
									<div class="uk-button-group ">
										<a href="#"
												class="vmuikit-js-pages vmuikit-js-previous ui-state-default uk-button uk-button-small uk-button-default"
												uk-tooltip="<?php echo vmText::_("COM_VIRTUEMART_PREVIOUS") ?>">
											<span uk-icon="icon: triangle-left"></span>

										</a>
										<a class="vmuikit-js-pages vmuikit-js-next ui-state-default uk-button uk-button-small uk-button-default"
												uk-tooltip="<?php echo vmText::_("COM_VIRTUEMART_NEXT") ?>">
											<span uk-icon="icon: triangle-right"></span>
										</a>
									</div>


								</div><!-- uk-navbar-left -->
							</div>


						</div>
					</div>
					<div class="search-media-result uk-dropdown" id="search-media-result"
							uk-dropdown="pos: bottom-justify; boundary: .search-media-boundary; boundary-align: true;mode:click;animation: uk-animation-slide-top-small; duration: 1000">

						<!-- insert search medias result here : done in the JS-->
						<div id="search-media-output"></div>
					</div>
					<!-- EOF SEARCH MEDIA -->


					<!-- BOF DISPLAY MEDIAS -->
					<div id="vmuikit-js-images-container"
							class="vmuikit-js-images-container uk-margin-medium-top uk-grid uk-grid-small uk-child-width-1-2@s uk-child-width-1-4@m uk-child-width-1-5@l  uk-child-width-1-6@xl uk-grid-match"
							uk-grid>


					</div>
					<!-- EOF DISPLAY MEDIAS -->

				</div>
			</div>

		</div>
	</div>
	<!-- EOF COM_VIRTUEMART_IMAGE_SEARCH  -->
	<?php
}
?>


	<!-- BOF COM_VIRTUEMART_IMAGE_INFORMATION  -->
	<div class="" uk-grid>
		<div class="uk-width-1-1">
			<div class="uk-card   uk-card-small uk-card-vm">
				<div class="uk-card-header">
					<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right" uk-icon="icon: image; ratio: 1.2"></span>
						<?php echo vmText::_('COM_VIRTUEMART_IMAGE_INFORMATION'); ?>
					</div>
				</div>
				<div class="uk-card-body">
					<div class="vm__img_autocrop">
						<?php $imageArgs = array('id' => 'vmuikit-js-display-info'); ?>
						<?php //echo $VmMediaHandler->displayMediaFull($imageArgs, false, '', false) ?>
					</div>
					<div class="uk-grid-match uk-grid-small " uk-grid>
						<div class="uk-width-2-3@l">
							<div>
								<?php
								if ($VmMediaHandler->published || $VmMediaHandler->virtuemart_media_id === 0) {
									$checked = 1;
								} else {
									$checked = 0;
								}
								echo VmuikitHtml::row('checkbox', 'COM_VIRTUEMART_FILES_FORM_FILE_PUBLISHED', 'media[media_published]', $checked);
								if (!vmAccess::manager('media')) {
									$readonly = 'readonly';
								} else {
									$readonly = '';
								}
								if ($VmMediaHandler->noImageSet) {
									$VmMediaHandler->file_url = '';
								}
								echo VmuikitHtml::mediaRow($VmMediaHandler, 'COM_VIRTUEMART_FILES_FORM_FILE_TITLE', 'file_title', 'class="inputbox input-xxlarge"', $VmMediaHandler->file_title);
								echo VmuikitHtml::mediaRow($VmMediaHandler, 'COM_VIRTUEMART_FILES_FORM_FILE_DESCRIPTION', 'file_description', 'class="inputbox input-xxlarge"', $VmMediaHandler->file_description);
								echo VmuikitHtml::mediaRow($VmMediaHandler, 'COM_VIRTUEMART_FILES_FORM_FILE_META', 'file_meta', 'class="inputbox input-xxlarge"', $VmMediaHandler->file_meta);
								echo VmuikitHtml::mediaRow($VmMediaHandler, 'COM_VIRTUEMART_FILES_FORM_FILE_CLASS', 'file_class', 'class="inputbox input-xxlarge"', $VmMediaHandler->file_class);
								echo VmuikitHtml::mediaRow($VmMediaHandler, 'COM_VIRTUEMART_FILES_FORM_FILE_URL', 'file_url', 'class="inputbox input-xxlarge"', $VmMediaHandler->file_url);


								$file_url_thumb = $VmMediaHandler->getFileUrlThumb();
								if (empty($VmMediaHandler->file_url_thumb) and is_a($VmMediaHandler, 'VmImage')) {
									$file_url_thumb = vmText::sprintf('COM_VIRTUEMART_DEFAULT_URL', $file_url_thumb);
									?>
									<div class="uk-clearfix">
										<label class="uk-form-label" for="file_url_thumb"
												id="file_url_thumb-lbl"
												uk-tooltip="<?php echo $file_url_thumb ?>"
										><?php echo vmText::_('COM_VIRTUEMART_FILES_FORM_FILE_URL_THUMB') ?></label>
										<div class="uk-form-controls">
											<input id="file_url_thumb" <?php echo $readonly ?> type="text"
													class="inputbox input-xxlarge" name="media[file_url_thumb]"
													value="">
											<span><?php echo vmText::sprintf('COM_VIRTUEMART_DEFAULT_URL', '') ?></span>
										</div>
									</div>
									<?php

								} else {
									echo VmuikitHtml::mediaRow($VmMediaHandler, 'COM_VIRTUEMART_FILES_FORM_FILE_URL_THUMB', 'file_url_thumb', $readonly, $file_url_thumb);
								}

								$VmMediaHandler->addMediaAttributesByType();

								?>
								<div class="uk-clearfix">
									<label class="uk-form-label">
										<?php echo vmText::_('COM_VIRTUEMART_FILES_FORM_ROLE') ?></label>
									<div class="uk-form-controls">
										<?php echo JHtml::_('select.radiolist', $VmMediaHandler->getOptions($VmMediaHandler->_mRoles), 'media[media_roles]', '', 'value', 'text', $VmMediaHandler->media_role); ?>
									</div>
								</div>

								<?php
								if (!empty($VmMediaHandler->file_type)) {
									?>
									<div class="uk-clearfix">
										<label class="uk-form-label">
											<?php echo vmText::_('COM_VIRTUEMART_FILES_FORM_LOCATION') ?></label>
										<div class="uk-form-controls">
											<input readonly type="text"
													value="<?php echo vmText::_('COM_VIRTUEMART_FORM_MEDIA_SET_' . strtoupper($VmMediaHandler->file_type)) ?>">
										</div>
									</div>
									<?php
								} else {
									$mediaattribTemp = $VmMediaHandler->media_attributes;
									if (empty($VmMediaHandler->media_attributes)) {
										$mediaattribTemp = 'product';
									}
									?>
									<div class="uk-clearfix">
										<label class="uk-form-label">
											<?php echo vmText::_('COM_VIRTUEMART_FILES_FORM_LOCATION') ?></label>
										<div class="uk-form-controls">
											<?php echo JHtml::_('select.radiolist', $VmMediaHandler->getOptions($VmMediaHandler->_mLocation), 'media[media_attributes]', '', 'value', 'text', $mediaattribTemp); ?>
										</div>
									</div>
									<?php
								}
								// select language for image
								$active_languages = VmConfig::get('active_languages', array(VmConfig::$jDefLangTag));
								if (count($active_languages) > 1) {
									$selectedImageLangue = explode(",", $VmMediaHandler->file_lang);
									$configM = VmModel::getModel('config');
									$languages = $configM->getActiveLanguages($selectedImageLangue, 'media[active_languages][]');

									?>
									<div class="uk-clearfix">
										<label class="uk-form-label"
												uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_FILES_FORM_LANGUAGE_TIP') ?>"
										>
											<?php echo vmText::_('COM_VIRTUEMART_FILES_FORM_LANGUAGE') ?>
										</label>
										<div class="uk-form-controls">
											<?php echo $languages ?>
										</div>
									</div>


									<?php

								}
								if (VmConfig::get('multix', 'none') != 'none') {
									if (empty($VmMediaHandler->virtuemart_vendor_id) and $vendorId === 0) {
										$vendorId = vmAccess::isSuperVendor();
									} else {
										if (empty($vendorId)) {
											$vendorId = $VmMediaHandler->virtuemart_vendor_id;
										}
									}
									$vendorList = ShopFunctions::renderVendorList($vendorId, 'media[virtuemart_vendor_id]');
									echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_VENDOR', $vendorList);
								}


								?>

							</div>
						</div>
						<div class="uk-width-1-3@l">
							<div class="">
								<?php
								$imgWidth = VmConfig::get('img_width', '');
								if (!empty($imgWidth)) {
									$imgWidth = 'width:' . VmConfig::get('img_width', 90) . 'px;';
								} else {
									$imgWidth = 'max-width:200px;width:auto;';
								}

								$imgHeight = VmConfig::get('img_height', '');
								if (!empty($imgHeight)) {
									$imgHeight = 'height:' . VmConfig::get('img_height', 90) . 'px;';
								} else {
									$imgHeight = '';
								}
								$thumbArgs = array('class' => 'vmuikit-js-info-image', 'style' => 'overflow: auto;' . $imgWidth . $imgHeight);
								//echo adminSublayouts::renderAdminVmSubLayout('displayimage', array('VmMediaHandler' => $VmMediaHandler, 'image' => $image, 'key' => $key));

								$mediaThumb = $VmMediaHandler->displayMediaThumb($thumbArgs, false);
								echo $mediaThumb;
								?>

							</div>
						</div>

					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- EOF COM_VIRTUEMART_IMAGE_INFORMATION  -->


	<div class="" uk-grid>
		<div class="uk-width-1-1">
			<div>
				<div class="uk-card   uk-card-small uk-card-vm">
					<div class="uk-card-header">
						<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: cloud-upload; ratio: 1.2"></span>
							<?php echo vmText::_('COM_VIRTUEMART_FILE_UPLOAD'); ?>
						</div>
					</div>

					<div class="uk-card-body">
						<?php


						?>
						<?php

						echo adminSublayouts::renderAdminVmSubLayout('image_upload', array('VmMediaHandler' => $VmMediaHandler,
							//'image' => $ima$VmMediaHandlerge, 'key' => $key,
						));

						?>


					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- EOF COM_VIRTUEMART_FILE_UPLOAD  -->


	<!-- end -->

<?php
$adminTemplate = VMPATH_ROOT . '/administrator/templates/vmadmin/html/com_virtuemart/';
$adminTemplatePath = '/administrator/templates/vmadmin/html/com_virtuemart/';

$urlTemplateHtml = JURI::root(TRUE) .'/administrator/templates/vmadmin/html';
//Virtuemart.medialink = "' . vmURI::createUrlWithPrefix('index.php?option=com_virtuemart&view=media&format=json&mediatype=' . $type) . '";';

$j = 'if (typeof Virtuemart === "undefined")
	var Virtuemart = {};
	Virtuemart.medialink = "' . vmURI::createUrlWithPrefix('index.php?option=com_virtuemart&view=ajax&task=getMedias&format=json&mediatype=' . $type) . '";';

$j .='Virtuemart.mediaScript = "' . JURI::root(TRUE) .'/administrator/templates/vmadmin/html/com_virtuemart/assets/js/vmuikit_mediahandler.js' .'";';

$j .= "jQuery(document).ready(function(){ jQuery('#vmuikit-js-images-container').vmuikitmedia('media','" . $type . "','0') }); ";
vmJsApi::addJScript('mediahandler.vars', $j);
//vmJsApi::addJScript('mediahandler');
$adminTemplatePath = '/administrator/templates/vmadmin/html/com_virtuemart/';
vmJsApi::addJScript($adminTemplatePath . 'assets/js/vmuikit_mediahandler.js');



foreach ($medias as $key => &$image) {
	$image->key = $key;
	$media_path = VMPATH_ROOT . DS . str_replace('/', DS, $image->file_url_thumb);
	if ((empty($image->file_url_thumb) || !file_exists($media_path)) && is_a($image, 'VmImage')) {
		$file_url_thumb = $image->createThumb();
	}
	$image->file_url_thumb = JURI::root(true) . '/' . $file_url_thumb;
	$image->file_url = JURI::root(true) . '/' . $image->file_url;
	$image->file_url_thumb_img = '<img src="' . $image->file_url_thumb . '" alt="' . $image->file_title . '"/>';
	$image->file_url_img = '<img src="' . $image->file_url . '" alt="' . $image->file_title . '"/>';
}
$images = $medias;

$js = "
	var template = jQuery('#vmuikit-js-thumb-images-template').html()
	var rendered = Mustache.render(template,
			{
				'images': " . json_encode($images) . " ,
			}
	)
	jQuery('#vmuikit-js-images-container').html(rendered)

";

vmJsApi::addJScript('mediahandler.mustache', $js);




