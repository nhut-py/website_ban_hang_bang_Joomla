<?php
/**
*
* Description
*
* @package	VirtueMart
* @subpackage Calculation tool
* @author Max Milbers, Valérie Isaksen
* @link https://virtuemart.net
* @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: default.php 10449 2021-01-25 09:26:46Z alatak $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

$adminTemplate = VMPATH_ROOT . '/administrator/templates/vmadmin/html/com_virtuemart/';
JLoader::register('vmuikitAdminUIHelper', $adminTemplate . 'helpers/vmuikit_adminuihelper.php');
vmuikitAdminUIHelper::startAdminArea($this);

?>

<form action="index.php?option=com_virtuemart&view=calc" method="post" name="adminForm" id="adminForm">

	<div id="filterbox" class="filter-bar">
		<?php
		$extras=array();

		echo adminSublayouts::renderAdminVmSubLayout('filterbar',
			array(
				'search' => array(
					'label' => 'COM_VIRTUEMART_NAME',
					'name' => 'search',
					'value' => vRequest::getVar('search')
				),
				'extras'=>$extras,
				'resultsCounter'=>$this->pagination->getResultsCounter()
			));


		?>

	</div>


	<table class="uk-table uk-table-striped uk-table-responsive">
		<thead>
		<tr>
			<th>
				<input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this)" />
			</th>
			<th ><?php echo $this->sort('calc_name', 'COM_VIRTUEMART_NAME') ; ?></th>
			<?php if($this->showVendors){ ?>
			<th>
				<?php echo vmText::_('COM_VIRTUEMART_VENDOR');  ?>
			</th><?php }  ?>
			<th><?php echo $this->sort('calc_descr' , 'COM_VIRTUEMART_DESCRIPTION'); ?></th>
			<th><?php echo $this->sort('ordering') ; ?></th>
			<th  ><?php echo $this->sort('calc_kind') ; ?></th>
			<th><?php echo vmText::_('COM_VIRTUEMART_CALC_VALUE_MATHOP'); ?></th>
			<th><?php echo $this->sort('calc_value' , 'COM_VIRTUEMART_VALUE'); ?></th>
			<th><?php echo $this->sort('calc_currency' , 'COM_VIRTUEMART_CURRENCY'); ?></th>
			<th><?php echo vmText::_('COM_VIRTUEMART_CATEGORY_S'); ?></th>
			<th><?php echo vmText::_('COM_VIRTUEMART_MANUFACTURER'); // Mod. <mediaDESIGN> St.Kraft 2013-02-24  ?></th>
			<th><?php echo vmText::_('COM_VIRTUEMART_SHOPPERGROUP_IDS'); ?></th>
			<?php /*		<th><?php echo vmText::_('COM_VIRTUEMART_CALC_VIS_SHOPPER'); ?></th>
			<th width="10"><?php echo vmText::_('COM_VIRTUEMART_CALC_VIS_VENDOR'); ?></th> */  ?>
			<th><?php echo $this->sort('publish_up' , 'COM_VIRTUEMART_START_DATE'); ?></th>
			<th><?php echo $this->sort('publish_down' , 'COM_VIRTUEMART_END_DATE'); ?></th>
<?php /*	<th width="20"><?php echo vmText::_('COM_VIRTUEMART_CALC_AMOUNT_COND'); ?></th>
			<th width="10"><?php echo vmText::_('COM_VIRTUEMART_CALC_AMOUNT_DIMUNIT'); ?></th> */  ?>
			<th><?php echo vmText::_('COM_VIRTUEMART_COUNTRY_S'); ?></th>
			<th><?php echo vmText::_('COM_VIRTUEMART_STATE_IDS'); ?></th>
			<th><?php echo vmText::_('COM_VIRTUEMART_PUBLISHED'); ?></th>
			<?php if($this->showVendors){ ?>
			<th >
				<?php echo vmText::_( 'COM_VIRTUEMART_SHARED')  ?>
			</th><?php }  ?>
			<th><?php echo $this->sort('virtuemart_calc_id', 'COM_VIRTUEMART_ID')  ?></th>
		<?php /*	<th width="10">
				<?php echo vmText::_('COM_VIRTUEMART_SHARED'); ?>
			</th> */ ?>
		</tr>
		</thead>
		<?php
		$k = 0;

		for ($i=0, $n=count( $this->calcs ); $i < $n; $i++) {

			$row = $this->calcs[$i];
			$checked = JHtml::_('grid.id', $i, $row->virtuemart_calc_id);
			$published = $this->toggle($row->published, $i, 'toggle.published');

			$editlink = JROUTE::_('index.php?option=com_virtuemart&view=calc&task=edit&cid[]=' . $row->virtuemart_calc_id);
			?>
			<tr class="<?php echo "row".$k; ?>">

				<td>
					<?php echo $checked; ?>
				</td>
				<td align="left">
					<a href="<?php echo $editlink; ?>"><?php echo vmText::_($row->calc_name); ?></a>
				</td>
				<?php  if($this->showVendors){ ?>
				<td >
					<?php echo $row->virtuemart_vendor_id; ?>
				</td>
				<?php } ?>
				<td>
					<?php echo $row->calc_descr; ?>
				</td>
				<td>
					<?php echo $row->ordering; ?>
				</td>
				<td  >
					<?php echo $row->calc_kind; ?>
				</td>
				<td  >
					<?php echo $row->calc_value_mathop; ?>
				</td>
				<td>
					<?php echo $row->calc_value; ?>
				</td>
				<td>
					<?php echo $row->currencyName; ?>
				</td>
				<td>
					<?php echo $row->calcCategoriesList; ?>
				</td>
				<td>
					<?php echo $row->calcManufacturersList; /* Mod. <mediaDESIGN> St.Kraft 2013-02-24 Herstellerrabatt */ ?>
				</td>
				<td>
					<?php echo $row->calcShoppersList; ?>
				</td>
				<?php /*				<td align="center">
					<a href="#" onclick="return listItemTask('cb<?php echo $i;?>', 'toggle.calc_shopper_published')" title="<?php echo ( $row->calc_shopper_published == '1' ) ? vmText::_('COM_VIRTUEMART_YES') : vmText::_('COM_VIRTUEMART_NO');?>">
						<?php echo JHtml::_('image.administrator', ((JVM_VERSION===1) ? '' : 'admin/') . ($row->calc_shopper_published ? 'tick.png' : 'publish_x.png')); ?>
					</a>
				</td>
				<td align="center">
					<a href="#" onclick="return listItemTask('cb<?php echo $i;?>', 'toggle.calc_vendor_published')" title="<?php echo ( $row->calc_vendor_published == '1' ) ? vmText::_('COM_VIRTUEMART_YES') : vmText::_('COM_VIRTUEMART_NO');?>">
						<?php echo JHtml::_('image.administrator', ((JVM_VERSION===1) ? '' : 'admin/') . ($row->calc_vendor_published ? 'tick.png' : 'publish_x.png')); ?>
					</a>
				</td> */  ?>
				<td>
					<?php
						echo vmJsApi::date( $row->publish_up, 'LC4',true);
					?>
				</td>
				<td>
					<?php
							echo vmJsApi::date( $row->publish_down, 'LC4',true);
					?>
				</td>
<?php /*				<td>
					<?php echo $row->calc_amount_cond; ?>
				</td>
				<td>
					<?php echo vmText::_($row->calc_amount_dimunit); ?>
				</td> */  ?>
				<td>
					<?php echo vmText::_($row->calcCountriesList); ?>
				</td>
				<td>
					<?php echo vmText::_($row->calcStatesList); ?>
				</td>
				<td align="center">
					<?php echo $published; ?>
				</td>

				<?php
				if($this->showVendors){
				?><td >
					   <?php echo $this->toggle($row->shared, $i, 'toggle.shared'); ?>
			        </td>
				<?php
				}
			?>
				<td >
					<?php echo $row->virtuemart_calc_id; ?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		<tfoot>
			<tr>
				<td colspan="21">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
	</table>

	<?php echo $this->addStandardHiddenToForm(); ?>
</form>


<?php AdminUIHelper::endAdminArea(); ?>