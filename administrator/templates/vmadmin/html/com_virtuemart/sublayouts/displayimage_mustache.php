<?php
/**
 *
 * @package VirtueMart
 * @subpackage Sublayouts
 * @author Eugen Stranz, Max Milbers
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * @version $Id: displayimage_mustache.php 10396 2021-01-11 11:35:30Z alatak $
 *
 */

// Check to ensure this file is included in Joomla!
defined ( '_JEXEC' ) or die ();


/** @var TYPE_NAME $viewData */

$VmMediaHandler = $viewData['VmMediaHandler'];

$medias = $viewData['medias'];

vmJsApi::addJScript('/media/com_virtuemart/js/mustache.js');

?>
<?php

foreach ($medias as $key => &$image) {
	$image->key = $key;
	$media_path = VMPATH_ROOT . DS . str_replace('/', DS, $image->file_url_thumb);
	if ((empty($image->file_url_thumb) || !file_exists($media_path)) && is_a($image, 'VmImage')) {
		$file_url_thumb = $image->createThumb();
	}
	$image->file_url_thumb = JURI::root(true) . '/' . $file_url_thumb;
	$image->file_url = JURI::root(true) . '/' . $image->file_url;
}
$images = $medias;
?>
<!-- BOF TEMPLATE displayimage_mustache -->
<div>
	<div id="vmuikit-js-thumb-images-template">
		<?php echo adminSublayouts::renderAdminVmSubLayout('mustache/displayimage'); ?>
	</div>
</div>

<!-- EOF TEMPLATE displayimage_mustache -->
<?php
$js = "
	var template = jQuery('#vmuikit-js-thumb-images-template').html()
	var rendered = Mustache.render(template,
			{
				'images': " . json_encode($images) . " ,
			}
	)
		jQuery('#vmuikit-js-thumb-images-output').html(rendered)

";

vmJsApi::addJScript('mediahandler.mustache', $js);
?>



