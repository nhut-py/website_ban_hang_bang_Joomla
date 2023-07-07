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
 * @version $Id: customcf_template.php 10396 2021-01-11 11:35:30Z alatak $
 *
 */

// Check to ensure this file is included in Joomla!
defined ( '_JEXEC' ) or die ();
?>

<!-- BOF TEMPLATE TO DISPLAY CUSTOMFIELDS -->
<div style=" display: none; ">
	<div id="vmuikit-js-customcf-template">
		<?php
		echo adminSublayouts::renderAdminVmSubLayout('mustache/display_customcf', array());
		?>
	</div>
</div>
<!-- EOF TEMPLATE TO DISPLAY CUSTOMFIELDS -->

