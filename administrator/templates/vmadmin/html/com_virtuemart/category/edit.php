<?php
/**
 *
 * Description
 *
 * @package    VirtueMart
 * @subpackage Category
 * @author RickG, jseros, Valérie Isaksen
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: edit.php 10392 2021-01-11 11:15:34Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$adminTemplate = VMPATH_ROOT . '/administrator/templates/vmadmin/html/com_virtuemart/';
JLoader::register('vmuikitAdminUIHelper', $adminTemplate . 'helpers/vmuikit_adminuihelper.php');

vmuikitAdminUIHelper::startAdminArea($this);
$editor = JFactory::getEditor();
?>

	<form action="index.php" method="post" id="adminForm" name="adminForm" enctype="multipart/form-data" class="uk-form-horizontal">

		<?php // Loading Templates in Tabs
		vmuikitAdminUIHelper::buildTabs($this, array('categoryform' => 'COM_VIRTUEMART_CATEGORY_FORM_LBL',
			'categoryparams' => 'COM_MENUS_DISPLAY_FIELDSET_LABEL',
			'images' => 'COM_VIRTUEMART_IMAGES'
		), $this->category->virtuemart_category_id);
		?>
		<input type="hidden" name="virtuemart_category_id"
				value="<?php echo $this->category->virtuemart_category_id; ?>"/>

		<?php echo $this->addStandardHiddenToForm(); ?>

	</form>
<?php
echo adminSublayouts::renderAdminVmSubLayout('images_template');
?>
<?php vmuikitAdminUIHelper::endAdminArea(); ?>