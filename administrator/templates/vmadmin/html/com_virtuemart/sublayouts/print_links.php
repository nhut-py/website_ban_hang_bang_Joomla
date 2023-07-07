<?php
/**
 * Administrator printlinks
 *
 * @package VirtueMart
 * @subpackage Sublayouts
 * @author Max Milbers
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * @version $Id: print_links.php 10447 2021-01-24 08:16:25Z alatak $
 *
 */

// Check to ensure this file is included in Joomla!
defined ( '_JEXEC' ) or die ();



/** @var TYPE_NAME $viewData */
$order = $viewData['order'];
$iconRatio = isset($viewData['iconRatio']) ? $viewData['iconRatio'] : 1;
$hrefClass = isset($viewData['hrefClass']) ? $viewData['hrefClass'] : '';

$baseUrl = 'index.php?option=com_virtuemart&view=orders&task=callInvoiceView&tmpl=component&virtuemart_order_id=' . $order->virtuemart_order_id;

$print_url = $baseUrl . '&layout=invoice';
?>
	<a href="javascript:void window.open('<?php echo $print_url ?>', 'win2', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"
			class="<?php echo $hrefClass ?> md-color-green-600 uk-margin-small-right"
	>
		<span  uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_PRINT') . ' ' . $order->order_number ?>">
			<span uk-icon="icon: print; ratio: <?php echo $iconRatio ?>"></span>
		</span>
	</a>

<?php

$invoice_links_array = array();
$deliverynote_link = '';
$pdfDummi = '&d=' . rand(0, 100);
if (!$order->invoiceNumbers) {
	$invoice_url = $baseUrl . '&layout=invoice&format=pdf&create_invoice=' . $order->order_create_invoice_pass . $pdfDummi;
	?>
	<a href="<?php echo $invoice_url ?>" class="<?php echo $hrefClass ?> md-color-red-600  uk-margin-small-right">
		<span uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_INVOICE_CREATE') ?>">
			<span uk-icon="icon: file-pdf; ratio: <?php echo $iconRatio ?>"></span>
		</span>
	</a>

	<?php


} else {
	foreach ($order->invoiceNumbers as $invoiceNumber) {
		if (!shopFunctions::InvoiceNumberReserved($invoiceNumber)) {
			$invoice_url = $baseUrl . '&layout=invoice&format=pdf' . $pdfDummi . '&invoiceNumber=' . $invoiceNumber;
			?>
			<a href="<?php echo $invoice_url ?>" class="<?php echo $hrefClass ?> md-color-green-600  uk-margin-small-right">
		<span uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_INVOICE') . ' ' . $invoiceNumber ?>">
			<span uk-icon="icon: file-pdf; ratio: <?php echo $iconRatio ?>"></span>
		</span>
			</a>
			<?php
		}
	}
}

if (!$order->invoiceNumbers) {
	$deliverynote_url = $baseUrl . '&layout=deliverynote&format=pdf&create_invoice=' . $order->order_create_invoice_pass . $pdfDummi;
	?>
	<a href="<?php echo $deliverynote_url ?>" class="<?php echo $hrefClass ?> md-color-red-600  uk-margin-small-right">
		<span uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_DELIVERYNOTE_CREATE') ?>">
			<span uk-icon="icon: file-text; ratio: <?php echo $iconRatio ?>"></span>
		</span>
	</a>
	<?php
} else {
	/*
	 * TODO: InvoiceNumberReserved is used by some payments like Klarna
	 */
	$invoiceNumber = $order->invoiceNumbers [0];
	if (!shopFunctionsF::InvoiceNumberReserved($invoiceNumber)) {
		$deliverynote_url = $baseUrl . '&layout=deliverynote&format=pdf&virtuemart_order_id=' . $order->virtuemart_order_id . $pdfDummi;
		?>
		<a href="<?php echo $deliverynote_url ?>" class="<?php echo $hrefClass ?> md-color-green-600  uk-margin-small-right">
		<span uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_DELIVERYNOTE') . ' ' . $invoiceNumber ?>">
			<span uk-icon="icon: file-text; ratio: <?php echo $iconRatio ?>"></span>
		</span>
		</a>

		<?php
	}
}
