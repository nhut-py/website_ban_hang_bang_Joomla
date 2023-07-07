<?php
/**
*
* Description
*
* @package	VirtueMart
* @subpackage vendor
* @author Patrick Kohl, Max Milbers
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: default.php 2701 2011-02-11 15:16:49Z impleri $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
?>

<div class="vendor-details-view">

	<h1 class="page-header"><?php echo vmText::_('COM_VIRTUEMART_VENDOR_TOS'); ?></h1>

	<div class="row">
	  <div class="col-md-6">
			<p><?php echo $this->vendor->vendor_store_name; ?></p>
			<ul class="list-unstyled">
				<li>
					<?php echo $this->linkdetails ?>
				</li>
				<li>
					<?php echo $this->linkcontact ?>
	      </li>
			</ul>
		</div>
		<div class="col-md-6">
		<?php
		if (!empty($this->vendor->images[0])) { ?>
			<div class="vendor-image">
			<?php echo $this->vendor->images[0]->displayMediaThumb('',false); ?>
			</div>
		<?php
		}
		?>
		</div>
	</div>

	<hr>

	<?php // vendor Description
	if(!empty($this->vendor->vendor_terms_of_service  )) { ?>
		<div class="vendor-description">
			<?php echo $this->vendor->vendor_terms_of_service; ?>
		</div>
	<?php } ?>

</div>