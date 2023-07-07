<?php
/**
*
* Display form order filter
*
* @package    VirtueMart
* @subpackage Orders
* @author Oscar van Eijk, Max Milbers, Valérie Isaksen
* @link https://virtuemart.net
* @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: order_filter.php 10408 2021-01-12 08:18:32Z alatak $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

?>

<div id="filterbox" class="filter-bar">
	<?php
	$extras = array();

	$extras[] = adminSublayouts::renderAdminVmSubLayout('print_links',
		array(
			'order' => $this->orderbt,
			'iconRatio' => 1.2,
			'hrefClass' => 'uk-icon-button',
		)

	);


	if ($this->unequal) {
		$labelPaid = 'COM_VIRTUEMART_ORDER_IS_UNPAID';
		$colorPaidTool = 'md-color-red-600';
		$textPaidAction = 'COM_VIRTUEMART_ORDER_SET_PAID';
		$colorPaidAction = 'md-bg-green-600 md-color-white';
		$valPaid = '1';
	} else {
		$labelPaid = 'COM_VIRTUEMART_ORDER_IS_PAID';
		$colorPaidTool = 'md-color-green-600';
		$textPaidAction = 'COM_VIRTUEMART_ORDER_SET_UNPAID';
		$colorPaidAction = 'md-bg-red-600 md-color-white';
		$valPaid = '0';

	}
	$linkPaid = 'index.php?option=com_virtuemart&view=orders&task=toggle.paid.' . $valPaid . '&cidName=virtuemart_order_id&virtuemart_order_id[]=' . $this->orderID . '&rtask=edit&' . JSession::getFormToken() . '=1';


	$tool['title'] = vmText::_($labelPaid);
	$tool['button'] = $colorPaidTool;
	//$tool['subtitle'] = $texPaid;
	$tool['fields'] = array();
	$tool['footer'] = '
<a href="' . JRoute::_($linkPaid, FALSE) . '" class="uk-button uk-button-small ' . $colorPaidAction . ' uk-text-center">' .
		vmText::_($textPaidAction)
		. '</a>

';

	$tools[] = $tool;

	if (empty($this->orderbt->invoice_locked)) {
		$valLocked = '1';
		$labelLocked = 'COM_VM_ORDER_INVOICE_IS_UNLOCKED';
		$colorLockedTool = 'md-color-green-600  ';
		$textLockedAction = 'COM_VM_ORDER_INVOICE_SET_LOCKED';
		$colorLockedAction = 'md-bg-red-600 md-color-white';
		$iconLocked = 'unlock';
	} else {
		$valLocked = '0';
		$labelLocked = 'COM_VM_ORDER_INVOICE_IS_LOCKED';
		$colorLockedTool = 'md-color-red-600';
		$textLockedAction = 'COM_VM_ORDER_INVOICE_SET_UNLOCKED';
		$colorLockedAction = 'md-bg-green-600 md-color-white';
		$iconLocked = 'lock';
	}
	$linkLocked = 'index.php?option=com_virtuemart&view=orders&task=toggle.invoice_locked.' . $valLocked . '&cidName=virtuemart_order_id&virtuemart_order_id[]=' . $this->orderID . '&rtask=edit&' . JSession::getFormToken() . '=1';

	$tool['title'] = '<span><span uk-icon="icon: ' . $iconLocked . '"; ratio: 1.2"></span>';//vmText::_($labelLocked);
	$tool['button'] = $colorLockedTool;
	//$tool['subtitle'] = $texPaid;
	$tool['fields'] = array();
	$tool['footer'] = '
<a href="' . JRoute::_($linkLocked, FALSE) . '" class="uk-button uk-button-small ' . $colorLockedAction . ' uk-text-center">' .
		vmText::_($textLockedAction)
		. '</a>

';
	$tools[] = $tool;


	echo adminSublayouts::renderAdminVmSubLayout('filterbar',
		array(
			'search' => array(
				'label' => 'COM_VIRTUEMART_ORDER_PRINT_NAME',
				'name' => 'search',
				'value' => vRequest::getVar('filter_coupon')
			),
			'extras' => $extras,
			'tools' => $tools,
		));


	?>

</div>