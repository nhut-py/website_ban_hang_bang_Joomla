<?php
/**
*
* Order detail view
*
* @package	VirtueMart
* @subpackage Orders
* @author Oscar van Eijk, Valerie Isaksen
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: details.php 8832 2015-04-15 16:05:49Z Milbo $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
vmJsApi::css('vmpanels');

if (empty($this->orderdetails) ) {
  echo '<div class="vm-wrap">';
  echo shopFunctionsF::getLoginForm(false,$this->trackingByOrderPass);
  echo '</div>';
  return true;
}
if($this->print){
$doc = JFactory::getDocument();
$doc->addStyleDeclaration('
  .table > tbody > tr > td{
    padding: 5px;
  }

  table .table > tbody > tr > td, table .table > tbody > tr > th{
    border: none;
  }
');
?>
  <div style="width: 21cm;font-size: 14px !important">
    <div class="clearfix">
      <div class="vm-orders-vendor-image" style="width:50%; float:left">
        <img src="<?php  echo JURI::root() . $this-> vendor->images[0]->file_url ?>">
      </div>
      <div class="vm-store-name" style="width:50%; float:left">
        <p>
          <?php  echo $this->vendor->vendor_store_name; ?>
          <br>
          <?php  echo $this->vendor->vendor_name .' - '.$this->vendor->vendor_phone ?>
        </p>
      </div>
    </div>
    <h1 class="page-header" style="font-size:20px"><?php echo vmText::_('COM_VIRTUEMART_ACC_ORDER_INFO'); ?></h1>
    <div class="spaceStyle vm-orders-order print small">
    <?php
    echo $this->loadTemplate('order');
    ?>
    </div>
    <div class="spaceStyle vm-orders-items print small">
    <?php
    echo $this->loadTemplate('items');
    ?>
    </div>
    <?php
    echo VirtuemartViewInvoice::replaceVendorFields($this->vendor->vendor_letter_footer_html, $this->vendor); ?>
    <hr>
  </div>
  <script>
    jQuery(window).load(function(){
      javascript:print();
    });
  </script>

<?php
} else {
?>

<div class="vm-wrap">
	<div class="vm-orders-information">
  	<h1 class="page-header"><?php echo vmText::_('COM_VIRTUEMART_ACC_ORDER_INFO'); ?></h1>
    <div class="row">
      <div class="col-md-6">
        <?php
      	/* Print view URL */
      	$this->orderdetails['details']['BT']->invoiceNumber = VmModel::getModel('orders')->getInvoiceNumber($this->orderdetails['details']['BT']->virtuemart_order_id);
      	echo shopFunctionsF::getInvoiceDownloadButton($this->orderdetails['details']['BT']) ?>
        <a class='btn btn-default btn-sm hasTooltip' title="<?php echo vmText::_('COM_VIRTUEMART_PRINT') ?>" href="javascript:void window.open('<?php echo $this->details_url ?>', 'win2', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');">
          <span class="glyphicon glyphicon-print"></span>
        </a>
      </div>
      <div class="col-md-6 text-right">
        <?php if($this->order_list_link){ ?>
        <a class="btn btn-primary btn-sm" href="<?php echo $this->order_list_link ?>" rel="nofollow">
          <span class="glyphicon glyphicon-th-list"></span> <?php echo vmText::_('COM_VIRTUEMART_ORDERS_VIEW_DEFAULT_TITLE'); ?>
        </a>
        <?php }?>
      </div>
    </div>
    <hr>
  	<div class="vm-orders-order small">
  	<?php
  	echo $this->loadTemplate('order');
  	?>
    </div>
  	<div class="spaceStyle vm-orders-items small">
  	<?php

  	$tabarray = array();
  	$tabarray['items'] = 'COM_VIRTUEMART_ORDER_ITEM';
  	$tabarray['history'] = 'COM_VIRTUEMART_ORDER_HISTORY';
  	shopFunctionsF::buildTabs ( $this, $tabarray);

    ?>
  	</div>
	</div>
</div>
<?php
}
?>