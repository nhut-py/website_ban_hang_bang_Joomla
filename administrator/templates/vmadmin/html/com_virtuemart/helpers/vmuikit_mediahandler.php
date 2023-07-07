<?php
/**
 *
 * Media file handler class
 *
 * This class provides some file handling functions that are used throughout the VirtueMart shop.
 *  Uploading, moving, deleting
 *
 * @package	VirtueMart
 * @subpackage Helpers
 * @author Max Milbers
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: vmuikit_mediahandler.php 10396 2021-01-11 11:35:30Z alatak $
 */




defined('_JEXEC') or die();





class VmuikitMediaHandler  {
	/* media view */
	static public function displayFileHandler($VmMediaHandler,$fileIds='',$type='',$vendorId = 0){
		vmLanguage::loadJLang('com_virtuemart_media');
		$medias=array();
		if(!empty($fileIds)) {
			$model = VmModel::getModel('Media');
			$medias = $model->createMediaByIds($fileIds, $type);
		}
//0105


		return adminSublayouts::renderAdminVmSubLayout('images',
			array(
				'VmMediaHandler'=>$VmMediaHandler,
				'medias'=>$medias,
				'type'=>$type,
				'vendorId'=>$vendorId,
				'canSearch'=>false,
			));
	}
	static public function displayFilesHandler($VmMediaHandler,$fileIds='',$type='',$vendorId = 0, $canSearch=true){
		vmLanguage::loadJLang('com_virtuemart_media');
		$medias=array();
		if(!empty($fileIds)) {
			$model = VmModel::getModel('Media');
			$medias = $model->createMediaByIds($fileIds, $type);
		}
		return adminSublayouts::renderAdminVmSubLayout('images',
			array(
				'VmMediaHandler'=>$VmMediaHandler,
				'medias'=>$medias,
				'type'=>$type,
				'vendorId'=>$vendorId,
				'canSearch'=>$canSearch,
			));
	}

	static public function displayFilesTemplate($VmMediaHandler,$fileIds='',$type='',$vendorId = 0){
		vmLanguage::loadJLang('com_virtuemart_media');
		$medias=array();
		if(!empty($fileIds)) {
			$model = VmModel::getModel('Media');
			$medias = $model->createMediaByIds($fileIds, $type);
		}
		return adminSublayouts::renderAdminVmSubLayout('images_template',
			array(
				'VmMediaHandler'=>$VmMediaHandler,
				'medias'=>$medias,
				'type'=>$type,
				'vendorId'=>$vendorId,
			));
	}


	static public function displayImage($VmMediaHandler,$fileIds='',$type='',$vendorId = 0){
		vmLanguage::loadJLang('com_virtuemart_media');
		vmJsApi::addJScript('js/mustache.js');

	}

static function getOptions($optionsarray){

		$options=array();
		foreach($optionsarray as $optionName=>$langkey){

			if ($langkey=='COM_VIRTUEMART_NONE') {
				$text='<span uk-icon="icon: trash"></span> '.vmText::_( 'COM_VIRTUEMART_IMAGE_UPLOAD_REMOVE' );
			} elseif ($langkey=='COM_VIRTUEMART_FORM_MEDIA_UPLOAD') {
				$text='<span uk-icon="icon: upload"></span> '.vmText::_( 'COM_VIRTUEMART_FORM_MEDIA_UPLOAD' );
			} elseif ($langkey=='COM_VIRTUEMART_FORM_MEDIA_UPLOAD_REPLACE') {
				$text='<span uk-icon="icon: refresh"></span> '.vmText::_( 'COM_VIRTUEMART_FORM_MEDIA_UPLOAD_REPLACE' );
			} elseif ($langkey=='COM_VIRTUEMART_FORM_MEDIA_UPLOAD_REPLACE_THUMB') {
				$text='<span uk-icon="icon: thumbnails"></span> '.vmText::_( 'COM_VIRTUEMART_FORM_MEDIA_UPLOAD_REPLACE_THUMB' );
			}
			else {
				$text=vmText::_( $langkey );
			}
			$options[] = JHtml::_('select.option',  $optionName, $text );
		}
		return $options;
	}


}
