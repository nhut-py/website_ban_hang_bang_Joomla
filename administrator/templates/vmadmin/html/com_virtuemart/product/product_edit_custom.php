<?php
/**
 *
 * Handle the Product Custom Fields
 *
 * @package    VirtueMart
 * @subpackage Product
 * @author RolandD, Patrick khol
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: product_edit_custom.php 10422 2021-01-14 08:42:44Z alatak $
 */


// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

?>


<?php
$relatedcategories=array();
$relatedproducts=array();
$customcfs=array();
$i = 0;
$tables = array('categories' => '', 'products' => '', 'fields' => '', 'customPlugins' => '',);
if (isset($this->product->customfields)) {
	$customfieldsModel = VmModel::getModel('customfields');


	$i = 0;

	foreach ($this->product->customfields as $k => $customfield) {

		$checkValue = $customfield->virtuemart_customfield_id;
		$title = '';
		$text = '';
		$customfield->display = $customfieldsModel->displayProductCustomfieldBE($customfield, $this->product, $i);

		$checkValue = $customfield->virtuemart_customfield_id;
		if ($customfield->override != 0 or $customfield->disabler != 0) {

			if (!empty($customfield->disabler)) {
				$checkValue = $customfield->disabler;
			}
			if (!empty($customfield->override)) {
				$checkValue = $customfield->override;
			}
			$title = vmText::sprintf('COM_VIRTUEMART_CUSTOM_OVERRIDE', $checkValue) . '</br>';
			if ($customfield->disabler != 0) {
				$title = vmText::sprintf('COM_VIRTUEMART_CUSTOM_DISABLED', $checkValue) . '</br>';
			}

			if ($customfield->override != 0) {
				$title = vmText::sprintf('COM_VIRTUEMART_CUSTOM_OVERRIDE', $checkValue) . '</br>';
			}

		} else {
			if ($customfield->virtuemart_product_id == $this->product->product_parent_id) {
				$title = vmText::_('COM_VIRTUEMART_CUSTOM_INHERITED') . '</br>';
			}
		}
		$disableDerivedCheckbox='';
		$nonInheritableCheckbox='';
		if (!empty($title)) {
			$tip = 'COM_VIRTUEMART_CUSTOMFLD_DIS_DER_TIP';
			$text = '<span style="white-space: nowrap;" uk-tooltip="' . htmlentities(vmText::_($tip)) . '">d:' . VmHtml::checkbox('field[' . $i . '][disabler]', $customfield->disabler, $checkValue) . '</span>';
			$disableDerived = '<span style="white-space: nowrap;" uk-tooltip="' . htmlentities(vmText::_($tip)) . '">d:' . VmHtml::checkbox('field[' . $i . '][disabler]', $customfield->disabler, $checkValue) . '</span>';
			$disableDerivedCheckbox =VmHtml::checkbox('field[' . $i . '][disabler]', $customfield->disabler, $checkValue);
		} else {
			$tip = 'COM_VIRTUEMART_CUSTOMFLD_DIS_INH_TIP';
			$text = '<span style="white-space: nowrap;" uk-tooltip="' . htmlentities(vmText::_($tip)) . '">disinh:' . VmHtml::checkbox('field[' . $i . '][noninheritable]', $customfield->noninheritable, $checkValue) . '</span>';
		$nonInheritableCheckbox=VmHtml::checkbox('field[' . $i . '][noninheritable]', $customfield->noninheritable, $checkValue);
		}


		if ($customfield->is_cart_attribute) {
			$cartIcone = 'default';
		} else {
			$cartIcone = 'default-off';
		}
		if ($customfield->field_type == 'Z') {
			// R: related categories
			$relatedcategory= new stdClass();
			$relatedcategory->displayHTML=$customfield->display;
			$relatedcategory->hiddenHTML=VirtueMartModelCustomfields::setEditCustomHidden($customfield, $i);
			$relatedcategory->title=$title;
			$relatedcategory->disableDerivedCheckbox=$disableDerivedCheckbox;
			$relatedcategory->nonInheritableCheckbox=$nonInheritableCheckbox;
			$relatedcategories[] =$relatedcategory;

		} elseif ($customfield->field_type == 'R') {
			// R: related products
			$relatedproduct= new stdClass();
			$relatedproduct->displayHTML=$customfield->display;
			$relatedproduct->hiddenHTML=VirtueMartModelCustomfields::setEditCustomHidden($customfield, $i);
			$relatedproduct->title=$title;
			$relatedproduct->disableDerivedCheckbox=$disableDerivedCheckbox;
			$relatedproduct->nonInheritableCheckbox=$nonInheritableCheckbox;
			$relatedproducts[] =$relatedproduct;
		} else {
			$customcf= new stdClass();
			if (isset($this->fieldTypes[$customfield->field_type])) {
				$type = $this->fieldTypes[$customfield->field_type];
			} else {
				$type = 'deprecated';
			}
			$customcf->type=$type;
			$colspan = '';

			if ($customfield->field_type == 'C') {
				$colspan = 'colspan="2" ';
			}
			$customcf->overrideCheckbox='';
			if (!empty($title)) {
				$text .= '<span style="white-space: nowrap;" uk-tooltip="' . htmlentities(vmText::_('COM_VIRTUEMART_DIS_DER_CUSTOMFLD_OVERR_DER_TIP')) . '">o:' . VmHtml::checkbox('field[' . $i . '][override]', $customfield->override, $checkValue) . '</span>';
				$overrideCheckbox =  VmHtml::checkbox('field[' . $i . '][override]', $customfield->override, $checkValue) ;
				$customcf->overrideCheckbox=$overrideCheckbox;

			}

			$tables['fields'] .= '<tr class="removable">
							<td >
							<b>' . vmText::_($type) . '</b> ' . vmText::_($customfield->custom_title) . '</span><br/>
								' . $title . ' ' . $text . '
								<span class="vmicon vmicon-16-' . $cartIcone . '"></span>';
			$customcf->type=vmText::_($type) ;
			$customcf->title=vmText::_($customfield->custom_title) ;
			$customcf->is_cart_attribute=(int)$customfield->is_cart_attribute;
			$customcf->canMove=false;
			$customcf->canRemove=false;
			$customcf->searchable=(int)$customfield->searchable;
			$customcf->layout_pos=$customfield->layout_pos;
			if (($customfield->virtuemart_product_id == $this->product->virtuemart_product_id or $customfield->override != 0) and $customfield->disabler == 0) {
				$tables['fields'] .= '<span class="vmicon vmicon-16-move"></span>
							<span class="vmicon vmicon-16-remove 4remove"></span>';
				$customcf->canMove=true;
				$customcf->canRemove=true;
			}
			$tables['fields'] .= VirtueMartModelCustomfields::setEditCustomHidden($customfield, $i)
				. '</td>
							<td ' . $colspan . '>' . $customfield->display . '</td>
						 </tr>';
			$customcf->hiddenHTML=VirtueMartModelCustomfields::setEditCustomHidden($customfield, $i);
			$customcf->displayHTML=$customfield->display;
			$customcfs[]=$customcf;
		}

		$i++;
	}
}

$emptyTable = '
				<tr>
					<td colspan="8">' . vmText::_('COM_VIRTUEMART_CUSTOM_NO_TYPES') . '</td>
				<tr>';


$this->relatedcategories=$relatedcategories;
$this->tables=$tables;
?>
<div class="uk-grid-small uk-child-width-1-1" uk-grid>
	<div>
		<?php
		$this->relatedType="categories";
		$this->relatedDatas=$relatedcategories;
		$this->relatedIcon='category';
		echo $this->loadTemplate('custom_relatedcf');
		$this->relatedType="";
		$this->relatedDatas=array();
		?>
	</div>
	<div>
		<?php
		$this->relatedType="products";
		$this->relatedDatas=$relatedproducts;
		$this->relatedIcon='product';
		echo $this->loadTemplate('custom_relatedcf') ;
		$this->relatedType="";
		$this->relatedDatas=array();
		?>
	</div>

	<div>
		<?php
		$this->customcfs=$customcfs;
		echo $this->loadTemplate('custom_customs')
		?>
	</div>
</div>



