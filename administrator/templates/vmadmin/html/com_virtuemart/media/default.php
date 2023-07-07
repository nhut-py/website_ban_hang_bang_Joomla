<?php
/**
 *
 *
 * @package	VirtueMart
 * @subpackage
 * @author Max Milbers
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default.php 10451 2021-01-27 08:16:53Z alatak $
 */
defined('_JEXEC') or die();


$adminTemplate = VMPATH_ROOT . '/administrator/templates/vmadmin/html/com_virtuemart/';
JLoader::register('vmuikitAdminUIHelper', $adminTemplate . 'helpers/vmuikit_adminuihelper.php');
vmuikitAdminUIHelper::startAdminArea($this);

jimport('joomla.filesystem.file');

/* Get the component name */
$option = vRequest::getCmd('option');

?>
	<form action="index.php?option=com_virtuemart&view=media" method="post" name="adminForm" id="adminForm">
		<div id="filterbox" class="filter-bar">
				<?php
				$extras=array();
				$extras[]=$this->lists['search_type'];
				$extras[]=$this->lists['search_role'];

				$extras[]=VmHtml::checkbox('missing', vRequest::getInt('missing', 0), 1, 0).' '.'<span   uk-tooltip="' . vmText::_('COM_VM_MEDIA_MISSING_TIP') . '" style="vertical-align:middle;padding:4px 0 0;">' . vmText::_('COM_VM_MEDIA_MISSING') . '</span>';
				$extras[]= VmHtml::checkbox('findUnusedMedias', vRequest::getInt('findUnusedMedias', 0), 1, 0).'<span   uk-tooltip="' . vmText::_('COM_VM_MEDIA_UNUSED_TIP') . '" style="vertical-align:middle;padding:4px 0 0;">' . vmText::_('COM_VM_MEDIA_UNUSED') . '</span>' ;

				$extras[]=$this->lists['vendors'];


				echo adminSublayouts::renderAdminVmSubLayout('filterbar',
					array(
						'search'=>array(
							'label'=>'COM_VIRTUEMART_NAME',
							'name'=>'searchMedia',
							'value'=>vRequest::getVar('searchMedia')
						),
						'extras'=>$extras,
						'resultsCounter'=>$this->pagination->getResultsCounter()
					));


				?>
		</div>
		<?php
		$productfileslist = $this->files;
		//$roles = $this->productfilesroles;
		?>

		<table class="uk-table uk-table-small uk-table-striped uk-table-responsive">
			<thead>
			<tr>
				<th><input type="checkbox" name="toggle" value=""
							onclick="Joomla.checkAll(this)"/></th>
				<?php /*<th><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_NAME'); ?></th>*/ ?>
				<th width="30%"><?php echo $this->sort('file_title', 'COM_VIRTUEMART_FILES_LIST_FILETITLE') ?></th>
				<th style="min-width:100px;width:5%;"><?php echo $this->sort('file_type', 'COM_VIRTUEMART_FILES_LIST_ROLE') ?></th>
				<th width="50%"><?php echo vmText::_('COM_VIRTUEMART_VIEW'); ?></th>
				<th style="min-width:120px;width:15%;"><?php echo vmText::_('COM_VIRTUEMART_FILES_LIST_FILENAME'); ?></th>
				<th style="min-width:30px;width:1%;max-width:40px;"><?php echo vmText::_('COM_VIRTUEMART_FILES_LIST_FILETYPE'); ?></th>
				<th><?php echo $this->sort('published', 'COM_VIRTUEMART_PUBLISHED'); ?></th>
				<th><?php echo $this->sort('virtuemart_media_id', 'COM_VIRTUEMART_ID') ?></th>
			</tr>
			</thead>
			<tbody>
			<?php
			if (count($productfileslist) > 0) {
				$i = 0;
				$k = 0;
				//$onlyMissing = vRequest::getCmd('missing',false);
				foreach ($productfileslist as $key => $productfile) {

					if ($productfile->file_is_forSale) {
						$fullSizeFilenamePath = $productfile->file_url_folder . $productfile->file_name . '.' . $productfile->file_extension;
						$fullSizeFilenamePath = vRequest::filterPath($fullSizeFilenamePath);
					} else {
						if (substr($productfile->file_url, 0, 2) == "//") {
							$fullSizeFilenamePath = $productfile->file_url;
						} else {
							$fullSizeFilenamePath = VMPATH_ROOT . DS . $productfile->file_url_folder . $productfile->file_name . '.' . $productfile->file_extension;
							$fullSizeFilenamePath = vRequest::filterPath($fullSizeFilenamePath);
						}
					}


					$checked = JHtml::_('grid.id', $i, $productfile->virtuemart_media_id, null, 'virtuemart_media_id');
					if (!is_null($productfile->virtuemart_media_id)) {
						$published = $this->gridPublished($productfile, $i);
					} else {
						$published = '';
					}
					?>
					<tr class="row<?php echo $k; ?>">
						<!-- Checkbox -->
						<td><?php echo $checked; ?></td>
						<!-- Product name -->
						<?php
						$link = ""; //"index.php?view=media&limitstart=".$pagination->limitstart."&keyword=".urlencode($keyword)."&option=".$option;
						/*	?>
							<td><?php echo JHtml::_('link', JRoute::_($link, FALSE), empty($productfile->product_name)? '': htmlentities($productfile->product_name)); ?></td>
							<!-- File name -->
							<?php */
						$link = 'index.php?option=' . $option . '&view=media&task=edit&virtuemart_media_id[]=' . $productfile->virtuemart_media_id;
						?>
						<td><?php echo JHtml::_('link', JRoute::_($link, FALSE), $productfile->file_title, array('title' => vmText::_('COM_VIRTUEMART_EDIT') . ' ' . $productfile->file_title)); ?></td>
						<!-- File role -->
						<td><?php
							//Just to have something, we could make this nicer with Icons
							if (!empty($productfile->file_is_product_image)) {
								echo vmText::_('COM_VIRTUEMART_' . strtoupper($productfile->file_type) . '_IMAGE');
							}
							if (!empty($productfile->file_is_downloadable)) {
								echo vmText::_('COM_VIRTUEMART_DOWNLOADABLE');
							}
							if (!empty($productfile->file_is_forSale)) {
								echo vmText::_('COM_VIRTUEMART_FOR_SALE');
							}

							?>
						</td>
						<!-- Preview -->
						<td>
							<?php


							if (file_exists($fullSizeFilenamePath) or substr($fullSizeFilenamePath, 0, 2) == "//") {
								echo $productfile->displayMediaThumb();
							} else {
								$file_url = $productfile->theme_url . 'assets/images/vmgeneral/' . VmConfig::get('no_image_found');
								$file_alt = vmText::_('COM_VIRTUEMART_NO_IMAGE_SET') . ' ' . $productfile->file_description;
								echo $productfile->displayIt($file_url, $file_alt, '', false);
							}


							?>
						</td>
						<!-- File title -->
						<td><?php echo $productfile->file_name; ?></td>
						<!-- File extension -->
						<td style="overflow:hidden;"><span
									class="vmicon vmicon-16-ext_<?php echo $productfile->file_extension; ?>"></span><?php echo $productfile->file_extension; ?>
						</td>
						<!-- published -->
						<td><?php echo $published; ?></td>
						<td><?php echo $productfile->virtuemart_media_id; ?></td>
					</tr>
					<?php
					$k = 1 - $k;
					$i++;
				}
			}
			?>
			</tbody>
			<tfoot>
			<tr>
				<td colspan="15">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
			</tfoot>
		</table>

		<!-- Hidden Fields -->
		<?php if (vRequest::getInt('virtuemart_product_id', false)) { ?>
			<input type="hidden" name="virtuemart_product_id"
					value="<?php echo vRequest::getInt('virtuemart_product_id', 0); ?>"/>
		<?php } ?>
		<?php echo $this->addStandardHiddenToForm(); ?>
	</form>

<?php vmuikitAdminUIHelper::endAdminArea(); ?>