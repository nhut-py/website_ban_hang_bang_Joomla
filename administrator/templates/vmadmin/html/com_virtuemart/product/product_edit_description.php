<?php
/**
 *
 * Set the descriptions for a product
 *
 * @package    VirtueMart
 * @subpackage Product
 * @author RolandD
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: product_edit_description.php 10391 2021-01-11 11:13:42Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access'); ?>
<div class="uk-child-width-1-1" uk-grid>
	<div>
		<?php echo $this->loadTemplate('description_sdesc') ?>

	</div>

	<div>
		<?php echo $this->loadTemplate('description_desc') ?>
	</div>


	<div>
		<?php
		echo adminSublayouts::renderAdminVmSubLayout('metaedit',
			array(
				'obj' => $this->product,
			)
		); ?>

	</div>

</div>



