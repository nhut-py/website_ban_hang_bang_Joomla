<?php
/**
 *
 *
 * @package    VirtueMart
 * @subpackage
 * @author Max Milbers
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: edit.php 10396 2021-01-11 11:35:30Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$adminTemplate = VMPATH_ROOT . '/administrator/templates/vmadmin/html/com_virtuemart/';
JLoader::register('vmuikitAdminUIHelper', $adminTemplate . 'helpers/vmuikit_adminuihelper.php');

vmuikitAdminUIHelper::startAdminArea($this);
vmuikitAdminUIHelper::imitateTabs('start', 'COM_VIRTUEMART_PRODUCT_MEDIA');

?>
	<form action="index.php" method="post" name="adminForm" id="adminForm" class="uk-form-horizontal" enctype="multipart/form-data">

		<!-- MEDIA Hidden -->
		<input type="hidden"   name="view" value="media" />
		<input type="hidden" name="task" value="" />
		<input type="hidden"  name="<?php JSession::getFormToken() ?>" value="1" />
		<input type="hidden"  name="file_type" value="<?php echo $this->media->file_type ?>" />

		<?php

		$virtuemart_product_id = vRequest::getInt('virtuemart_product_id', '');
		if (!empty($virtuemart_product_id)) {
			?>
			<input type="hidden"  name="virtuemart_product_id" value="<?php echo $virtuemart_product_id ?>" />
				<?php
		}

		$virtuemart_category_id = vRequest::getInt('virtuemart_category_id', '');
		if (!empty($virtuemart_category_id)) {
			?>
			<input type="hidden"  name="virtuemart_category_id" value="<?php echo $virtuemart_category_id ?>" />
			<?php
		}
		?>
		<?php
		echo VmuikitMediaHandler::displayFileHandler($this->media,$fileIds='',$type='',$vendorId = 0, $canSearch=false);

		//echo $this->media->displayFileHandler();
		?>

	</form>


<?php
// TODO: do we need the native script ?
vmJsApi::addJScript('mediahandler');

vmuikitAdminUIHelper::imitateTabs('end');
vmuikitAdminUIHelper::endAdminArea();
