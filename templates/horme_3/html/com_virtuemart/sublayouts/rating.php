<?php defined('_JEXEC') or die('Restricted access');

$product = $viewData['product'];

if ($viewData['showRating']) {
	$maxrating = VmConfig::get('vm_maximum_rating_scale', 5);
	if (empty($product->rating)) {
	?>
		<div class="ratingbox dummy col-md-8 col-xs-8">
      <div class="hasTooltip" title="<?php echo vmText::_('COM_VIRTUEMART_UNRATED'); ?>">
        <span class="glyphicon glyphicon-star-empty"></span>
        <span class="glyphicon glyphicon-star-empty"></span>
        <span class="glyphicon glyphicon-star-empty"></span>
        <span class="glyphicon glyphicon-star-empty"></span>
        <span class="glyphicon glyphicon-star-empty"></span>
      </div>
    </div>
	<?php
	} else {
		$ratingwidth = round($product->rating) * 18;
  ?>

  <div class="ratingbox col-md-8 col-xs-8" >
    <div class="stars-orange hasTooltip" style="width:<?php echo $ratingwidth.'px'; ?>" title="<?php echo (vmText::_("COM_VIRTUEMART_RATING_TITLE") . round($product->rating) . '/' . $maxrating) ?>">
      <span class="glyphicon glyphicon-star"></span>
      <span class="glyphicon glyphicon-star"></span>
      <span class="glyphicon glyphicon-star"></span>
      <span class="glyphicon glyphicon-star"></span>
      <span class="glyphicon glyphicon-star"></span>
    </div>
    <span class="glyphicon glyphicon-star-empty"></span>
    <span class="glyphicon glyphicon-star-empty"></span>
    <span class="glyphicon glyphicon-star-empty"></span>
    <span class="glyphicon glyphicon-star-empty"></span>
    <span class="glyphicon glyphicon-star-empty"></span>
  </div>
	<?php
	}
}