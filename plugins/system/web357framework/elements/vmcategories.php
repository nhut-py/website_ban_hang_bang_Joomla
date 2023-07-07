<?php
/* ======================================================
 # Web357 Framework for Joomla! - v1.9.1 (free version)
 # -------------------------------------------------------
 # For Joomla! CMS (v3.x)
 # Author: Web357 (Yiannis Christodoulou)
 # Copyright (©) 2014-2022 Web357. All rights reserved.
 # License: GNU/GPLv3, http://www.gnu.org/licenses/gpl-3.0.html
 # Website: https:/www.web357.com
 # Demo: https://demo.web357.com/joomla/
 # Support: support@web357.com
 # Last modified: Thursday 17 February 2022, 03:25:10 AM
 ========================================================= */

 
defined('_JEXEC') or die();

if (!class_exists( 'VmConfig' )) {
	require(JPATH_ROOT .'/administrator/components/com_virtuemart/helpers/config.php');
}

if (!class_exists('ShopFunctions')) {
	require(JPATH_ROOT .'/administrator/components/com_virtuemart/helpers/shopfunctions.php');
}

jimport('joomla.form.formfield');

/*
 * This element is used by the menu manager
 * Should be that way
 */
class JFormFieldVmcategories extends JFormField {

	var $type = 'vmcategories';

	protected function getInput() {

		VmConfig::loadConfig();

		if (class_exists('vmLanguage'))
		{
			vmLanguage::loadJLang('com_virtuemart');
		}

		if(!is_array($this->value))$this->value = array($this->value);
		$categorylist = ShopFunctions::categoryListTree($this->value);

		$name = $this->name;
		if($this->multiple){
			$name = $this->name;
			$this->multiple = ' multiple="multiple" ';
		}
		$id = VmHtml::ensureUniqueId('vmcategories');
		$html = '<select id="'.$id.'" class="inputbox"   name="' . $name . '" '.$this->multiple.' >';
		if(!$this->multiple)$html .= '<option value="0">' . vmText::_('COM_VIRTUEMART_CATEGORY_FORM_TOP_LEVEL') . '</option>';
		$html .= $categorylist;
		$html .= "</select>";
		return $html;
	}

}