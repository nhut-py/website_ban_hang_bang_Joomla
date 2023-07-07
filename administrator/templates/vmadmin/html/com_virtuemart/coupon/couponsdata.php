<?php
/**
*
*
* @package	VirtueMart
* @subpackage Coupon
* @author RickG, creative Momentum
* @link https://virtuemart.net
* @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: couponsdata.php 10396 2021-01-11 11:35:30Z alatak $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$adminTemplate = VMPATH_ROOT . '/administrator/templates/vmadmin/html/com_virtuemart/';
JLoader::register('vmuikitAdminUIHelper', $adminTemplate . 'helpers/vmuikit_adminuihelper.php');
vmuikitAdminUIHelper::startAdminArea($this);

?>

<form action="index.php?option=com_virtuemart&view=coupon&layout=couponsdata" method="post" name="adminForm" id="adminForm">
	<div id="filterbox" class="filter-bar">
		<?php
		$searches[]=array(
			'label'=>'Search Coupon',
			'name'=>'filter_coupon',
			'type'=>'text',
			'value'=>vRequest::getVar('filter_coupon')
		);
		$searches[]=array(
			'label'=>'Search Shopper',
			'name'=>'filter_shopper',
			'type'=>'text',
			'value'=>vRequest::getVar('filter_shopper')
		);
		$searches[]=array(
			'label'=>'Search Order Number',
			'name'=>'filter_order_number',
			'type'=>'text',
			'value'=>vRequest::getVar('filter_order_number')
		);
		$searches[]=array(
			'label'=>'Enter From Date',
			'name'=>'filter_from_date',
			'class'=>'date_picker',
			'value'=>vRequest::getVar('filter_from_date')
		);
		$searches[]=array(
			'label'=>'Enter To Number',
			'name'=>'filter_to_date',
			'class'=>'date_picker',
			'type'=>'text',
			'value'=>vRequest::getVar('filter_to_date')
		);
		$extras[]='<a href="index.php?option=com_virtuemart&amp;view=coupon" class=""><span uk-icon="reply"></span>Close Analytics </a>';
		echo adminSublayouts::renderAdminVmSubLayout('filterbar',
			array(
				'searches'=>$searches,
				'extras'=>$extras,
				'resultsCounter'=>$this->pagination->getResultsCounter()
			));
		?>
	</div>

    <div id="editcell">
	    <table class="adminlist table table-striped" cellspacing="0" cellpadding="0">
	    <thead>
		<tr>
		    <th width="20%">
				Coupon Code
		    </th>
		    <th width="20%">
				Shopper
		    </th>
		    <th width="15%">
				Order Number
		    </th>
			<th width="15%">
				Order Total
		    </th>
			<th width="10%">
				Coupon Discount
		    </th>
		    <th width="20%">
				Date Used
		    </th>
		</tr>
	    </thead>
	    <?php
	    $k = 0;
	    for ($i=0, $n=count($this->coupons_data); $i < $n; $i++) {
		$row = $this->coupons_data[$i];
		?>
	    <tr class="row<?php echo $k; ?>">
			<td align="left">
				<?php echo $row->coupon_code;?>
			</td>
			<td align="left">
				<?php
					if(!$row->virtuemart_user_id){
						echo 'Non-Regsitered User<br> Customer Number:<br>'.$row->customer_number;
					} else 
						echo $row->name; ?>
			</td>
			<td align="left">
				<?php echo $row->order_number;?>
			</td>
			<td align="left">
				<?php echo $row->order_total;?>
			</td>
			<td align="left">
				<?php echo $row->coupon_discount;?>
			</td>
			<td align="left">
				<?php echo $row->created_on;?>
			</td>
	    </tr>
		<?php
		$k = 1 - $k;
	    }
	    ?>
	    <tfoot>
		<tr>
		    <td colspan="10">
			<?php echo $this->pagination->getListFooter(); ?>
		    </td>
		</tr>
	    </tfoot>
	</table>
    </div>

    <input type="hidden" name="option" value="com_virtuemart" />
    <input type="hidden" name="controller" value="coupon" />
    <input type="hidden" name="view" value="coupon" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <?php echo JHtml::_( 'form.token' ); ?>
</form>

<script>
jQuery(document).ready(function(){
	jQuery( "body .date_picker" ).each(function(){
		jQuery(this).datepicker({
			dateFormat: "yy-mm-dd"
		 });
	});
});
</script>

<?php vmuikitAdminUIHelper::endAdminArea(); ?>