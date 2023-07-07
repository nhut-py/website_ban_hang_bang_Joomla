<?php
/**
 *
 * Show the product details page
 *
 * @package	VirtueMart
 * @author Max Milbers, Valerie Isaksen
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2014 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @version $Id: default_manufacturer.php 8794 2015-03-12 18:31:55Z Milbo $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
?>
<div class="manufacturer small margin-top-15">
	<?php
	$i = 1;
  echo JText::_('COM_VIRTUEMART_PRODUCT_DETAILS_MANUFACTURER_LBL') . ' ';
	$mans = array();
	// Gebe die Hersteller aus
	foreach($this->product->manufacturers as $manufacturers_details) {

		//Link to products
    $link = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_manufacturer_id=' . $manufacturers_details->virtuemart_manufacturer_id, FALSE);
    $name = $manufacturers_details->mf_name;

		// Avoid JavaScript on PDF Output
		$mans[] = JHtml::_('link', $link, $name);
	}
	echo implode(', ',$mans);
	?>
</div>