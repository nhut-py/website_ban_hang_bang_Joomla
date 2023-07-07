<?php
/**
* sublayout products
*
* @package	VirtueMart
* @author Max Milbers
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2014 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL2, see LICENSE.php
* @version $Id: cart.php 7682 2014-02-26 17:07:20Z Milbo $
*/

defined('_JEXEC') or die('Restricted access');

$product = $viewData['product'];
$position = $viewData['position'];
$customTitle = isset($viewData['customTitle'])? $viewData['customTitle']: false;;
if(isset($viewData['class'])){
	$class = $viewData['class'];
} else {
	$class = 'product-fields';
}

if (!empty($product->customfieldsSorted[$position])) {
?>
<?php
if($customTitle and isset($product->customfieldsSorted[$position][0])){
$field = $product->customfieldsSorted[$position][0]; ?>
<h4 class="page-header"><?php echo vmText::_ ($field->custom_title); ?></h4>
<?php
}
if ($position == 'related_categories') {
  echo '<h4 class="page-header">'.vmText::_('COM_VIRTUEMART_RELATED_CATEGORIES').'</h4>';
}
?>
<div class="<?php echo $class?> row">
<?php
$custom_title = null;
foreach ($product->customfieldsSorted[$position] as $field) {
	if ( $field->is_hidden ) //OSP http://forum.virtuemart.net/index.php?topic=99320.0
	continue;
	?>
  <div class="product-field product-field-type-<?php echo $field->field_type ?> col-md-4">
		<?php
		if (!empty($field->display)){
		?>
    <div class="product-field-display text-center thumbnail">
      <?php echo $field->display ?>
    </div>
    <?php
		}
		?>
	</div>
<?php
  $custom_title = $field->custom_title;
}
?>
</div>
<?php
} ?>