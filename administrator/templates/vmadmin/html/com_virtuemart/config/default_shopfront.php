<?php
/**
 *
 * Description
 *
 * @packageVirtueMart
 * @subpackage Config
 * @author RickG
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_shopfront.php 10425 2021-01-19 07:08:40Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');?>

<div class="uk-child-width-1-2@m uk-grid-match uk-grid-small" uk-grid>
	<div>
		<?php echo $this->loadTemplate('shopfront_settings') ?>
	</div>
	<div>
		<?php echo $this->loadTemplate('shopfront_stock') ?>
	</div>
	<div>
		<?php echo $this->loadTemplate('shopfront_recommendask') ?>
	</div>
	<div>
		<?php echo $this->loadTemplate('shopfront_review') ?>
	</div>
	<div>
		<?php echo $this->loadTemplate('shopfront_coupon') ?>
	</div>
	<div>
		<?php echo $this->loadTemplate('shopfront_product') ?>
	</div>
</div>
<?php
vmJsApi::addJScript('vm-imagechange','
	jQuery("#image").change(function () {
		var $newimage = jQuery(this).val();
		jQuery("#product_availability").val($newimage);
		jQuery("#imagelib").attr({ src:"'.JURI::root(true) . $this->imagePath.'" + $newimage, alt:$newimage });
	});');
?>


