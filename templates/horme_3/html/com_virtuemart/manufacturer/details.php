<?php
/**
*
* Description
*
* @package	VirtueMart
* @subpackage Manufacturer
* @author Kohl Patrick, Eugen Stranz
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

<div class="manufacturer-details-view">

	<h1 class="page-header"><?php echo $this->manufacturer->mf_name; ?></h1>

	<div class="row">

		<div class="col-md-8">
			<ul class="list-inline small">
			<?php // Manufacturer Email
			if(!empty($this->manufacturer->mf_email)) { ?>
				<li class="manufacturer-email">
					<span class="glyphicon glyphicon-envelope"></span>&nbsp;
					<?php // TO DO Make The Email Visible Within The Lightbox
					echo JHtml::_('email.cloak', $this->manufacturer->mf_email,true,vmText::_('COM_VIRTUEMART_EMAIL'),false) ?>
				</li>
			<?php } ?>

			<?php // Manufacturer URL
			if(!empty($this->manufacturer->mf_url)) { ?>
				<li class="manufacturer-url">
					<span class="glyphicon glyphicon-new-window"></span>&nbsp;
					<a target="_blank" href="<?php echo $this->manufacturer->mf_url ?>"><?php echo vmText::_('COM_VIRTUEMART_MANUFACTURER_PAGE') ?></a>
				</li>
			<?php } ?>
      </ul>

			<?php // Manufacturer Description
			if(!empty($this->manufacturer->mf_desc)) { ?>
				<div class="manufacturer-description">
					<?php echo $this->manufacturer->mf_desc ?>
				</div>
			<?php } ?>
    </div>
		<?php // Manufacturer Image
		if (!empty($this->manufacturerImage)) { ?>
			<div class="manufacturer-image col-md-4">
			<?php echo $this->manufacturerImage; ?>
			</div>
		<?php } ?>
		<div class="col-md-12">
			<hr>
			<?php // Manufacturer Product Link
			$manufacturerProductsURL = JRoute::_('index.php?option=com_virtuemart&amp;view=category&amp;virtuemart_manufacturer_id=' . $this->manufacturer->virtuemart_manufacturer_id, FALSE);
			if(!empty($this->manufacturer->virtuemart_manufacturer_id)) { ?>
				<a class="manufacturer-product-link btn btn-primary btn-sm" target="_top" href="<?php echo $manufacturerProductsURL; ?>"><?php echo vmText::sprintf('COM_VIRTUEMART_PRODUCT_FROM_MF',$this->manufacturer->mf_name); ?></a>
			<?php } ?>
		</div>

	</div>
  <hr>
</div>