<?php
/**
*
*
* @package	VirtueMart
* @subpackage Log
* @author Valérie Isaksen
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
defined('_JEXEC') or die('Restricted access');

$adminTemplate = VMPATH_ROOT . '/administrator/templates/vmadmin/html/com_virtuemart/';
JLoader::register('vmuikitAdminUIHelper', $adminTemplate . 'helpers/vmuikit_adminuihelper.php');
vmuikitAdminUIHelper::startAdminArea($this);
//$finfo = finfo_open(FILEINFO_MIME);
if(class_exists('finfo')){
	$finfo = new finfo(FILEINFO_MIME);
} else {
	vmInfo('The function finfo should be activated on the server');
	$finfo = false;
}

?>
<table class="adminlist table table-striped" cellspacing="0" cellpadding="0">
		<thead>
		<tr>
			<th>
				<?php echo vmText::_('COM_VIRTUEMART_LOG_FILENAME'); ?>
			</th>
			<th>
				<?php echo vmText::_('COM_VIRTUEMART_LOG_FILEINFO'); ?>
			</th>
			<th>
				<?php echo vmText::_('COM_VIRTUEMART_LOG_FILESIZE'); ?>
			</th>

		</tr>
		</thead>
		<?php
		$k = 0;
		if ($this->logFiles) {
			foreach ($this->logFiles as $logFile ) {
				$addLink=false;
				$fileSize = round(filesize($this->path.DS.$logFile)/1024.0,2);
				$fileInfo= $finfo?$finfo->file($this->path.DS.$logFile):0;
				$fileInfoMime=substr($fileInfo, 0 ,strlen("text/plain"));
				if (!$finfo or strcmp("text/plain", $fileInfoMime)==0) {
					$addLink=true;
				}
				?>
				<tr class="row<?php echo $k ; ?>">

					<td align="left">
						<?php if ($fileSize > 0 and $addLink) { ?>
							<a href="<?php echo JRoute::_('index.php?option=com_virtuemart&view=log&task=edit&logfile='.$logFile); ?>">
					<?php	}?>
						 <?php echo $logFile; ?>
						<?php if ($fileSize > 0) { ?>
						</a>
							<?php	}?>
					</td>
				<td align="left">
					<?php
					echo  $fileInfo; ?>

				</td>
					<td align="left">
<?php
						echo  $fileSize." ".vmText::_('COM_VIRTUEMART_LOG_KB'); ?>

					</td>

				</tr>
				<?php
				$k = 1 - $k;
			}
		}
		?>
	</table>

	<?php
	echo $this->addStandardHiddenToForm();
	vmuikitAdminUIHelper::endAdminArea();
	?>
