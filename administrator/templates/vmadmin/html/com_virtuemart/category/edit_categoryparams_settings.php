<?php
/**
 *
 * Description
 *
 * @package    VirtueMart
 * @subpackage Category
 * @author Max Milbers, Valérie Isaksen
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2017 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: edit_categoryparams_settings.php 10392 2021-01-11 11:15:34Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

$params = $this->category;
$adminTemplate = VMPATH_ROOT . '/administrator/templates/vmadmin/html/com_virtuemart/';

?>

<div class="uk-card   uk-card-small uk-card-vm">
	<div class="uk-card-header">
		<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: paint-bucket; ratio: 1.2"></span>
			<?php echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_LAYOUT_SETTINGS'); ?>
		</div>
	</div>
	<div class="uk-card-body">
		<?php
		echo VmuikitHtml::row('genericlist', 'COM_VIRTUEMART_ADMIN_CFG_CATEGORY_TEMPLATE', $this->jTemplateList, 'categorytemplate', 'size=1 width=200', 'value', 'name', $this->category->get('categorytemplate', ''));
		echo VmuikitHtml::row('genericlist', 'COM_VIRTUEMART_ADMIN_CFG_CATEGORY_LAYOUT', $this->categoryLayoutList, 'categorylayout', 'size=1', 'value', 'text', $this->category->get('categorylayout', ''));
		echo VmuikitHtml::row('genericlist', 'COM_VIRTUEMART_CFG_PRODUCTS_SUBLAYOUT', $this->productsFieldList, 'productsublayout', 'size=1', 'value', 'text', $this->category->get('productsublayout', ''));
		echo VmuikitHtml::row('genericlist', 'COM_VIRTUEMART_ADMIN_CFG_PRODUCT_LAYOUT', $this->productLayoutList, 'productlayout', 'size=1', 'value', 'text', $this->category->get('productlayout', ''));
		?>
	</div>
</div>

