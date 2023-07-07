<?php
/**
*
* Description
*
* @package	VirtueMart
* @subpackage Userfields
* @author Oscar van Eijk
* @link https://virtuemart.net
* @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: default.php 10451 2021-01-27 08:16:53Z alatak $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

$adminTemplate = VMPATH_ROOT . '/administrator/templates/vmadmin/html/com_virtuemart/';
JLoader::register('vmuikitAdminUIHelper', $adminTemplate . 'helpers/vmuikit_adminuihelper.php');
vmuikitAdminUIHelper::startAdminArea($this);

?>

<form action="<?php echo JRoute::_( 'index.php?option=com_virtuemart&view=userfields' );?>" method="post" name="adminForm" id="adminForm">
	<div id="headerx">
		<div id="filterbox" class=" well well-small">
			<div class="uk-flex uk-flex-center uk-flex-middle uk-flex-between">
				<div class=""><?php echo $this->displayDefaultViewSearch('COM_VIRTUEMART_USERFIELDS', 'search'); ?></div>
				<div class="">
					<div id="resultscounter"><?php echo $this->pagination->getResultsCounter(); ?></div>
				</div>
			</div>

		</div>
	</div>


	<div id="editcell">
		<table class="uk-table uk-table-small uk-table-striped uk-table-responsive">
		<thead>
		<tr>
			<th>
				<input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this)" />
			</th>

			<th>
			<?php  echo $this->sort('name','COM_VIRTUEMART_FIELDMANAGER_NAME')  ?>
			</th>
			<th>
			<?php echo vmText::_('COM_VIRTUEMART_FIELDMANAGER_TITLE'); ?>
			</th>
			<th>
			<?php echo $this->sort('type','COM_VIRTUEMART_FIELDMANAGER_TYPE') ?>
			</th>
			<th width="20">
				<?php echo vmText::_('COM_VIRTUEMART_FIELDMANAGER_REQUIRED'); ?>
			</th>
			<th width="20">
				<?php echo vmText::_('COM_VIRTUEMART_PUBLISHED'); ?>
			</th>
			<th width="20">
				<?php echo vmText::_('COM_VIRTUEMART_FIELDMANAGER_SHOW_ON_CART'); ?>
			</th>
			<th width="20">
				<?php echo vmText::_('COM_VIRTUEMART_FIELDMANAGER_SHOW_ON_SHIPPING'); ?>
			</th>
			<th width="20">
				<?php echo vmText::_('COM_VIRTUEMART_FIELDMANAGER_SHOW_ON_ACCOUNT'); ?>
			</th>
			<th>
			<?php echo $this->sort('ordering','COM_VIRTUEMART_FIELDMANAGER_REORDER') ?>
			<?php echo JHtml::_('grid.order',  $this->userfieldsList ); ?>
			</th>
			 <th><?php echo $this->sort('virtuemart_userfield_id', 'COM_VIRTUEMART_ID')  ?></th>
		</tr>
		</thead>
		<?php
		$k = 0;
		for ($i = 0, $n = count($this->userfieldsList); $i < $n; $i++) {
			$row = $this->userfieldsList[$i];

			$coreField = (in_array($row->name, $this->lists['coreFields']));
			$image = 'admin/checked_out.png';
			$image = JHtml::_('image', $image, vmText::_('COM_VIRTUEMART_FIELDMANAGER_COREFIELD'),null,true);
			//$checked = '<div style="position: relative;">'.JHtml::_('grid.id', $i, null,$row->virtuemart_userfield_id);
			$checked = JHtml::_('grid.id', $i ,$row->virtuemart_userfield_id,null,'virtuemart_userfield_id');
			if ($coreField) $checked.='<span   style="position: absolute; margin-left:-3px;" uk-tooltip="'. vmText::_('COM_VIRTUEMART_FIELDMANAGER_COREFIELD').'">'. $image .'</span>';
			$checked .= '</div>';
			$checked_out = $coreField ? 'style="position: relative;"' : '';
			// There is no reason not to allow moving of the core fields. We only need to disable deletion of them
			// ($coreField) ?
			// 	'<span class="hasTooltip" title="'. vmText::_('COM_VIRTUEMART_FIELDMANAGER_COREFIELD').'">'. $image .'</span>' :
				
			$editlink = JROUTE::_('index.php?option=com_virtuemart&view=userfields&task=edit&virtuemart_userfield_id=' . $row->virtuemart_userfield_id);
			$required = $this->toggle($row->required, $i, 'toggle.required','tick.png','publish_x.png',$coreField );
//			$published = JHtml::_('grid.published', $row, $i);
			$published = $this->toggle($row->published, $i, 'toggle.published','tick.png','publish_x.png', $coreField);
			$registration = $this->toggle($row->cart, $i, 'toggle.cart','tick.png','publish_x.png', $coreField);
			$shipment = $this->toggle($row->shipment, $i, 'toggle.shipment','tick.png','publish_x.png', $coreField);
			$account = $this->toggle($row->account, $i, 'toggle.account','tick.png','publish_x.png', $coreField);
			$ordering = ($this->lists['filter_order'] == 'ordering');
			$disabled = ($ordering ?  '' : 'disabled="disabled"');
		?>
			<tr class="row<?php echo $k ; ?>">
				<td <?php echo $checked_out; ?>>
					<?php echo $checked; ?>
				</td>

				<td align="left">
					<a href="<?php echo $editlink; ?>"><?php echo $row->name; ?></a>
				</td>
				<td align="left">
					<?php echo vmText::_($row->title); ?>
				</td>
				<td align="left">
					<?php echo vmText::_($row->type); ?>
				</td>
				<td align="center">
					<?php echo $required; ?>
				</td>
				<td align="center">
					<?php echo $published; ?>
				</td>
				<td align="center">
					<?php echo $registration; ?>
				</td>
				<td align="center">
					<?php echo $shipment; ?>
				</td>
				<td align="center">
					<?php echo $account; ?>
				</td>
				<td class="order">
					<span><?php echo $this->pagination->vmOrderUpIcon( $i, $ordering, 'orderup', vmText::_('COM_VIRTUEMART_MOVE_UP')  ); ?></span>
					<span><?php echo $this->pagination->vmOrderDownIcon( $i, $ordering, $n, true, 'orderdown', vmText::_('COM_VIRTUEMART_MOVE_DOWN') ); ?></span>
					<input type="text" name="order[]" size="5" value="<?php echo $row->ordering;?>" <?php echo $disabled ?> class="ordering" style="text-align: center" />
			</td>
			<td width="10">
					<?php echo $row->virtuemart_userfield_id; ?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		<tfoot>
			<tr>
				<td colspan="11">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
	</table>
</div>

	<?php echo $this->addStandardHiddenToForm(); ?>
</form>

<?php vmuikitAdminUIHelper::endAdminArea(); ?>
