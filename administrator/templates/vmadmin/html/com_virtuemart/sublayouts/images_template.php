<?php
/**
 *
 * @package VirtueMart
 * @subpackage Sublayouts  build tabs end
 * @author Max Milbers, Valérie Isaksen
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * @version $Id: images_template.php 10396 2021-01-11 11:35:30Z alatak $
 *
 */

// Check to ensure this file is included in Joomla!
defined ( '_JEXEC' ) or die ();

?>

<!-- BOF TEMPLATE TO DISPLAY THE IMAGES RETURNED BY AJAX-->
<div style=" display: none; ">
	<?php
	echo adminSublayouts::renderAdminVmSubLayout('mustache/search_medias', array());
	?>
</div>
<!-- / BOF TEMPLATE TO DISPLAY THE IMAGES RETURNED BY AJAX-->

<!-- BOF TEMPLATE TO DISPLAY IMAGES -->
<div style=" display: none; ">
	<div id="vmuikit-js-thumb-images-template">
		<?php
		echo adminSublayouts::renderAdminVmSubLayout('mustache/displayimage', array());
		?>
	</div>
</div>
<!-- EOF TEMPLATE TO DISPLAY IMAGES -->


<!-- BOF TEMPLATE TO APPEND SELECTED IMAGE -->
<div style=" display: none; ">
	<div id="display-selected-media-template">
		<?php
		echo adminSublayouts::renderAdminVmSubLayout('mustache/displayimage', array());
		?>
	</div>
</div>
<!-- EOF TEMPLATE TO APPEND SELECTED IMAGE -->
