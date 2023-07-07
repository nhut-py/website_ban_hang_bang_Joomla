<?php
/**
 *
 * Information regarding the product status
 *
 * @package    VirtueMart
 * @subpackage Product
 * @author RolandD
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: product_edit_status.php 10391 2021-01-11 11:13:42Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access'); ?>
<div class="uk-grid-small uk-child-width-1-1" uk-grid>
	<div>
		<?php echo $this->loadTemplate('status_status') ?>
	</div>


	<div>
		<?php echo $this->loadTemplate('status_email') ?>
	</div>
</div>





