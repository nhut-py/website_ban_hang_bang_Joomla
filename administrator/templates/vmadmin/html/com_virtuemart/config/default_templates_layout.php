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
 * @version $Id: default_templates_layout.php 10393 2021-01-11 11:23:39Z alatak $
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
		<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: paint-bucket; ratio: 1.2"></span>
			<?php echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_LAYOUT_SETTINGS'); ?>
		</div>
	</div>
	<div class="uk-card-body">
		<?php
		$opt = array(
			'' => vmText::_('COM_VIRTUEMART_NONE_USE_LEGACY'),
			'bs2' => vmText::_('Bootstrap 2'),
			'bs3' => vmText::_('Bootstrap 3'),
			'bs4' => vmText::_('Bootstrap 4')
		);
		echo VmuikitHtml::row('genericlist', 'COM_VM_SELECT_BOOTSTRAP_VERSION', $opt, 'bootstrap', 'size=1 width=200', 'value', 'name', VmConfig::get('bootstrap', ''));
		echo VmuikitHtml::row('genericlist', 'COM_VIRTUEMART_SELECT_DEFAULT_SHOP_TEMPLATE', $this->jTemplateList, 'vmtemplate', 'size=1 width=200', 'value', 'name', VmConfig::get('vmtemplate', ''));
		echo VmuikitHtml::row('genericlist', 'COM_VIRTUEMART_ADMIN_CFG_CATEGORY_TEMPLATE', $this->jTemplateList, 'categorytemplate', 'size=1 width=200', 'value', 'name', VmConfig::get('categorytemplate', ''));
		echo VmuikitHtml::row('genericlist', 'COM_VIRTUEMART_ADMIN_CFG_CART_LAYOUT', $this->cartLayoutList, 'cartlayout', 'size=1', 'value', 'text', VmConfig::get('cartlayout', 'default'));
		echo VmuikitHtml::row('genericlist', 'COM_VIRTUEMART_ADMIN_CFG_CATEGORY_LAYOUT', $this->categoryLayoutList, 'categorylayout', 'size=1', 'value', 'text', VmConfig::get('categorylayout', 'default'));
		echo VmuikitHtml::row('genericlist', 'COM_VIRTUEMART_CFG_PRODUCTS_SUBLAYOUT', $this->productsFieldList, 'productsublayout', 'size=1', 'value', 'text', VmConfig::get('productsublayout', 0));
		echo VmuikitHtml::row('genericlist', 'COM_VIRTUEMART_ADMIN_CFG_PRODUCT_LAYOUT', $this->productLayoutList, 'productlayout', 'size=1', 'value', 'text', VmConfig::get('productlayout', 'default'));
		?>
	</div>
</div>

