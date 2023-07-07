<?php
/**
 *
 * @package    VirtueMart
 * @subpackage Config
 * @author RickG, Valérie Isaksen
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default.php 10396 2021-01-11 11:35:30Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die ('Restricted access');
$adminTemplate = VMPATH_ROOT . '/administrator/templates/vmadmin/html/com_virtuemart/';
JLoader::register('vmuikitAdminUIHelper', $adminTemplate . 'helpers/vmuikit_adminuihelper.php');
vmuikitAdminUIHelper::startAdminArea($this);
?>

	<form action="index.php" method="post" name="adminForm" id="adminForm" class="uk-form-horizontal">

		<?php // Loading Templates in Tabs

		vmuikitAdminUIHelper::buildTabs($this, array(
			'shop' => 'COM_VIRTUEMART_ADMIN_CFG_SHOPTAB',
			'email' => 'COM_VIRTUEMART_ADMIN_CFG_ORDERTAB',
			'shopfront' => 'COM_VIRTUEMART_ADMIN_CFG_SHOPFRONTTAB',
			'templates' => 'COM_VIRTUEMART_ADMIN_CFG_TEMPLATESTAB',
			'pricing' => 'COM_VIRTUEMART_ADMIN_CFG_PRICINGTAB',
			'checkout' => 'COM_VIRTUEMART_ADMIN_CFG_CHECKOUTTAB',
			'product_order' => 'COM_VIRTUEMART_ADMIN_CFG_PRODUCTORDERTAB',
			'feeds' => 'COM_VIRTUEMART_ADMIN_CFG_FEEDS',
			'sef' => 'COM_VIRTUEMART_ADMIN_CFG_SEF'

		), $cookieName = '', $width = 'uk-width-1-1');

		?>

		<!-- Hidden Fields --> <input type="hidden" name="task" value=""/> <input
				type="hidden" name="option" value="com_virtuemart"/> <input
				type="hidden" name="view" value="config"/>
		<?php
		echo JHtml::_('form.token');
		?>
	</form>
<?php
vmuikitAdminUIHelper::endAdminArea();


?>