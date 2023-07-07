<?php // no direct access
defined('_JEXEC') or die('Restricted access');
?>

<form action="<?php echo JRoute::_('index.php?option=com_virtuemart&view=category&search=true&limitstart=0&virtuemart_category_id='.$category_id ); ?>" method="get">
	<div class="search <?php echo $params->get('moduleclass_sfx'); ?> <?php if ($button) { echo 'input-group'; } ?>">

	  <?php if ($button && $button_pos == 'left') { ?>
	  <span class="input-group-btn">
			<?php if ($imagebutton) { ?>
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
			<?php } else { ?>
      <input type="submit" value="<?php echo $button_text; ?>" class="btn btn-primary"/>
			<?php } ?>
	  </span>
		<?php } ?>

		<input name="keyword" id="mod_virtuemart_search" maxlength="<?php echo $maxlength; ?>" title="<?php echo $button_text; ?>" class="inputbox form-control" type="text" size="<?php echo $width; ?>" placeholder="<?php echo $text; ?>"/>

    <?php if ($button && $button_pos == 'right') { ?>
	  <span class="input-group-btn">
			<?php if ($imagebutton) { ?>
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
			<?php } else { ?>
      <input type="submit" value="<?php echo $button_text; ?>" class="btn btn-primary"/>
			<?php } ?>
	  </span>
		<?php } ?>

	</div>
	<input type="hidden" name="limitstart" value="0" />
	<input type="hidden" name="option" value="com_virtuemart" />
	<input type="hidden" name="view" value="category" />
	<input type="hidden" name="virtuemart_category_id" value="<?php echo $category_id; ?>"/>
	<?php if(!empty($set_Itemid)){ ?>
	<input type="hidden" name="Itemid" value="<?php echo $set_Itemid ?>" />
	<?php } ?>

</form>