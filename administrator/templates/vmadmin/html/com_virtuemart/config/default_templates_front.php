<?php
/**
 *
 * Description
 *
 * @package    VirtueMart
 * @subpackage Config
 * @author Max Milbers
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_templates_front.php 10393 2021-01-11 11:23:39Z alatak $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$params = VmConfig::loadConfig();

?>
<?php
$type = 'checkbox';

?>

<div class="uk-card uk-card-small uk-card-vm">
	<div class="uk-card-header">
		<div class="uk-card-title"
				uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_FRONT_CSS_JS_SETTINGS_TIP'); ?>">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: home; ratio: 1.2"></span>
			<?php echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_FRONT_CSS_JS_SETTINGS'); ?>
		</div>
		<div class="uk-margin-small-top uk-text-meta">
			<?php echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_FRONT_CSS_JS_SETTINGS_TIP'); ?>
		</div>
	</div>
	<div class="uk-card-body">

		<?php
		echo VmuikitHtml::row('booleanlist', 'COM_VM_CFG_USE_LAZYLOAD', 'lazyLoad', VmConfig::get('lazyLoad', 1));
		echo VmuikitHtml::row('booleanlist', 'COM_VM_USE_LAYOUT_OVERR', 'useLayoutOverrides', VmConfig::get('useLayoutOverrides', 1));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_CFG_FANCY', 'usefancy', VmConfig::get('usefancy', 1));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_ADMIN_CFG_FRONT_CSS', 'css', VmConfig::get('css', 1));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_ADMIN_CFG_FRONT_JQUERY_FW', 'jquery_framework', VmConfig::get('jquery_framework', 1));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_ADMIN_CFG_FRONT_JQUERY', 'jquery', VmConfig::get('jquery', 1));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_ADMIN_CFG_FRONT_JPRICE', 'jprice', VmConfig::get('jprice', 1));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_ADMIN_CFG_FRONT_JSITE', 'jsite', VmConfig::get('jsite', 1));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_ADMIN_CFG_FRONT_JCHOSEN', 'jchosen', VmConfig::get('jchosen', 1));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_ADMIN_CFG_FRONT_JDYNUPDATE', 'jdynupdate', VmConfig::get('jdynupdate', 1));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_ADMIN_CFG_FRONT_AJAX_CATEGORY', 'ajax_category', VmConfig::get('ajax_category', 0));
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_ADMIN_CFG_ENABLE_GOOGLE_JQUERY', 'google_jquery', VmConfig::get('google_jquery', 0));
		//echo VmHTML::row('checkbox','COM_VIRTUEMART_ADMIN_CFG_JS_CSS_MINIFIED','minified', VmConfig::get('minified',1));
		?>
	</div>
</div>

